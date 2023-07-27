@extends('layouts.master')
@section('title',__('Front-end/pages/stores.add.store'))
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
            <h3>
                <strong>{{__('Front-end/pages/stores.title')}}</strong> / {{__('Front-end/pages/stores.add.store')}}
            </h3>
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
    <form action="{{route('stores.store')}}" method="post" id="create_user"
          class="needs-validation" novalidate>
        @csrf
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{__('Front-end/pages/stores.add.store')}}</h5>
                    <h6 class="card-subtitle text-muted">{{__('Front-end/pages/stores.add.description')}}</h6>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="language">{{__('Front-end/pages/stores.language')}}</label>
                            <input type="text" class="form-control" id="language"  disabled value="English">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="last_name">{{__('Front-end/pages/stores.name')}}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="{{__('Front-end/pages/stores.name')}}" autocomplete="off" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/stores.name.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/stores.name.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">{{__('Front-end/pages/stores.email')}}</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="{{__('Front-end/pages/stores.email')}}" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.email.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.email.invalid')}}
                            </div>
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
                            <label class="form-label" for="open_time">{{__('Front-end/pages/stores.open_time')}}</label>
                            <input required type="text" id="open_time" class="form-control open-time" placeholder="{{__('Front-end/pages/stores.open_time')}}"  name="open_time"/>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/stores.open.time.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/stores.open.time.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="close_time">{{__('Front-end/pages/stores.close_time')}}</label>
                            <input type="text" class="form-control close-time" id="close_time" placeholder="{{__('Front-end/pages/timeslots.select.time')}}" required name="close_time"/>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/stores.close_time.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/stores.close_time.invalid')}}
                            </div>
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
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="latitude">{{__('Front-end/pages/customers.latitude')}}</label>
                            <input type="text" class="form-control" id="latitude" name="latitude"
                                   placeholder="{{__('Front-end/pages/customers.latitude')}}" autocomplete="off" required
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                            >
                            <div class="valid-feedback">
                                {{__('Front-end/pages/customers.latitude.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/customers.latitude.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-6"  >
                            <label class="form-label" for="longitude">{{__('Front-end/pages/customers.longitude')}}</label>
                            <input type="text" class="form-control" id="longitude" name="longitude"
                                   placeholder="{{__('Front-end/pages/customers.longitude')}}" autocomplete="off" required
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                            >
                            <div class="valid-feedback">
                                {{__('Front-end/pages/customers.longitude.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/customers.longitude.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="postal_code" class="form-label">{{__('Front-end/pages/stores.postal_code')}}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="postal_code"
                                       aria-describedby="inputGroupPrepend" name="zip_code" autocomplete="off"
                                       placeholder="{{__('Front-end/pages/stores.postal_code')}}"
                                       required maxlength="8" pattern=".{3,8}"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                >
                                <div id="mobile-validation-feedback"></div>

                                <div class="valid-feedback">
                                    {{__('Front-end/pages/stores.postal_code.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/stores.postal_code.invalid')}}
                                </div>

                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="status">{{__('Front-end/pages/customers.status')}}</label>
                            <select name="status" id="status" class="form-control choices-single" required>
                                <option value="1">{{__('Front-end/pages/customers.true')}}</option>
                                <option value="0">{{__('Front-end/pages/customers.false')}}</option>
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/customers.status.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.status.invalid')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button id="save_user" type="submit"
                    class="btn btn-primary">{{__('Front-end/pages/users.submit')}}</button>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#inputState').on('change', function () {
                var StateId = $(this).val();
                if (StateId) {
                    $.ajax({
                        url: "{{ URL::to('state-cities') }}/" + StateId,
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
            new Choices(document.querySelector("#inputState"));
            var citySelect = new Choices(document.querySelector("#inputCity"), {
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
                    citySelect.clearChoices();
                }
            }
            $('#inputState').on('change', function () {
                var StateId = $(this).val();
                updateCityOptions(StateId);
                citySelect.clearStore();
            });

            var defaultStateId = $('#inputState').val();
            updateCityOptions(defaultStateId);

            flatpickr(".open-time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });
            flatpickr(".close-time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });
        });

    </script>
@endsection

