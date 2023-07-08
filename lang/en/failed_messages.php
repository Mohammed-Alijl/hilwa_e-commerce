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
    // ATTACHMENTS=======================================================================
    //===================================================================================
    'attachment.add'=>'The attachment could not be added, please try again',
    'attachment.delete'=>'The attachment could not be deleted, please try again',
    'attachment.invoice_id.required'=>'Invoice id is required',
    'attachment.invoice_id.integer'=>'Invoice Number should be only numbers',
    'attachment.invoice_id.exists'=>'The invoice is not exists',
    'attachment.invoice_number.required'=>'Invoice number is required',
    'attachment.invoice_number.numeric'=>'Invoice Number should be only numbers',
    'attachment.invoice_number.exists'=>'Invoice Number is wrong',
    'attachment.pic.mimes'=>'Attachments must be in pdf, jpg, png, or jpeg format',
    'attachment.pic.max'=>'Attachment size is too large',

    //===================================================================================
    // USERS=============================================================================
    //===================================================================================
    'first_name.required' => 'Please enter the first name.',
    'first_name.max' => 'The first name is longer than necessary.',
    'last_name.required' => 'Please enter the last name.',
    'last_name.max' => 'The last name is longer than necessary.',
    'email.required' => 'Please enter the email address.',
    'email.email' => 'Please enter a valid email address.',
    'email.unique' => 'This email address is already in use.',
    'password.required' => 'Please enter the password.',
    'password.same' => 'The password and its confirmation do not match. Please try again.',
    'roles_name.array' => 'An error occurred. Please try again.',
    'roles_name.required' => 'An error occurred. Please try again.',
    'roles_name.exists' => 'An error occurred. Please try again.',
    'pic.mimes' => 'Please select an image with the following extensions: jpeg, jpg, png, svg.',
    'pic.max' => 'The image size is too large. Please choose a smaller profile picture.',
    'code.required' => 'The code is required.',
    'code.string' => 'Please enter the code correctly.',
    'code.size' => 'The code must be 8 characters long.',
    'mobile_number.required' => 'The mobile number is required.',
    'mobile_number.string' => 'Please enter a valid phone number.',
    'mobile_number.regex' => 'The mobile number must consist of 10 digits.',
    'city_id.required' => 'Please select the city.',
    'city_id.numeric' => 'An error occurred. Please try again.',
    'city_id.exists' => 'An error occurred. Please try again.'
];
