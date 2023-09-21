<?php

return [

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

    'authBlock' => 'Your account is now blocked. Please contact your administrator !',
    'authInactive' => 'Your account is not active yet. Please contact your administrator !',
    'authUnknown' => 'Too many login attempts.Your  IP  is now blocked.',
    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'username_or_email_does_not_exist' => 'Username or Email Does not exist !',
    'emailFailed' => 'Email Does not exist !',
    'invalid_password' => 'Invalid  Password.',

    'login' => [
        'captcha_required' => 'Captcha cannot be empty',
        'captcha_confirm' => 'Captcha invalid.',
        'identity_required' => 'Email or username cannot be empty',
        'role_required' => 'Role cannot be empty',
        'email_required' => 'Email cannot be empty',
        'logout_message' => 'You have been successfully logged out!',
        'password_min' => 'Password must me 6 characters long',
        'password_required' => 'Password cannot be empty',
        'invalid_username_or_password' => 'Invalid User Name or Password.',

        'login_attempt_message' => 'Invalid User Name or Password. You are last Attempt',
        'password_update_message' => 'Password  Has Been Successfully Updated',
    ],

    'passwordReset' => [
        'password_link_message' => 'Password reset successfully!
                        Please check the email for the password link.',
        'title' => 'Password Reset',
        'head_title' => 'Hello',
        'head_sub_title' => '',
        'link_title' => 'You have requested to reset your password',
        'link_message' => 'We cannot simply send you your old password. A unique link to reset your
                                        password has been generated for you. To reset your password, click the
                                        following link and follow the instructions.',
        'pass_link_duration' => 'The password reset link has expired! Please request a password reset link.',
        'password_changed_message' => 'Your password has been changed! Log in with a new password.',
        'token_valid_message' => 'Token does not match, please enter a valid token.',
    ],

    'addUser' => [
        'title' => 'User Registration Information',
        'profile_message_h1' => ' Your Profile has been successfully created.',
        'profile_message_h2' => ' Please protect your login information. ',
        'profile_message_h3' => 'Don not share with anyone.',
        'login_user_name' => 'Login User Name',
        'login_email' => 'Login Email Address',
        'login_password' => 'Password',
        'for_login ' => 'For Login',
        'clickHere' => 'Click Here',
        'head' => '',
    ],

];
