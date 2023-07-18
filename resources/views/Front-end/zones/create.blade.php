@extends('layouts.master')
@section('title',__('Front-end/pages/zones.add.zone'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
        <link class="js-stylesheet" href="{{URL::asset('css/app.rtl.css')}}" rel="stylesheet">
    @else
        <link class="js-stylesheet" href="{{URL::asset('css/light.css')}}" rel="stylesheet">
    @endif
    <style>
        /* Custom CSS for Tagsinput */
        .bootstrap-tagsinput {
            display: block;
            box-sizing: border-box;
            width: 100%;
            padding: .375rem .75rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            border-radius: .25rem;
        }

        .bootstrap-tagsinput input {
            border: none;
            outline: none;
            background: transparent;
            padding: 0;
            margin: 0;
            width: auto;
            max-width: 100%;
            font-size: 1rem;
        }

        .bootstrap-tagsinput .badge {
            margin-right: 2px;
        }

        /* Set blue color for all tags */
        .bootstrap-tagsinput .badge {
            background-color: #2196f3;
        }
    </style>
    </head>
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{__('Front-end/pages/zones.title')}}</strong> / {{__('Front-end/pages/zones.add.zone')}}</h3>
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
                <h5 class="card-title">{{__('Front-end/pages/zones.add.zone')}}</h5>
                <h6 class="card-subtitle text-muted">{{__('Front-end/pages/zones.add.description')}}</h6>
            </div>
            <div class="card-body">
                <form action="{{route('zones.store')}}" method="post" enctype="multipart/form-data" id="create_user"
                      class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <!-- Zone Name -->
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="name">{{__('Front-end/pages/zones.name')}}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="{{__('Front-end/pages/zones.name')}}" autocomplete="off" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/zones.zone.name.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/zones.zone.name.invalid')}}
                            </div>
                        </div>
                        <!-- Store -->
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputStore">{{__('Front-end/pages/zones.store')}}</label>
                            <select name="store_id" id="inputStore" class="form-control choices-single" required>
                                <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                                @foreach($stores as $store)
                                    <option value="{{$store->id}}">{{$store->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/zones.store.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Country -->
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="inputCountry">{{__('Front-end/pages/users.country')}}</label>
                            <select id="inputCountry" class="form-control" disabled>
                                <option
                                    selected>{{__('Front-end/country.' . \App\Models\Country::first()->name)}}</option>
                            </select>
                        </div>
                        <!-- State -->
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="inputState">{{__('Front-end/pages/zones.state')}}</label>
                            <select id="inputState" class="form-control choices-single" required>
                                <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{__('Front-end/states.' . $state->name)}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/zones.state.invalid')}}
                            </div>
                        </div>
                        <!-- City -->
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="inputCity">{{__('Front-end/pages/zones.city')}}</label>
                            <select id="inputCity" name="city_id" class="form-control choices-single" required>
                                <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                            </select>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/zones.city.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Status -->
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="status">{{__('Front-end/pages/zones.status')}}</label>
                            <select name="status" id="status" class="form-control choices-single" required>
                                <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                                    <option value="1">{{__('Front-end/pages/zones.enable')}}</option>
                                    <option value="0">{{__('Front-end/pages/zones.disable')}}</option>
                            </select>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/zones.status.invalid')}}
                            </div>
                        </div>
                        <!-- Postal Code -->
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="code">{{__('Front-end/pages/zones.postal.code')}}</label>
                            <input type="text" id="tags-input" data-role="tagsinput" name="postal_codes" class="bootstrap-tagsinput">
                            <div class="valid-feedback">
                                {{__('Front-end/pages/zones.postal_code.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/zones.postal_code.invalid')}}
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
            new Choices(document.querySelector("#inputStore"));
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
    <!-- Include Bootstrap Tagsinput JS -->
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#tags-input').tagsinput({
            trimValue: true,
            beforeItemAdd: function(item) {
                $('.bootstrap-tagsinput .badge').last().css('background-color', '#2196f3');
            }
        });
    });
</script>
@endsection
