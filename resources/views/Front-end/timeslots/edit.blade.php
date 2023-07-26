@extends('layouts.master')
@section('title',__('Front-end/pages/timeslots.edit.timeslot'))
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
                <strong>{{__('Front-end/pages/timeslots.title')}}</strong> / {{__('Front-end/pages/timeslots.edit.timeslot')}}
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
    <form action="{{route('timeslots.update',$day->id)}}" method="post" id="create_user"
          class="needs-validation" novalidate>
        @csrf
        @method('put')
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{__('Front-end/pages/timeslots.edit.timeslot')}}</h5>
                    <h6 class="card-subtitle text-muted">{{__('Front-end/pages/timeslots.edit.description')}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="day">{{__('Front-end/pages/timeslots.day')}}</label>
                            <select id="day" class="form-control choices-single" required disabled>
                                    <option selected >{{$day->name}}</option>
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/timeslots.day.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/timeslots.day.invalid')}}
                            </div>
                        </div>
                    </div>
                    @foreach($day->timeslots as $timeslot)
                        <input type="hidden" name="timeslot_id[]" value="{{$timeslot->id}}">
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label class="form-label">{{__('Front-end/pages/timeslots.start.at')}}</label>
                            <input required type="text" class="form-control start-time" placeholder="{{__('Front-end/pages/timeslots.select.time')}}"  name="start_time[]" value="{{$timeslot->start_time}}"/>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/timeslots.start.time.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/timeslots.start.time.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label">{{__('Front-end/pages/timeslots.end.at')}}</label>
                            <input type="text" class="form-control end-time" placeholder="{{__('Front-end/pages/timeslots.select.time')}}" required name="end_time[]" value="{{$timeslot->end_time}}"/>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/timeslots.end.time.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/timeslots.end.time.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label"
                                   for="total_order">{{__('Front-end/pages/timeslots.total.order')}}</label>
                            <input type="text" class="form-control" id="total_order" name="total_order[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                   placeholder="{{__('Front-end/pages/timeslots.total.order')}}" autocomplete="off" required value="{{$timeslot->total_order}}">
                            <div class="valid-feedback">
                                {{__('Front-end/pages/timeslots.total.order.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/timeslots.total.order.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label class="form-label" for="display_order">{{__('Front-end/pages/timeslots.display_order')}}</label>
                            <input type="text" class="form-control" id="display_order" name="display_order[]" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                   placeholder="{{__('Front-end/pages/timeslots.display_order')}}" autocomplete="off" required value="{{$timeslot->display_order}}">
                            <div class="valid-feedback">
                                {{__('Front-end/pages/timeslots.display_order.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/timeslots.display_order.invalid')}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <button id="save_user" type="submit"
                    class="btn btn-primary">{{__('Front-end/pages/timeslots.edit')}}</button>
        </div>
    </form>
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
        document.addEventListener("DOMContentLoaded", function() {
            // Choices.js
            new Choices(document.querySelector(".choices-single"));
            flatpickr(".start-time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });
            flatpickr(".end-time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });
        });
    </script>


@endsection

