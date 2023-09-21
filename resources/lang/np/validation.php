<?php

/*
|--------------------------------------------------------------------------
| Validation Language Lines
|--------------------------------------------------------------------------
|
| The following language lines contain the default error messages used by
| the validator class. Some of these rules have multiple versions such
| as the size rules. Feel free to tweak each of these messages here.
|
*/

return [
    'accepted' => ':attribute स्वीकार गरिएको हुनुपर्छ।',
    'active_url' => ':attribute URL अमान्य छ।',
    'after' => ':attribute को मिति :date भन्दा पछि हुनुपर्छ।',
    'after_or_equal' => ':attribute मिति पछाडि वा बराबर मिति हुनुपर्दछ।',
    'alpha' => ':attribute मा अक्षरहरु मात्र हुनसक्छ।',
    'alpha_dash' => ':attribute मा अक्षर, संख्या र ड्यासहरू मात्र हुनसक्छ।',
    'alpha_num' => ':attribute मा अक्षर र संख्याहरू मात्र हुनसक्छ।',
    'array' => ':attribute एर्रे हुनुपर्छ।',
    'attached' => 'यो :attribute छ नै संलग्न.',
    'before' => ':attribute को मिति :date भन्दा अघि हुनुपर्छ।',
    'before_or_equal' => ':attribute मिति भन्दा अघि वा बराबर :date हुनुपर्दछ। ',
    'between' => [
        'array' => ':attribute आइटमको संख्या :min र :max को बिचमा हुनुपर्छ।',
        'file' => ':attribute :min र :max किलोबाइट्स को बिचमा हुनुपर्छ।',
        'numeric' => ':attribute :min र :maxको बिचमा हुनुपर्छ।',
        'string' => ':attribute :min र :max वर्णको बिचमा हुनुपर्छ।',
    ],
    'boolean' => ':attribute ठिक अथवा बेठिक हुनुपर्छ।',
    'confirmed' => ':attribute दाेहाेर्याइएकाे मिलेन।',
    'date' => ':attribute को मिति मिलेन।',
    'date_equals' => ':attribute मिति बराबर :date हुनुपर्दछ।',
    'date_format' => ':attribute को ढाँचा :format जस्तो हुनुपर्छ।',
    'different' => ':attribute र :other फरक हुनुपर्छ।',
    'digits' => ':attribute :digits अंकको हुनुपर्छ।',
    'digits_between' => ':attribute :min देखी :max अंकको हुनुपर्छ।',
    'dimensions' => ':attribute अमान्य छवि आयाम छ।',
    'distinct' => ':attribute फिल्ड फिल्डको नक्कल मान छ',
    'email' => ':attribute को इमेल ठेगाना मिलेन।',
    'ends_with' => ':attribute निम्न मध्ये एकको साथ विशेषता अन्त हुनुपर्दछ :values',
    'exists' => 'छानिएको :attribute अमान्य छ।',
    'file' => ':attribute एक फाईल हुनुपर्दछ।',
    'filled' => ':attribute दिइएको हुनुपर्छ।',
    'gt' => [
        'array' => ' :attribute :value आईटमहरू भन्दा बढि हुनुपर्दछ।',
        'file' => ' :attribute :value क्यालोबाइट भन्दा बढि हुनुपर्दछ।',
        'numeric' => ' :attribute :value भन्दा बढि हुनुपर्दछ।',
        'string' => ' :attribute :value क्यारेक्टर भन्दा बढि हुनुपर्दछ।',
    ],
    'gte' => [
        'array' => ' :attribute :value आईटमहरू भन्दा बढि हुनुपर्दछ।',
        'file' => ' :attribute :value क्यालोबाइट भन्दा बढि हुनुपर्दछ।',
        'numeric' => ' :attribute :value भन्दा बढि हुनुपर्दछ।',
        'string' => ' :attribute :value क्यारेक्टर भन्दा बढि हुनुपर्दछ।',
    ],
    'image' => ':attribute मा फोटो हुनुपर्छ।',
    'in' => 'छानिएको :attribute अमान्य छ।',
    'in_array' => ':attribute क्षेत्र मा अवस्थित छैन :other',
    'integer' => ':attribute पूर्ण संख्या हुनुपर्छ।',
    'ip' => ':attribute मा दिइएको मान्य IP ठेगाना हुनुपर्छ।',
    'ipv4' => ':attribute एक मान्य IPv4 ठेगाना हुनुपर्दछ.',
    'ipv6' => ':attribute एक मान्य IPv6 ठेगाना हुनुपर्दछ.',
    'json' => ':attribute मा दिइएको मान्य JSON स्ट्रिङ्ग हुनुपर्छ।',
    'lt' => [
        'array' => ' :attribute :value आईटमहरू भन्दा बढि हुनुपर्दछ।',
        'file' => ' :attribute :value क्यालोबाइट भन्दा बढि हुनुपर्दछ।',
        'numeric' => ' :attribute :value भन्दा बढि हुनुपर्दछ।',
        'string' => ' :attribute :value क्यारेक्टर भन्दा बढि हुनुपर्दछ।',
    ],
    'lte' => [
        'array' => ' :attribute :value आईटमहरू भन्दा बढि हुनुपर्दछ।',
        'file' => ' :attribute :value क्यालोबाइट भन्दा बढि हुनुपर्दछ।',
        'numeric' => ' :attribute :value भन्दा बढि हुनुपर्दछ।',
        'string' => ' :attribute :value क्यारेक्टर भन्दा बढि हुनुपर्दछ।',
    ],
    'max' => [
        'array' => ' :attribute मा :max आईटमहरू भन्दा बढि हुनुपर्दछ।',
        'file' => ' :attribute :max क्यालोबाइट भन्दा बढि हुनुपर्दछ।',
        'numeric' => ' :attribute :max भन्दा बढि हुनुपर्दछ।',
        'string' => ' :attribute :max क्यारेक्टर भन्दा बढि हुनुपर्दछ।',
    ],
    'mimes' => ' :attribute :values प्रकारको फाइल हुनुपर्छ।',
    'mimetypes' => ' :attribute :values प्रकारको फाइल हुनुपर्छ।',
    'min' => [
        'array' => ':attribute मा कम्तिमा :min आइटम हुनुपर्छ।',
        'file' => ':attribute कम्तिमा :min क्यालोबाइटोकाे हुनुपर्छ।',
        'numeric' => ':attribute कम्तिमा :min हुनुपर्छ।',
        'string' => ':attribute कम्तिमा :min वर्णको हुनुपर्छ।',
    ],
    'multiple_of' => 'यो :attribute को एक धेरै हुनुपर्छ :value',
    'not_in' => 'छानिएको :attribute अमान्य छ।',
    'not_regex' => ':attribute ढाँचा अवैध छ.',
    'numeric' => ':attribute संख्या हुनुपर्छ।',
    'password' => 'पासवर्ड गलत छ।',
    'present' => ':attribute क्षेत्र उपस्थित हुनुपर्दछ.',
    'prohibited' => 'यो :attribute क्षेत्र निषेध छ । ',
    'prohibited_if' => 'यो :attribute क्षेत्र निषेध छ जब :other छ :value.',
    'prohibited_unless' => 'यो :attribute क्षेत्र निषेध छ नभएसम्म :other छ :values.',
    'regex' => ':attribute को ढाँचा मिलेन।',
    'relatable' => 'यो :attribute हुन सक्छ, यस संग सम्बन्धित संसाधन । ',
    'required' => ':attribute दिइएको हुनुपर्छ।',
    'required_if' => ':attribute चाहिन्छ जब :other :value हुन्छ।',
    'required_unless' => ':other :values मा नभएसम्म :attribute चाहिन्छ।',
    'required_with' => ':values भएसम्म :attribute चाहिन्छ।',
    'required_with_all' => ':values भएसम्म :attribute चाहिन्छ।',
    'required_without' => ':values नभएको बेला :attribute चाहिन्छ।',
    'required_without_all' => 'कुनैपनि :values नभएको बेला :attribute चाहिन्छ।',
    'same' => ':attribute र :other मिल्नुपर्छ।',
    'size' => [
        'array' => ':attribute :sizeमा आइटम हुनुपर्छ।',
        'file' => ':attribute :size क्यालोबाइटोकाे हुनुपर्छ।',
        'numeric' => ':attribute :size हुनुपर्छ।',
        'string' => ':attribute :size वर्णको हुनुपर्छ।.',
    ],
    'starts_with' => ':attribute निम्न मध्ये एकसँग सुरू हुनुपर्दछ :values',
    'string' => ':attribute स्ट्रिङ्ग हुनुपर्छ।',
    'timezone' => ':attribute मान्य समय क्षेत्र हुनुपर्छ।',
    'unique' => 'यो :attribute पहिले नै लिई सकेको छ।',
    'uploaded' => ':attribute अपलोड गर्न असफल भयो।',
    'url' => ':attribute को ढांचा मिलेन।',
    'uuid' => ':attribute एक मान्य UUID हुनुपर्दछ।',
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'attributes' => [],

    'pages' => [
        'roles' => [
            'name_max' => 'भूमिकाको नाम 255 वर्ण भन्दा कम हुनु पर्छ',
            'name_required' => 'भूमिका नाम  अनिवार्य छ।',
            'name_unique' => 'भूमिका नाम पहिले नै लिइएको छ। कृपया अर्को प्रयास गर्नुहोस्!',
        ],

        'users_management' => [
            'avatar_image_max' => 'साइज १ MB भन्दा कम हुनुपर्छ।',
            'avatar_image_mimes' => 'अपलोड प्रकार jpg, jpeg, png हुनुपर्छ।',
            'email_required' => 'इमेल ठेगाना अनिवार्य छ',
            'email_unique' => 'ईमेल ठेगाना प्रयोग भैसकेको छ । कृपया अर्को ईमेल ठेगाना राखनुहोस',
            'full_name_required' => 'पुरा नाम अनिवार्य छ',
            'login_user_name_required' => 'लगइन प्रयोगकर्ता नाम अनिवार्य छ.',
            'login_user_name_unique' => 'लगइन प्रयोगकर्ता नाम प्रयोग भैसकेको छ । कृपया अर्को  राखनुहोस',
            'role_id' => 'प्रयोगकर्ता प्रकार अनिवार्य छ.',
        ],
        'common' => [

            'name_np_required' => 'नेपाली नाम  अनिवार्य छ ।',
            'name_en_required' => 'अंग्रेजी नाम  अनिवार्य छ ।',
            'mandatory_field_message' => '[ नोट : अनिवार्य फिल्डहरु लाई (*) ले जनाईएको छ ]',
            'file_required' => 'फाइल  अनिवार्य छ ।',
            'file_type_message' => 'फाइलको  प्रकार csv , xls र xlsx मात्र हुनुपर्छ।',
        ],
        'meeting_member' => [
            'meeting' => 'बैठक आईडी अनिवार्य छ',
            'client' => 'ग्राहक आईडी अनिवार्य छ',
            'name' => 'नाम  field अनिवार्य छ',
            'office' => 'कार्यालय अनिवार्य छ.',
            'post' => 'पोस्ट अनिवार्य छ.',
            'contact_no' => 'अवैध !! सम्पर्क नम्बर ९८ बाट सुरु हुनुपर्छ',
            'email' => 'कृपया वैध इमेल प्रदान गर्नुहोस्',
        ],
    ],
];
