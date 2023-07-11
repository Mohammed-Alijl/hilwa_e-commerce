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
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{__('Front-end/pages/users.add.title')}}</h5>
                <h6 class="card-subtitle text-muted">{{__('Front-end/pages/users.add.description')}}</h6>
            </div>
            <div class="card-body">
                <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="first_name">{{__('Front-end/pages/users.first.name')}}</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"  placeholder="{{__('Front-end/pages/users.first.name')}}" autocomplete="off" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.first_name.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.first_name.invalid')}}
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="last_name">{{__('Front-end/pages/users.last.name')}}</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="{{__('Front-end/pages/users.last.name')}}" autocomplete="off" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.last_name.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.last_name.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">{{__('Front-end/pages/users.email')}}</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="{{__('Front-end/pages/users.email')}}" required>
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
                                <input type="number" class="form-control" id="mobile_number" aria-describedby="inputGroupPrepend" name="mobile_number" autocomplete="off" placeholder="{{__('Front-end/pages/users.mobile')}}"
                                       required maxlength="8" minlength="8">
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
                            <label class="form-label" for="inputPassword">{{__('Front-end/pages/users.password')}}</label>
                            <input type="password" class="form-control" name="password" id="inputPassword" placeholder="{{__('Front-end/pages/users.password')}}" autocomplete="off" required minlength="8">
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.password.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.password.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputPasswordConfirm">{{__('Front-end/pages/users.password.confirm')}}</label>
                            <input type="password" class="form-control" id="inputPasswordConfirm" name="confirm-password" placeholder="{{__('Front-end/pages/users.password.confirm')}}" autocomplete="off" required>
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
                        <input type="text" class="form-control" name="address" id="inputAddress" autocomplete="off" placeholder="1234 Main St" maxlength="255">
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
                                <option selected>{{__('Front-end/country.' . \App\Models\Country::first()->name)}}</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="inputZone">{{__('Front-end/pages/users.zone')}}</label>
                            <select id="inputZone" class="form-control" required>
                                <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                                @foreach($zones as $zone)
                                    <option value="{{$zone->id}}">{{__('Front-end/zones.' . $zone->name)}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.zone.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.zone.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="inputCity">{{__('Front-end/pages/users.city')}}</label>
                            <select name="city_id" id="inputCity" class="form-control" required>
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
                            <input type="checkbox" class="form-check-input" name="limit_zone">
                            <span class="form-check-label">{{__('Front-end/pages/users.limit.access.zone')}}</span>
                        </label>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputRole">{{__('Front-end/pages/users.role')}}</label>
                            <select name="roles_name" id="inputRole" class="form-control" required>
                                <option disabled value="" selected>{{__('Front-end/pages/users.choose')}}</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->name}}" >{{$role->name}}</option>
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
                            <label class="form-label" for="inputEmail4">{{__('Front-end/pages/users.profile.image')}}</label>
                            <input type="file" class="form-control" id="inputEmail4" name="pic" autocomplete="off" accept=".jpg, .jpeg, .png, .svg">
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
                            <input type="text" class="form-control" id="code" name="code" placeholder="{{__('Front-end/pages/users.code')}}" autocomplete="off" required minlength="8" maxlength="8">
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.code.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.code.invalid')}}
                            </div>
                            <div id="code-validation-feedback"></div>

                        </div>
                    </div>
                    <button id="save_user" type="submit" class="btn btn-primary">{{__('Front-end/pages/users.submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#inputZone').on('change', function() {
                var ZoneId = $(this).val();
                if (ZoneId) {
                    $.ajax({
                        url: "{{ URL::to('cities') }}/" + ZoneId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="city_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="city_id"]').append('<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        },
                    });

                }
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
        var passwordInput = document.getElementById('inputPassword');
        var confirmPasswordInput = document.getElementById('inputPasswordConfirm');

        function validatePassword() {
            if (passwordInput.value !== confirmPasswordInput.value) {
                passwordInput.setCustomValidity('Passwords do not match.');
                confirmPasswordInput.setCustomValidity('Passwords do not match.');
            } else {
                passwordInput.setCustomValidity('');
                confirmPasswordInput.setCustomValidity('');
            }
        }

        passwordInput.addEventListener('input', validatePassword);
        confirmPasswordInput.addEventListener('input', validatePassword);
    </script>

    <script>
        $(document).ready(function() {
            $('form').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                var form = $(this);
                var email = $('#email').val();
                var mobileNumber = $('#mobile_number').val();
                var code = $('#code').val();

                // Perform the validation checks
                validateEmail(email);
                validateMobileNumber(mobileNumber);
                validateCode(code);

                // If there are no validation errors, submit the form using AJAX
                if (form[0].checkValidity() && $('#email-validation-feedback').is(':empty') && $('#mobile-validation-feedback').is(':empty') && $('#code-validation-feedback').is(':empty')) {
                    var formData = new FormData(form[0]);

                    $.ajax({
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // Handle the success response
                            console.log('Form submitted successfully');
                            window.location.href = response.redirect; // Redirect to the specified URL
                        },
                        error: function(xhr, status, error) {
                            // Handle the error response
                            console.error('Error submitting the form');
                        }
                    });
                }
            });

            // Email validation
            $('#email').on('blur', function() {
                var email = $(this).val();
                validateEmail(email);
            });

            // Mobile number validation
            $('#mobile_number').on('blur', function() {
                var mobileNumber = $(this).val();
                validateMobileNumber(mobileNumber);
            });

            // Code validation
            $('#code').on('blur', function() {
                var code = $(this).val();
                validateCode(code);
            });

            function validateEmail(email) {
                $.ajax({
                    url: '/laravel/hilwa/public/check-email',
                    method: 'POST',
                    data: {
                        email: email
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#email-validation-feedback').html('<div style="color: red;font-size: 10px">Email is already in use.</div>').show();
                        } else {
                            $('#email-validation-feedback').html('<div class="valid-feedback">Email is available.</div>').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error checking email availability');
                    }
                });
            }

            function validateMobileNumber(mobileNumber) {
                $.ajax({
                    url: '/laravel/hilwa/public/check-mobile',
                    method: 'POST',
                    data: {
                        mobile_number: mobileNumber
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#mobile-validation-feedback').html('<div style="color: red;font-size: 10px">Mobile number is already in use.</div>').show();
                        } else {
                            $('#mobile-validation-feedback').html('<div class="valid-feedback">Mobile number is available.</div>').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error checking mobile number availability');
                    }
                });
            }

            function validateCode(code) {
                $.ajax({
                    url: '/laravel/hilwa/public/check-code',
                    method: 'POST',
                    data: {
                        code: code
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#code-validation-feedback').html('<div style="color: red;font-size: 10px">Code is already in use.</div>').show();
                        } else {
                            $('#code-validation-feedback').html('<div class="valid-feedback">Code is available.</div>').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error checking code availability');
                    }
                });
            }
        });
    </script>










@endsection

