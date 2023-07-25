@extends('layouts.master')
@section('title',__('Front-end/pages/drivers.edit.driver'))
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
            <h3><strong>{{__('Front-end/pages/drivers.title')}}</strong> / {{__('Front-end/pages/drivers.edit.driver')}}</h3>
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
                <h5 class="card-title">{{__('Front-end/pages/drivers.edit.driver')}}</h5>
                <h6 class="card-subtitle text-muted">{{__('Front-end/pages/drivers.edit.description')}}</h6>
            </div>
            <div class="card-body">
                <form action="{{route('drivers.update',$driver->id)}}" method="post" enctype="multipart/form-data" id="create_user"
                      class="needs-validation" novalidate>
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label"
                                   for="name">{{__('Front-end/pages/drivers.name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$driver->name}}"
                                   placeholder="{{__('Front-end/pages/drivers.name')}}" autocomplete="off" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.first_name.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.first_name.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">{{__('Front-end/pages/users.email')}}</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{$driver->email}}"
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
                                       required maxlength="8" pattern=".{8,8}" value="{{$driver->mobile_number}}"
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
                                   placeholder="{{__('Front-end/pages/users.password')}}" autocomplete="off"
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
                                   >
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
                               placeholder="1234 Main St" maxlength="255" value="{{$driver->address}}">
                        <div class="valid-feedback">
                            {{__('Front-end/pages/users.user.address.valid')}}
                        </div>
                        <div class="invalid-feedback">
                            {{__('Front-end/pages/users.user.address.invalid')}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputCountry">{{__('Front-end/pages/users.country')}}</label>
                            <select id="inputCountry" class="form-control" disabled>
                                <option
                                    selected>{{__('Front-end/country.' . \App\Models\Country::first()->name)}}</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputState">{{__('Front-end/pages/users.state')}}</label>
                            <select id="inputState" class="form-control choices-single" required>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}" {{$state->id == $driver->zone->city->state->id ? 'selected' : ''}}>{{__('Front-end/states.' . $state->name)}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.state.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.state.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputCity">{{__('Front-end/pages/users.city')}}</label>
                            <select id="inputCity" name="city_id" class="form-control choices-single" required>
                                <option selected value="{{$driver->zone->city->id}}">{{$driver->zone->city->name}}</option>
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.city.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.city.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputZone">{{__('Front-end/pages/drivers.zone')}}</label>
                            <select id="inputZone" name="zone_id" class="form-control choices-single" required>
                                <option value="{{$driver->zone->id}}">{{$driver->zone->name}}</option>
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/drivers.zone.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/drivers.zone.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Status -->
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="status">{{__('Front-end/pages/zones.status')}}</label>
                            <select name="status" id="status" class="form-control choices-single" required>
                                <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                                <option value="1" {{$driver->status ? "selected" : ''}}>{{__('Front-end/pages/zones.enable')}}</option>
                                <option value="0" {{!$driver->status ? "selected" : ''}}>{{__('Front-end/pages/zones.disable')}}</option>
                            </select>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/zones.status.invalid')}}
                            </div>
                        </div>
                        <!-- Image -->
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
                    <button id="save_user" type="submit"
                            class="btn btn-primary">{{__('Front-end/pages/drivers.edit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new Choices(document.querySelector("#inputState"));
            // Choices.js
            var citySelect = new Choices(document.querySelector("#inputCity"), {
                removeItemButton: true,
            });
            var zoneSelect = new Choices(document.querySelector("#inputZone"), {
                removeItemButton: true,
            });
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
            function updateZoneOptions(CityId) {
                if (CityId) {
                    $.ajax({
                        url: "{{ URL::to('city-zones') }}/" + CityId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var zoneOptions = []; // Array to hold the city options
                            $.each(data, function (key, value) {
                                zoneOptions.push({ value: key, label: value }); // Add each city as an object to the array
                            });
                            zoneSelect.setChoices(zoneOptions, 'value', 'label', true); // Set all city options at once
                        },
                    });
                } else {
                    zoneSelect.clearChoices(); // Clear the choices when no state is selected
                }
            }
            // Call the updateCityOptions function when the state selection changes
            $('#inputState').on('change', function () {
                var StateId = $(this).val();
                updateCityOptions(StateId);

                // Clear the selected city when the state changes
                citySelect.clearStore();
            });

            $('#inputCity').on('change', function () {
                var cityId = $(this).val();
                updateZoneOptions(cityId);

                // Clear the selected zone when the state changes
                zoneSelect.clearStore();
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
                const isPasswordValid = passwordInput.value.length >= 8 || passwordInput.value.length === 0;
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

@endsection

