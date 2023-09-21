<?php

namespace App\Models\ApiSetting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use function request;

class ApiKey extends Model
{
    use SoftDeletes;

    const EVENT_NAME_CREATED = 'created';

    const EVENT_NAME_ACTIVATED = 'activated';

    const EVENT_NAME_DEACTIVATED = 'deactivated';

    const EVENT_NAME_DELETED = 'deleted';

    protected static $nameRegex = '/^[a-z0-9-]{1,255}$/';

    protected $table = 'api_keys';

    protected $fillable =
        [
            'name',
            'key',
            'created_by',
            'updated_by',
            'deleted_by',
            'status',
            'last_access_time',
            'client_id',
        ];

    /**
     * Get the related ApiKeyAccessEvents records
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accessEvents()
    {
        return $this->hasMany(ApiKeyAccessEvent::class, 'api_key_id');
    }

    /**
     * Get the related ApiKeyAdminEvents records
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adminEvents()
    {
        return $this->hasMany(ApiKeyAdminEvent::class, 'api_key_id');
    }

    /**
     * Bootstrapping event handlers
     */
    public static function boot()
    {
        parent::boot();

        static::created(function (ApiKey $apiKey) {
            self::logApiKeyAdminEvent($apiKey, self::EVENT_NAME_CREATED);
        });

        static::updated(function (ApiKey $apiKey) {
            $changed = $apiKey->getDirty();

            if (isset($changed) && $apiKey['status'] === 1) {
                self::logApiKeyAdminEvent($apiKey, self::EVENT_NAME_ACTIVATED);
            }

            if (isset($changed) && $apiKey['status'] === 0) {
                self::logApiKeyAdminEvent($apiKey, self::EVENT_NAME_DEACTIVATED);
            }
        });

        static::deleted(function ($apiKey) {
            self::logApiKeyAdminEvent($apiKey, self::EVENT_NAME_DELETED);
        });
    }

    /**
     * Generate a secure unique API key
     */
    public static function generate(): string
    {
        do {
            $key = Str::random(64);
        } while (self::keyExists($key));

        return $key;
    }

    /**
     * Get ApiKey record by key value
     *
     * @return bool
     */
    public static function getByKey(string $key)
    {
        return self::where([
            'key' => $key,
            'status' => 1,
        ])->first();
    }

    /**
     * Check if key is valid
     */
    public static function isValidKey(string $key): bool
    {
        return self::getByKey($key) instanceof self;
    }

    /**
     * Check if name is valid format
     */
    public static function isValidName(string $name): bool
    {
        return (bool) preg_match(self::$nameRegex, $name);
    }

    /**
     * Check if a key already exists
     *
     * Includes soft deleted records
     */
    public static function keyExists(string $key): bool
    {
        return self::where('key', $key)->withTrashed()->first() instanceof self;
    }

    /**
     * Check if a name already exists
     *
     * Does not include soft deleted records
     */
    public static function nameExists(string $name): bool
    {
        return self::where('name', $name)->first() instanceof self;
    }

    /**
     * Log an API key admin event
     */
    protected static function logApiKeyAdminEvent(ApiKey $apiKey, string $eventName)
    {
        $event = new ApiKeyAdminEvent;
        $event->api_key_id = $apiKey->id;
        $event->ip_address = request()->ip();
        $event->event = $eventName;
        $event->save();
    }
}
