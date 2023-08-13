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

    //===================================================================================
    // CITIES============================================================================
    //===================================================================================
    'city.name.required'=>'City Name Is Required',
    'city.name.string'=>'Some thing wrong please try again',
    'city.name.max'=>'City Name Should Be At Max 30 Char',
    'city.state_id.required'=>'Please Select the State',
    'city.state_id.numeric'=>'Some thing wrong please try again',
    'city.state_id.exists'=>'Some thing wrong please try again',

    //===================================================================================
    // ZONES=============================================================================
    //===================================================================================
    'zone.name.required'=>'Zone Name Is Required',
    'zone.name.string'=>'Some Thing Wrong Please Try Again',
    'zone.name.min'=>'Zone Name Should Be At Least 3 Char',
    'zone.name.max'=>'Zone Name Is Too Long',
    'zone.name.unique'=>'Zone Name Is Already Taken',
    'zone.city_id.required'=>'Some Thing Wrong Please Try Again',
    'zone.city_id.numeric'=>'Some Thing Wrong Please Try Again',
    'zone.city_id.exists'=>'Some Thing Wrong Please Try Again',
    'zone.store_id.required'=>'Some Thing Wrong Please Try Again',
    'zone.store_id.numeric'=>'Some Thing Wrong Please Try Again',
    'zone.store_id.exists'=>'Some Thing Wrong Please Try Again',
    'zone.status.required'=>'Please Select Status',
    'zone.status.boolean'=>'Some Thing Wrong Please Try Again',
    'zone.postal_codes.required'=>'Please Select At Least One Postal Code',
    'zone.postal_codes.string'=>'Some Thing Wrong Please Try Again',
    'zone.postal_codes.regex'=>'Please Enter A Valid Postal Codes',

    //===================================================================================
    // STORES============================================================================
    //===================================================================================
    'store.delete.failed' => 'You cannot delete this store because it is already in use.',


    //===================================================================================
    // CATEGORY==========================================================================
    //===================================================================================
    'category.delete.failed' => 'You cannot delete this category because it is already in use.',


];
