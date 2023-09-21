<?php

/*
|--------------------------------------------------------------------------
| Authentication Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used during authentication for various
| messages that we need to display to the user. You are free to modify
| these language lines according to your application's requirements.
|
*/

return [
    'authBlock' => 'तपाईंको खाता अवरुद्ध छ। कृपया आफ्नो प्रशासकलाई सम्पर्क गर्नुहोस्!',
    'authInactive' => 'तपाईंको खाता सक्रिय छैन। कृपया आफ्नो प्रशासकलाई सम्पर्क गर्नुहोस्!',
    'authUnknown' => 'धेरै लगइन प्रयासहर भएको ले । तपाईंको आईपी  बन्द   गरिएको  छ।',
    'failed' => 'यी प्रमाणहरू हाम्रो रेकर्ड संग मेल खादैनन्।',
    'password' => 'प्रदान गरिएको पासवर्ड गलत छ।',
    'throttle' => 'धेरै लगिन प्रयास भयो :seconds सेकेन्ड पछि फेरि प्रयास गर्नुहोस्।',
    'username_or_email_does_not_exist' => 'प्रयोगकर्ता नाम वा इमेल हाम्रो रेकर्ड संग मेल खाएन !',
    'invalid_password' => 'पासवर्ड  मिलेन.',
    'emailFailed' => 'इमेल हाम्रो रेकर्ड संग मेल खाएन !',

    'login' => [
        'captcha_required' => 'Captcha अनिवार्य छ',
        'captcha_confirm' => 'Captcha मिलेन',
        'identity_required' => 'प्रयोगकर्ता नाम वा इमेल अनिवार्य छ',
        'role_required' => 'प्रयोगकर्ता भूमिका अनिवार्य छ',
        'email_required' => 'इमेल अनिवार्य छ',
        'logout_message' => 'तपाई सफलतापूर्वक लग आउट हुनुभयो!',
        'password_min' => 'पासवर्ड ६  को  वर्ण लामो हुनुपर्छ',
        'password_required' => 'पासवर्ड अनिवार्य छ',
        'invalid_username_or_password' => 'प्रयोगकर्ता नाम वा पासवर्ड हाम्रो रेकर्ड संग मेल खाएन',
        'login_attempt_message' => 'अवैध प्रयोगकर्ता नाम वा पासवर्ड | तपाई अन्तिम प्रयास हुनुहुन्छ ',
        'password_update_message' => 'पासवर्ड सफलतापूर्वक अद्यावधिक गरिएको छ',

    ],

    'passwordReset' => [
        'password_link_message' => 'पासवर्ड रिसेट  सफलतापूर्वक  भएको छ !
                        कृपया पासवर्ड लिङ्क को लागि ईमेल  जाँच गर्नुहोस् ।',
        'title' => 'पासवर्ड रिसेट',
        'head_title' => 'नमस्कार ! ,',
        'head_sub_title' => 'ज्यु,',
        'link_title' => 'तपाईंले आफ्नो पासवर्ड रिसेट गर्न अनुरोध गर्नुभएको छ',
        'link_message' => 'तलको लिङ्क क्लिक गर्नुहोस् र आफ्नो पासवर्ड रिसेट गर्नुहोस्',
        'pass_link_duration' => 'पासवर्ड रिसेट Link को समयअवधि  सकिएको छ !   कृपया पासवर्ड रिसेट Link को लागि अनुरोध  गर्नुहोस् । ',
        'password_changed_message' => 'तपाईंको पासवर्ड परिवर्तन गरिएको छ! नया पासवर्ड राखेर लग - इन गर्नुहोस ।',
        'token_valid_message' => 'टोकन मिलेन कृपया Valid टोकन राखनुहोस ',
    ],
    'addUser' => [
        'title' => 'प्रयोगकर्ता दर्ता जानकारी',
        'head' => 'मा',
        'profile_message_h1' => 'तपाईंको प्रोफाइल सफलतापूर्वक दर्ता भएको छ ।',
        'profile_message_h2' => 'कृपया तपाईको लगईन सम्बन्धी जानकारी',
        'profile_message_h3' => 'संवेदनशील हुने हुँदा गोपनियता कायम गरी सुरक्षित राख्नुहोला ।',
        'login_user_name' => 'लगइन प्रयोगकर्ता नाम',
        'login_email' => 'लगइन इमेल ठेगाना',
        'login_password' => 'लगइन पासवर्ड',
        'for_login' => 'लगइनको लागि',
        'clickHere' => 'यहाँ क्लिक गर्नुहोस्',
    ],
];
