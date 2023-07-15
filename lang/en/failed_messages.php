<?php


return [
    /*
    |--------------------------------------------------------------------------
    | Failed Messages
    |--------------------------------------------------------------------------
    |
    | The following language lines are the english lines which match reasons
    | that in any filed occur in any position in the system
    |
    */

    //===================================================================================
    // PUBLIC============================================================================
    //===================================================================================
    'failed'=>'There was a problem, please try again',
    'authorize'=>'You are not authorized',


    //===================================================================================
    // USERS=============================================================================
    //===================================================================================
    'user.first_name.required' => 'Please enter the first name.',
    'user.first_name.max' => 'The first name is longer than necessary.',
    'user.last_name.required' => 'Please enter the last name.',
    'user.last_name.max' => 'The last name is longer than necessary.',
    'user.email.required' => 'Please enter the email address.',
    'user.email.email' => 'Please enter a valid email address.',
    'user.email.unique' => 'This email address is already in use.',
    'user.password.required' => 'Please enter the password.',
    'user.password.same' => 'The password and its confirmation do not match. Please try again.',
    'user.roles_name.required' => 'The role is required',
    'user.roles_name.exists' => 'An error occurred. Please try again.',
    'user.pic.mimes' => 'Please select an image with the following extensions: jpeg, jpg, png, svg.',
    'user.pic.max' => 'The image size is too large. Please choose a smaller profile picture.',
    'user.code.required' => 'The code is required.',
    'user.code.string' => 'Please enter the code correctly.',
    'user.code.size' => 'The code must be 8 characters long.',
    'user.mobile_number.required' => 'The mobile number is required.',
    'user.mobile_number.string' => 'Please enter a valid phone number.',
    'user.mobile_number.regex' => 'The mobile number must consist of 10 digits.',
    'user.city_id.required' => 'Please select the city.',
    'user.city_id.numeric' => 'An error occurred. Please try again.',
    'user.city_id.exists' => 'An error occurred. Please try again.',


    //===================================================================================
    // SETTINGS==========================================================================
    //===================================================================================
    'setting.display_name.required'=>'Display name is required',
    'setting.display_name.string'=>'Some thing wrong please try again',
    'setting.namespace.required'=>'Namespace is required',
    'setting.namespace.string'=>'Some thing wrong please try again',
    'setting.key.required'=>'Key is required',
    'setting.key.string'=>'Some thing wrong please try again',
    'setting.key.unique'=>'Key is already exists',
    'setting.type.required'=>'Please select the type of value',
    'setting.type.in'=>'Please select the type of value',
    'setting.value.required'=>'Value is required',
];
