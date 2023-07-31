@extends('layouts.master')
@section('title',__('Front-end/pages/users.add.title'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
        <link class="js-stylesheet" href="{{URL::asset('css/app.rtl.css')}}" rel="stylesheet">
    @else
        <link class="js-stylesheet" href="{{URL::asset('css/light.css')}}" rel="stylesheet">
    @endif
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{__('Front-end/pages/users.users')}}</strong> {{__('Front-end/pages/users.add')}}</h3>
        </div>
    </div>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{__('Front-end/pages/users.add.title')}}</h5>
                <h6 class="card-subtitle text-muted">{{__('Front-end/pages/users.add.description')}}</h6>
            </div>
            <div class="card-body">
                <form action="{{route('admins.store')}}" method="post" enctype="multipart/form-data" id="create_user"
                      class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="first_name">{{__('Front-end/pages/users.first.name')}}</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                   placeholder="{{__('Front-end/pages/users.first.name')}}" autocomplete="off" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.first_name.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.first_name.invalid')}}
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="last_name">{{__('Front-end/pages/users.last.name')}}</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                   placeholder="{{__('Front-end/pages/users.last.name')}}" autocomplete="off" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.last_name.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.last_name.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">{{__('Front-end/pages/users.email')}}</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="{{__('Front-end/pages/users.email')}}" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.email.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.email.invalid')}}
                            </div>
                            <div id="email-validation-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="mobile_number" class="form-label">{{__('Front-end/pages/users.mobile')}}</label>
                            <div class="input-group">
                                <span class="input-group-text" id="mobile_number">05</span>
                                <input type="text" class="form-control" id="mobile_number"
                                       aria-describedby="inputGroupPrepend" name="mobile_number" autocomplete="off"
                                       placeholder="{{__('Front-end/pages/users.mobile')}}"
                                       required maxlength="8" pattern=".{8,8}"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                >
                                <div id="mobile-validation-feedback"></div>

                                <div class="valid-feedback">
                                    {{__('Front-end/pages/users.user.mobile_number.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/users.user.mobile_number.invalid')}}
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="inputPassword">{{__('Front-end/pages/users.password')}}</label>
                            <input type="password" class="form-control" name="password" id="inputPassword"
                                   placeholder="{{__('Front-end/pages/users.password')}}" autocomplete="off" required
                                   minlength="8">
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.password.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.password.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="inputPasswordConfirm">{{__('Front-end/pages/users.password.confirm')}}</label>
                            <input type="password" class="form-control" id="inputPasswordConfirm"
                                   name="confirm-password"
                                   placeholder="{{__('Front-end/pages/users.password.confirm')}}" autocomplete="off"
                                   required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.password.confirm.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.password.confirm.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="inputAddress">{{__('Front-end/pages/users.address')}}</label>
                        <input type="text" class="form-control" name="address" id="inputAddress" autocomplete="off"
                               placeholder="1234 Main St" maxlength="255">
                        <div class="valid-feedback">
                            {{__('Front-end/pages/users.user.address.valid')}}
                        </div>
                        <div class="invalid-feedback">
                            {{__('Front-end/pages/users.user.address.invalid')}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="inputCountry">{{__('Front-end/pages/users.country')}}</label>
                            <select id="inputCountry" class="form-control" disabled>
                                <option
                                    selected>{{__('Front-end/country.' . \App\Models\Country::first()->name)}}</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="inputState">{{__('Front-end/pages/users.state')}}</label>
                            <select id="inputState" class="form-control choices-single" required>
                                <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{__('Front-end/states.' . $state->name)}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.state.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.state.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="inputCity">{{__('Front-end/pages/users.city')}}</label>
                            <select id="inputCity" name="city_id" class="form-control choices-single" required>
                                <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.city.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.city.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" class="form-check m-0">
                            <input type="checkbox" class="form-check-input" name="limit_state">
                            <span class="form-check-label">{{__('Front-end/pages/users.limit.access.state')}}</span>
                        </label>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputRole">{{__('Front-end/pages/users.role')}}</label>
                            <select name="roles_name" id="inputRole" class="form-control choices-single" required>
                                <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.role.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.role.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="inputEmail4">{{__('Front-end/pages/users.profile.image')}}</label>
                            <input type="file" class="form-control" id="inputEmail4" name="pic" autocomplete="off"
                                   accept=".jpg, .jpeg, .png, .svg">
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.profile.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.profile.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="code">{{__('Front-end/pages/users.code')}}</label>
                            <input type="text" class="form-control" id="code" name="code"
                                   placeholder="{{__('Front-end/pages/users.code')}}" autocomplete="off" required
                                   minlength="8" maxlength="8">
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.code.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.code.invalid')}}
                            </div>
                            <div id="code-validation-feedback"></div>

                        </div>
                    </div>
                    <button id="save_user" type="submit"
                            class="btn btn-primary">{{__('Front-end/pages/users.submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new Choices(document.querySelector("#inputState"));
            new Choices(document.querySelector("#inputRole"));
            // Choices.js
            var citySelect = new Choices(document.querySelector("#inputCity"), {
                removeItemButton: true,
            });

            // Ajax function to update the city options
            function updateCityOptions(StateId) {
                if (StateId) {
                    $.ajax({
                        url: "{{ URL::to('state-cities') }}/" + StateId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var cityOptions = []; // Array to hold the city options
                            $.each(data, function (key, value) {
                                cityOptions.push({ value: key, label: value }); // Add each city as an object to the array
                            });
                            citySelect.setChoices(cityOptions, 'value', 'label', true); // Set all city options at once
                        },
                    });
                } else {
                    citySelect.clearChoices(); // Clear the choices when no state is selected
                }
            }

            // Call the updateCityOptions function when the state selection changes
            $('#inputState').on('change', function () {
                var StateId = $(this).val();
                updateCityOptions(StateId);

                // Clear the selected city when the state changes
                citySelect.clearStore();
            });

            // Call the updateCityOptions function initially to populate cities based on the default state selection
            var defaultStateId = $('#inputState').val();
            updateCityOptions(defaultStateId);

            // Flatpickr initialization and other code if any
            flatpickr(".flatpickr-minimum");
            flatpickr(".flatpickr-datetime", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
            flatpickr(".flatpickr-human", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });
            flatpickr(".flatpickr-multiple", {
                mode: "multiple",
                dateFormat: "Y-m-d",
            });
            flatpickr(".flatpickr-range", {
                mode: "range",
                dateFormat: "Y-m-d",
            });
            flatpickr(".flatpickr-time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });
        });
    </script>

    <script>
        (function () {
            'use strict';

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation');

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add('was-validated');
                    }, false);
                });
        })();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get the form element
            const form = document.getElementById("create_user");

            // Get password input and confirm password input
            const passwordInput = document.getElementById("inputPassword");
            const confirmPasswordInput = document.getElementById("inputPasswordConfirm");

            // Event listener for password input change
            passwordInput.addEventListener("input", function () {
                validatePassword();
                validateConfirmPassword();
            });

            // Event listener for confirm password input change
            confirmPasswordInput.addEventListener("input", validateConfirmPassword);

            // Event listener for form submission
            form.addEventListener("submit", function (event) {
                validatePassword();
                validateConfirmPassword();

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
            });

            // Function to validate the password
            function validatePassword() {
                const isPasswordValid = passwordInput.value.length >= 8;
                passwordInput.classList.toggle("is-valid", isPasswordValid);
                passwordInput.classList.toggle("is-invalid", !isPasswordValid);
            }

            // Function to validate the confirm password
            function validateConfirmPassword() {
                const doPasswordsMatch = confirmPasswordInput.value === passwordInput.value;
                confirmPasswordInput.classList.toggle("is-valid", doPasswordsMatch);
                confirmPasswordInput.classList.toggle("is-invalid", !doPasswordsMatch);
                confirmPasswordInput.setCustomValidity(doPasswordsMatch ? "" : "Passwords do not match");
            }
        });
    </script>


    {{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#save_user').click(function(event) {--}}
{{--                // event.preventDefault(); // Prevent the default form submission--}}

{{--                var form = $(this);--}}
{{--                var email = $('#email').val();--}}
{{--                var mobileNumber = $('#mobile_number').val();--}}
{{--                var code = $('#code').val();--}}

{{--                // Perform the validation checks--}}
{{--                validateEmail(email);--}}
{{--                validateMobileNumber(mobileNumber);--}}
{{--                validateCode(code);--}}

{{--                // If there are no validation errors, submit the form using AJAX--}}
{{--                if (form[0].checkValidity() && $('#email-validation-feedback').is(':empty') && $('#mobile-validation-feedback').is(':empty') && $('#code-validation-feedback').is(':empty')) {--}}
{{--                    var formData = new FormData(form[0]);--}}

{{--                    $.ajax({--}}
{{--                        url: '/laravel/hilwa/public/users/store',--}}
{{--                        method: 'post',--}}
{{--                        data: formData,--}}
{{--                        processData: false,--}}
{{--                        contentType: false,--}}
{{--                        headers: {--}}
{{--                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                        },--}}
{{--                        success: function (response) {--}}
{{--                            // Handle the success response--}}
{{--                            console.log('Form submitted successfully');--}}
{{--                            window.location.href = response.redirect; // Redirect to the specified URL--}}
{{--                        },--}}
{{--                        error: function (xhr, status, error) {--}}
{{--                            // Handle the error response--}}
{{--                            console.error('Error submitting the form');--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}

{{--            // Email validation--}}
{{--            $('#email').on('blur', function () {--}}
{{--                var email = $(this).val();--}}
{{--                validateEmail(email);--}}
{{--            });--}}

{{--            // Mobile number validation--}}
{{--            $('#mobile_number').on('blur', function () {--}}
{{--                var mobileNumber = $(this).val();--}}
{{--                validateMobileNumber(mobileNumber);--}}
{{--            });--}}

{{--            // Code validation--}}
{{--            $('#code').on('blur', function () {--}}
{{--                var code = $(this).val();--}}
{{--                validateCode(code);--}}
{{--            });--}}

{{--            function validateEmail(email) {--}}
{{--                $.ajax({--}}
{{--                    url: '/laravel/hilwa/public/check-email',--}}
{{--                    method: 'POST',--}}
{{--                    data: {--}}
{{--                        email: email--}}
{{--                    },--}}
{{--                    headers: {--}}
{{--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                    },--}}
{{--                    success: function (response) {--}}
{{--                        if (response.exists) {--}}
{{--                            $('#email-validation-feedback').html('<div style="color: red;font-size: 10px">Email is already in use.</div>').show();--}}
{{--                            $('#save_user').click(function(event) {--}}
{{--                                event.preventDefault(); // Prevent the default form submission--}}
{{--                            });--}}
{{--                        } else {--}}
{{--                            $('#email-validation-feedback').html('<div class="valid-feedback">Email is available.</div>').show();--}}
{{--                        }--}}
{{--                    },--}}
{{--                    error: function (xhr, status, error) {--}}
{{--                        console.error('Error checking email availability');--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}

{{--            function validateMobileNumber(mobileNumber) {--}}
{{--                $.ajax({--}}
{{--                    url: '/laravel/hilwa/public/check-mobile',--}}
{{--                    method: 'POST',--}}
{{--                    data: {--}}
{{--                        mobile_number: mobileNumber--}}
{{--                    },--}}
{{--                    headers: {--}}
{{--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                    },--}}
{{--                    success: function (response) {--}}
{{--                        if (response.exists) {--}}
{{--                            $('#mobile-validation-feedback').html('<div style="color: red;font-size: 10px">Mobile number is already in use.</div>').show();--}}
{{--                            $('#save_user').click(function(event) {--}}
{{--                                event.preventDefault(); // Prevent the default form submission--}}
{{--                            });--}}
{{--                        } else {--}}
{{--                            $('#mobile-validation-feedback').html('<div class="valid-feedback">Mobile number is available.</div>').show();--}}
{{--                        }--}}
{{--                    },--}}
{{--                    error: function (xhr, status, error) {--}}
{{--                        console.error('Error checking mobile number availability');--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}

{{--            function validateCode(code) {--}}
{{--                $.ajax({--}}
{{--                    url: '/laravel/hilwa/public/check-code',--}}
{{--                    method: 'POST',--}}
{{--                    data: {--}}
{{--                        code: code--}}
{{--                    },--}}
{{--                    headers: {--}}
{{--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                    },--}}
{{--                    success: function (response) {--}}
{{--                        if (response.exists) {--}}
{{--                            $('#code-validation-feedback').html('<div style="color: red;font-size: 10px">Code is already in use.</div>').show();--}}
{{--                            $('#save_user').click(function(event) {--}}
{{--                                event.preventDefault(); // Prevent the default form submission--}}
{{--                            });--}}
{{--                        } else {--}}
{{--                            $('#code-validation-feedback').html('<div class="valid-feedback">Code is available.</div>').show();--}}
{{--                        }--}}
{{--                    },--}}
{{--                    error: function (xhr, status, error) {--}}
{{--                        console.error('Error checking code availability');--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}




{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            var form = $('form');--}}

{{--            form.on('submit', function (event) {--}}
{{--                event.preventDefault(); // Prevent default form submission--}}

{{--                var email = $('#email').val();--}}
{{--                var mobileNumber = $('#mobile_number').val();--}}
{{--                var code = $('#code').val();--}}

{{--                // Perform the validation checks--}}
{{--                var emailPromise = validateEmail(email);--}}
{{--                var mobilePromise = validateMobileNumber(mobileNumber);--}}
{{--                var codePromise = validateCode(code);--}}

{{--                // Initialize validationFailed flag--}}
{{--                var validationFailed = false;--}}

{{--                // Wait for all AJAX requests to complete--}}
{{--                Promise.all([emailPromise, mobilePromise, codePromise])--}}
{{--                    .then(function (results) {--}}
{{--                        var isEmailValid = results[0];--}}
{{--                        var isMobileValid = results[1];--}}
{{--                        var isCodeValid = results[2];--}}

{{--                        // Check if any validation check failed--}}
{{--                        if (!isEmailValid || !isMobileValid || !isCodeValid) {--}}
{{--                            validationFailed = true;--}}
{{--                        }--}}

{{--                        // If validation failed, prevent form submission--}}
{{--                        if (validationFailed) {--}}
{{--                            event.preventDefault();--}}
{{--                        } else {--}}
{{--                            // Validation passed, submit the form--}}
{{--                            form.off('submit').submit();--}}
{{--                        }--}}
{{--                    })--}}
{{--                    .catch(function (error) {--}}
{{--                        console.error('Error during form submission:', error);--}}
{{--                        event.preventDefault(); // Prevent form submission in case of an error--}}
{{--                    });--}}
{{--            });--}}

{{--            // Email validation--}}
{{--            function validateEmail(email) {--}}
{{--                return new Promise(function (resolve, reject) {--}}
{{--                    $.ajax({--}}
{{--                        url: '/laravel/hilwa/public/check-email',--}}
{{--                        method: 'POST',--}}
{{--                        data: {--}}
{{--                            email: email--}}
{{--                        },--}}
{{--                        headers: {--}}
{{--                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                        },--}}
{{--                        success: function (response) {--}}
{{--                            if (response.exists) {--}}
{{--                                $('#email-validation-feedback').html('<div style="color: red;font-size: 10px">Email is already in use.</div>').show();--}}
{{--                                resolve(false);--}}
{{--                            } else {--}}
{{--                                $('#email-validation-feedback').html('<div class="valid-feedback">Email is available.</div>').show();--}}
{{--                                resolve(true);--}}
{{--                            }--}}
{{--                        },--}}
{{--                        error: function (xhr, status, error) {--}}
{{--                            console.error('Error checking email availability');--}}
{{--                            reject(error);--}}
{{--                        }--}}
{{--                    });--}}
{{--                });--}}
{{--            }--}}

{{--            // Mobile number validation--}}
{{--            function validateMobileNumber(mobileNumber) {--}}
{{--                return new Promise(function (resolve, reject) {--}}
{{--                    $.ajax({--}}
{{--                        url: '/laravel/hilwa/public/check-mobile',--}}
{{--                        method: 'POST',--}}
{{--                        data: {--}}
{{--                            mobile_number: mobileNumber--}}
{{--                        },--}}
{{--                        headers: {--}}
{{--                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                        },--}}
{{--                        success: function (response) {--}}
{{--                            if (response.exists) {--}}
{{--                                $('#mobile-validation-feedback').html('<div style="color: red;font-size: 10px">Mobile number is already in use.</div>').show();--}}
{{--                                resolve(false);--}}
{{--                            } else {--}}
{{--                                $('#mobile-validation-feedback').html('<div class="valid-feedback">Mobile number is available.</div>').show();--}}
{{--                                resolve(true);--}}
{{--                            }--}}
{{--                        },--}}
{{--                        error: function (xhr, status, error) {--}}
{{--                            console.error('Error checking mobile number availability');--}}
{{--                            reject(error);--}}
{{--                        }--}}
{{--                    });--}}
{{--                });--}}
{{--            }--}}

{{--            // Code validation--}}
{{--            function validateCode(code) {--}}
{{--                return new Promise(function (resolve, reject) {--}}
{{--                    $.ajax({--}}
{{--                        url: '/laravel/hilwa/public/check-code',--}}
{{--                        method: 'POST',--}}
{{--                        data: {--}}
{{--                            code: code--}}
{{--                        },--}}
{{--                        headers: {--}}
{{--                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                        },--}}
{{--                        success: function (response) {--}}
{{--                            if (response.exists) {--}}
{{--                                $('#code-validation-feedback').html('<div style="color: red;font-size: 10px">Code is already in use.</div>').show();--}}
{{--                                resolve(false);--}}
{{--                            } else {--}}
{{--                                $('#code-validation-feedback').html('<div class="valid-feedback">Code is available.</div>').show();--}}
{{--                                resolve(true);--}}
{{--                            }--}}
{{--                        },--}}
{{--                        error: function (xhr, status, error) {--}}
{{--                            console.error('Error checking code availability');--}}
{{--                            reject(error);--}}
{{--                        }--}}
{{--                    });--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}


{{--    </script>--}}







@endsection

