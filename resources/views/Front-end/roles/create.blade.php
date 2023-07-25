@extends('layouts.master')
@section('title',__('Front-end/pages/roles.title'))
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
            <h3><strong>{{__('Front-end/pages/roles.title')}}</strong> / {{__('Front-end/pages/roles.add')}}</h3>
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
    <form action="{{ route('roles.store') }}" method="post" class="needs-validation" novalidate id="myForm">
        @csrf
        <div class="row">
            <input class="form-control form-control-lg mb-3" type="text" placeholder="{{ __('Front-end/pages/roles.role.name') }}" name="name" required autocomplete="off">
        </div>
        <div class="row">
            <div class="list-group-item">
                <input type="checkbox" id="checkAll" name="checkAll">
                <label for="checkAll">{{ __('Front-end/pages/roles.select.all') }}</label>
            </div>
        </div>
        <br>
        @foreach($models as $index => $model)
            @php
                $isViewModel = ($model == 'dashboard' || $model == 'comment' || $model =='chat' || $model == 'order-status' || $model == 'payment-services');
                $isContactRequestModel = ($model == 'contact-request');
                $noDeleteModel = ($model == 'order' || $model == 'city');
            @endphp

            @if($index % 4 === 0)
                <div class="row">
                    @endif

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-header" style="background: #21beb5">
                                <h5 class="card-title mb-0" style="color: white">{{ __('Front-end/pages/roles.' . $model) }}</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($methods as $method)
                                    @if($isViewModel && $method != 'view')
                                        <li class="list-group-item">-</li>
                                        <li class="list-group-item">-</li>
                                        <li class="list-group-item">-</li>
                                        @break
                                    @elseif($isContactRequestModel && ($method == 'edit' || $method == 'delete'))
                                        <li class="list-group-item">-</li>
                                        <li class="list-group-item">-</li>
                                        @break
                                    @elseif($noDeleteModel && $method == 'delete')
                                        <li class="list-group-item">-</li>
                                        @break
                                    @endif
                                    <li class="list-group-item">
                                        <input type="checkbox" id="{{ $model . $method }}" name="permission[]" value="{{ $method . '_' . $model }}">
                                        <label for="{{ $model . $method }}"> {{ __('Front-end/pages/roles.' . $method) }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    @if($index % 4 === 3 || $index === count($models) - 1)
                </div>
            @endif
        @endforeach

        <button type="submit" class="btn btn-primary">{{__('Front-end/pages/roles.add')}}</button>
    </form>

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
            // Add event listener to "checkAll" checkbox
            document.getElementById("checkAll").addEventListener("click", function () {
                // Select all checkboxes except the "checkAll" checkbox
                var checkboxes = document.querySelectorAll('input[name="permission[]"]:not(#checkAll)');
                // Set the "checked" property of each checkbox to the value of the "checkAll" checkbox
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = document.getElementById("checkAll").checked;
                });
            });
        </script>
    @endsection
@endsection
