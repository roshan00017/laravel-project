<?php

return [

    'suggestion' => [
        'name' => 'The name field is required.',
        'name_min' => 'The name must be at least 3 characters.',
        'name_max' => 'The name may not be greater than 100 characters.',
        'mobile' => 'The mobile field is required.',
        'mobile_digits' => 'The mobile must be a 10-digit number.',
        'email' => 'The email field is required.',
        'email_email' => 'The email must be a valid email address.',
        'address_info' => 'The address field is required.',
        'suggestion_category_id' => 'The suggestion category field is required.',
        'suggestions' => 'The suggestions field is required.',
        'suggestion_file_mimes' => 'The suggestion file must be a JPEG, JPG, PNG, or PDF.',
        'suggestion_file_max' => 'The suggestion file may not be greater than 2048 kilobytes.',
    ],

    'registercomplaint' => [
        'form_category_id' => 'The form category field is required.',
        'severity_type_id' => 'The severity type field is required.',
        'description' => 'The description field is required.',
        'title' => 'The title field is required.',
        'title_min' => 'The title must have at least 3 characters.',
        'title_max' => 'The title may not exceed 100 characters.',
        'office_id' => 'The office field must be nullable.',
        'file_name' => 'The file name field must be nullable.',
        'file_name_mimes' => 'The file must be of type: jpg, png, pdf.',
        'file_name_max' => 'The file size must not exceed 2048 kilobytes.',
        'name_ne' => 'The name field is required.',
        'name_ne_min' => 'The name must be at least 3 characters.',
        'name_ne_max' => 'The name may not be greater than 100 characters.',
        'tole' => 'The address field is required.',
        'tole_min' => 'The address must be at least 3 characters.',
        'tole_max' => 'The address may not be greater than 100 characters.',
        'mobile_no' => 'The mobile number field is required.',
        'mobile_numeric' => 'The mobile field must be a numeric value.',
        'mobile_no_digits' => 'The mobile number must be exactly 10 digits.',
        'email' => 'The email field is required.',
        'email_email' => 'The email must be a valid email address.',
    ],

    'appointment' => [
        'appointment_time' => 'The appointment time field is required.',
        'appointment_section' => 'The appointment section field is required.',
        'appointment_to_emp_designation' => 'The appointment to employee designation field is required.',
        'appointment_to_elected_designation' => 'The appointment to elected designation field is required.',
        'appointment_purpose_id' => 'The appointment purpose field is required.',

    ],

];
