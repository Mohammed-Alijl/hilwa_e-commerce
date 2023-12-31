@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/attributes.add.attribute'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>
                <strong>{{__('Front-end/pages/attributes.title')}}</strong> / {{__('Front-end/pages/attributes.add.attribute')}}
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
    <form action="{{route('attributes.store')}}" method="post" id="create_user"
          class="needs-validation" novalidate>
        @csrf
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{__('Front-end/pages/attributes.add.attribute')}}</h5>
                    <h6 class="card-subtitle text-muted">{{__('Front-end/pages/attributes.add.description')}}</h6>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputCountry">{{__('Front-end/pages/attributes.language')}}</label>
                            <select id="inputCountry" class="form-control" disabled>
                                <option selected>English</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="name">{{__('Front-end/pages/attributes.name')}}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="{{__('Front-end/pages/attributes.name')}}" autocomplete="off" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/attributes.name.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/attributes.name.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="type">{{__('Front-end/pages/attributes.frontend.type')}}</label>
                            <select name="frontend_type" id="type" class="form-control choices-single" required>
                                @foreach(\App\Models\Attribute::getTypes() as $type)
                                    <option value="{{$type}}">{{$type}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/attributes.type.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/attributes.type.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="display_order" class="form-label">{{__('Front-end/pages/attributes.display_order')}}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="display_order"
                                       aria-describedby="inputGroupPrepend" name="display_order" autocomplete="off"
                                       placeholder="{{__('Front-end/pages/attributes.display_order')}}" required
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                >
                                <div class="valid-feedback">
                                    {{__('Front-end/pages/attributes.display_order.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/attributes.display_order.invalid')}}
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="status">{{__('Front-end/pages/attributes.status')}}</label>
                            <select name="status" id="status" class="form-control choices-single" required>
                                <option value="1">{{__('Front-end/pages/attributes.enable')}}</option>
                                <option value="0">{{__('Front-end/pages/attributes.disable')}}</option>
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/attributes.status.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.status.invalid')}}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <button id="save_user" type="submit"
                    class="btn btn-primary">{{__('Front-end/pages/attributes.add')}}</button>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        new Choices(document.querySelector("#type"));
        new Choices(document.querySelector("#status"));
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





@endsection

