@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/attributes.edit.attribute'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>
                <strong>{{__('Front-end/pages/attributes.title')}}</strong> / {{__('Front-end/pages/attributes.edit.attribute')}}
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
    <form action="{{route('attributes.update',$attribute->id)}}" method="post" id="create_user"
          class="needs-validation" novalidate>
        @csrf
        @method('put')
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{__('Front-end/pages/attributes.edit.attribute')}}</h5>
                    <h6 class="card-subtitle text-muted">{{__('Front-end/pages/attributes.edit.description')}}</h6>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="language">{{__('Front-end/pages/attributes.language')}}</label>
                            <select id="language" class="form-control" name="language_id">
                                @foreach($languages as $language)
                                    <option value="{{$language->id}}" {{$language->id == 1 ? 'selected' : ''}}>{{$language->name}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/attributes.isBoolean.valid')}}
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="name">{{__('Front-end/pages/attributes.name')}}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="{{__('Front-end/pages/attributes.name')}}" autocomplete="off" required
                                   value="{{$attribute->translations->first()->name}}"
                            >
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
                            <label class="form-label" for="entity">{{__('Front-end/pages/attributes.entity')}}</label>
                            <select name="entity_id" id="entity" class="form-control choices-single" required>
                                @foreach($entities as $entity)
                                    <option value="{{$entity->id}}" {{$entity->id == $attribute->entity->id ? 'selected' : ''}}>{{$entity->name}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/attributes.display_order.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/attributes.entity.invalid')}}
                            </div>

                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="display_order" class="form-label">{{__('Front-end/pages/attributes.display_order')}}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="display_order"
                                       aria-describedby="inputGroupPrepend" name="display_order" autocomplete="off"
                                       placeholder="{{__('Front-end/pages/attributes.display_order')}}" required
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                       value="{{$attribute->display_order}}"
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
                            <label class="form-label" for="isBoolean">{{__('Front-end/pages/attributes.isBoolean')}}</label>
                            <select name="isBoolean" id="isBoolean" class="form-control choices-single" required>
                                <option value="1" {{$attribute->isBoolean ? 'selected' : ''}}>{{__('Front-end/pages/attributes.yes')}}</option>
                                <option value="0" {{!$attribute->isBoolean ? 'selected' : ''}}>{{__('Front-end/pages/attributes.no')}}</option>
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/attributes.isBoolean.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/attributes.isBoolean.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="status">{{__('Front-end/pages/attributes.status')}}</label>
                            <select name="status" id="status" class="form-control choices-single" required>
                                <option value="1" {{$attribute->status ? 'selected' : ''}}>{{__('Front-end/pages/attributes.enable')}}</option>
                                <option value="0" {{!$attribute->status ? 'selected' : ''}}>{{__('Front-end/pages/attributes.disable')}}</option>
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
                    class="btn btn-primary">{{__('Front-end/pages/attributes.edit')}}</button>
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
        $(document).ready(function() {
            // Get the initial value of the name input
            const initialName = $("#name").val();

            // Event listener for the language select change
            $("#language").change(function() {
                // Get the selected language ID
                const languageId = $(this).val();

                $.ajax({
                    url: "{{ URL::to('admin/attribute-languages') }}/" + languageId + '/' + {{$attribute->id}},
                    method: "GET",
                    success: function(data) {
                        $("#name").val(data.attribute_name);
                    },
                    error: function(xhr, status, error) {
                        $("#name").val(initialName);
                    }
                });
            });
        });
    </script>



@endsection

