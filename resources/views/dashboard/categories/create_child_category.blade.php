@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/categories.add.category'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>
                <strong>{{__('Front-end/pages/categories.title')}}</strong>
                / {{__('Front-end/pages/categories.add.category')}}
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
    <form action="{{route('categories.store')}}" method="post" id="create_user" enctype="multipart/form-data"
          class="needs-validation" novalidate>
        @csrf
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{__('Front-end/pages/categories.add.category')}}</h5>
                    <h6 class="card-subtitle text-muted">{{__('Front-end/pages/categories.add.description')}}</h6>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="language">{{__('Front-end/pages/categories.language')}}</label>
                            <input type="text" class="form-control" id="language" disabled value="English">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="last_name">{{__('Front-end/pages/categories.name')}}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="{{__('Front-end/pages/categories.name')}}" autocomplete="off" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/categories.name.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/categories.name.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="display_order">{{__('Front-end/pages/categories.display_order')}}</label>
                            <input type="text" class="form-control" id="display_order" name="display_order"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                   placeholder="{{__('Front-end/pages/categories.display_order')}}" autocomplete="off"
                                   required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/categories.display_order.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/categories.display_order.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="color_code"
                                   class="form-label">{{__('Front-end/pages/categories.color_code')}}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="color_code"
                                       aria-describedby="inputGroupPrepend" name="color_code" autocomplete="off"
                                       placeholder="{{__('Front-end/pages/categories.color_code')}}"
                                       required
                                >
                                <div id="mobile-validation-feedback"></div>

                                <div class="valid-feedback">
                                    {{__('Front-end/pages/categories.color_code.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/categories.color_code.invalid')}}
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="status">{{__('Front-end/pages/categories.status')}}</label>
                            <select name="status" id="status" class="form-control choices-single" required>
                                @if(\App\Models\Category::find($id)->status)
                                    <option value="1">{{__('Front-end/pages/categories.enable')}}</option>
                                @endif
                                <option value="0">{{__('Front-end/pages/categories.disable')}}</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="inputEmail4">{{__('Front-end/pages/categories.icon')}}</label>
                            <input type="file" class="form-control" id="image" name="image" autocomplete="off"
                                   accept=".jpg, .jpeg, .png, .svg" required>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/categories.icon.invalid')}}
                            </div>
                        </div>
                        <input type="hidden" name="parent_category_id" value="{{$id}}">
                    </div>

                </div>
            </div>
            <button id="save_user" type="submit"
                    class="btn btn-primary">{{__('Front-end/pages/categories.add')}}</button>
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
        document.getElementById('color_code').addEventListener('input', checkColorCode);

        function checkColorCode() {
            let colorInput = document.getElementById('color_code');
            let colorValue = colorInput.value.trim();
            let colorSyntax = /^#([0-9a-f]{3}|[0-9a-f]{6})$/i;
            let isColorValid = colorValue !== '' && colorSyntax.test(colorValue);

            if (isColorValid) {
                colorInput.classList.add("is-valid");
                colorInput.classList.remove("is-invalid");
                colorInput.setCustomValidity("");
            } else {
                colorInput.classList.remove("is-valid");
                colorInput.classList.add("is-invalid");
                colorInput.setCustomValidity("invalid");
            }

            return isColorValid;
        }
    </script>
@endsection

