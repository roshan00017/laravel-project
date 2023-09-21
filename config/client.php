<?php

return [

    'client_id' => env('CLIENT_ID', 1),

    //voice text api details
    'voice_api_url' => env('VOICE_API_URL', 'https://riri.prixa.net/api/speak/'),
    'voice_api_token' => env('VOICE_API_TOKEN', '51F22pwc6sKmXpC5JYOFuHmpbB7eXSigV0l2H57kdaHx2jaXRGpu0CIOFFzLq2UWcej2NFybLdTEKXhdXdHItmC0tVes4SkSZ7Xj2EkbNJKVgOkvPCJupa1Uo6LxXCO4'),
    'voice_api_type' => env('VOICE_API_TYPE', 'np_rija'),

    //call sam api details
    'call_sms_api_url' => env('CALL_SMS_API_URL', 'https://tingting.io/api'),
    'call_sms_api_user_name' => env('CALL_SMS_API_USER_NAME', 'f75f42cc-6269-4d9a-a6d9-fc945a96ac88@email.webhook.site'),
    'call_sms_api_user_password' => env('CALL_SMS_API_USER_PASSWORD', '2wiI3FYCuM'),
];
