@extends('layouts.master')
@section('title',__('Front-end/pages/users.user.edit.title'))
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
            <h3><strong>{{__('Front-end/pages/users.users')}}</strong> / {{__('Front-end/pages/users.user.edit')}}</h3>
        </div>
    </div>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-md-3 col-xl-2">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{__('Front-end/pages/users.user.settings')}}</h5>
                        </div>

                        <div class="list-group list-group-flush" role="tablist">
                            <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                               href="#account" role="tab">
                                {{__('Front-end/pages/users.account.details')}}
                            </a>
                            <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password"
                               role="tab">
                                {{__('Front-end/pages/users.password')}}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-xl-10">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="account" role="tabpanel">

                            <div class="card">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">{{__('Front-end/pages/users.user.info')}}</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('users.update',$user->id)}}" method="post"
                                          enctype="multipart/form-data"
                                          id="edit_user" class="needs-validation" novalidate>
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label"
                                                       for="first_name">{{__('Front-end/pages/users.first.name')}}</label>
                                                <input type="text" class="form-control" id="first_name"
                                                       name="first_name" value="{{$user->first_name}}"
                                                       placeholder="{{__('Front-end/pages/users.first.name')}}"
                                                       autocomplete="off" required>
                                                <div class="valid-feedback">
                                                    {{__('Front-end/pages/users.user.first_name.valid')}}
                                                </div>
                                                <div class="invalid-feedback">
                                                    {{__('Front-end/pages/users.user.first_name.invalid')}}
                                                </div>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label"
                                                       for="last_name">{{__('Front-end/pages/users.last.name')}}</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name"
                                                       value="{{$user->last_name}}"
                                                       placeholder="{{__('Front-end/pages/users.last.name')}}"
                                                       autocomplete="off" required>
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
                                                <label class="form-label"
                                                       for="email">{{__('Front-end/pages/users.email')}}</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                       value="{{$user->email}}"
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
                                                <label for="mobile_number"
                                                       class="form-label">{{__('Front-end/pages/users.mobile')}}</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="mobile_number_label">05</span>
                                                    <input type="number" class="form-control" id="mobile_number_input"
                                                           value="{{$user->mobile_number}}"
                                                           aria-describedby="mobile_number_label" name="mobile_number"
                                                           autocomplete="off"
                                                           placeholder="{{__('Front-end/pages/users.mobile')}}"
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
                                        <div class="mb-3">
                                            <label class="form-label"
                                                   for="inputAddress">{{__('Front-end/pages/users.address')}}</label>
                                            <input type="text" class="form-control" name="address" id="inputAddress"
                                                   autocomplete="off" value="{{$user->address}}"
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
                                                <label class="form-label"
                                                       for="inputCountry">{{__('Front-end/pages/users.country')}}</label>
                                                <select id="inputCountry" class="form-control" disabled>
                                                    <option
                                                        selected>{{__('Front-end/country.' . \App\Models\Country::first()->name)}}</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label"
                                                       for="inputZone">{{__('Front-end/pages/users.zone')}}</label>
                                                <select id="inputZone" class="form-control" required>
                                                    <option selected
                                                            value="{{$user->city->zone->id}}">{{__('Front-end/zones.' . $user->city->zone->name)}}</option>
                                                    @foreach($zones as $zone)
                                                        <option
                                                            value="{{$zone->id}}">{{__('Front-end/zones.' . $zone->name)}}</option>
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
                                                <label class="form-label"
                                                       for="inputCity">{{__('Front-end/pages/users.city')}}</label>
                                                <select name="city_id" id="inputCity" class="form-control" required>
                                                    <option selected
                                                            value="{{$user->city->id}}">{{$user->city->name}}</option>
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
                                                <input type="checkbox" class="form-check-input"
                                                       name="limit_zone" {{ $user->limit_state ? 'checked' : '' }}>
                                                <span
                                                    class="form-check-label">{{__('Front-end/pages/users.limit.access.zone')}}</span>
                                            </label>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label"
                                                       for="inputRole">{{__('Front-end/pages/users.role')}}</label>
                                                <select name="roles_name" id="inputRole" class="form-control" required>
                                                    <option disabled value=""
                                                            selected>{{__('Front-end/pages/users.choose')}}</option>
                                                    @foreach($roles as $role)
                                                        <option selected value="{{$role}}">{{$role}}</option>
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
                                                <input type="file" class="form-control" id="inputEmail4" name="pic"
                                                       autocomplete="off"
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
                                                <label class="form-label"
                                                       for="code">{{__('Front-end/pages/users.code')}}</label>
                                                <input type="text" class="form-control" id="code" name="code"
                                                       value="{{$user->code}}"
                                                       placeholder="{{__('Front-end/pages/users.code')}}"
                                                       autocomplete="off" required
                                                       minlength="8" maxlength="8" disabled>
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
                        <div class="tab-pane fade" id="password" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{__('Front-end/pages/users.password')}}</h5>

                                    <form action="{{route('users.update',$user->id)}}" method="post" id="change_password" class="needs-validation" novalidate>
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label class="form-label"
                                                   for="inputPassword">{{__('Front-end/pages/users.new.password')}}</label>
                                            <input type="password" class="form-control" name="password"
                                                   id="inputPassword"
                                                   autocomplete="off"
                                                   minlength="8" required>
                                            <div class="valid-feedback">
                                                {{__('Front-end/pages/users.user.password.valid')}}
                                            </div>
                                            <div class="invalid-feedback">
                                                {{__('Front-end/pages/users.user.password.invalid')}}
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"
                                                   for="inputPasswordConfirm">{{__('Front-end/pages/users.password.confirm')}}</label>
                                            <input type="password" class="form-control" id="inputPasswordConfirm"
                                                   name="confirm-password" autocomplete="off"
                                            >
                                            <div class="valid-feedback">
                                                {{__('Front-end/pages/users.user.password.confirm.valid')}}
                                            </div>
                                            <div class="invalid-feedback">
                                                {{__('Front-end/pages/users.user.password.confirm.invalid')}}
                                            </div>
                                        </div>
                                        <button type="submit"
                                                class="btn btn-primary">{{__('Front-end/pages/users.password.change')}}</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    @section('scripts')
        <script>
            $(document).ready(function () {
                $('#inputZone').on('change', function () {
                    var ZoneId = $(this).val();
                    if (ZoneId) {
                        $.ajax({
                            url: "{{ URL::to('cities') }}/" + ZoneId,
                            type: "GET",
                            dataType: "json",
                            success: function (data) {
                                $('select[name="city_id"]').empty();
                                $.each(data, function (key, value) {
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
            document.addEventListener("DOMContentLoaded", function () {
                // Get the form element
                const form = document.getElementById("change_password");

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
        @if(\Illuminate\Support\Facades\Session::has('success-message'))
            <script>
                Swal.fire(
                    '{{__('Front-end/pages/users.edited')}}',
                    '{{\Illuminate\Support\Facades\Session::get('success-message')}}',
                    'success'
                )
            </script>
        @endif
    @endsection
@endsection
