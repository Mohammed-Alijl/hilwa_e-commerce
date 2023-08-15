@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/categories.edit.category'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>
                <strong>{{__('Front-end/pages/categories.title')}}</strong>
                / {{__('Front-end/pages/categories.edit.category')}}
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
    <form action="{{route('categories.update',$category->id)}}" method="post" id="create_user" enctype="multipart/form-data"
          class="needs-validation" novalidate>
        @csrf
        @method('put')
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{__('Front-end/pages/categories.edit.category')}}</h5>
                    <h6 class="card-subtitle text-muted">{{__('Front-end/pages/categories.edit.description')}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="language">{{__('Front-end/pages/categories.language')}}</label>
                            <select name="language_id" id="language" class="form-control choices-single" required>
                                @foreach($languages as $language)
                                    <option value="{{$language->id}}" {{$language->id == 1 ? 'selected' : ''}}>{{$language->name}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/stores.language.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/stores.language.invalid')}}
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="name">{{__('Front-end/pages/categories.name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$category->getTranslation('name','en')}}"
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
                                   required value="{{$category->display_order}}">
                            <div class="valid-feedback">
                                {{__('Front-end/pages/categories.display_order.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/categories.display_order.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="parent_category">{{__('Front-end/pages/categories.parent_category')}}</label>
                            <select id="parent_category" class="form-control choices-single" name="parent_category_id">
                                <option selected value="">{{__('Front-end/pages/users.choose')}}</option>
                                @foreach($categories as $theCategory)
                                    @if($theCategory->id == $category->id)
                                        @continue
                                    @endif
                                    <option value="{{$theCategory->id}}" {{$theCategory->id === $category->parent_category_id ? 'selected' : ''}}>{{$theCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="color_code"
                                   class="form-label">{{__('Front-end/pages/categories.color_code')}}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="color_code"
                                       aria-describedby="inputGroupPrepend" name="color_code" autocomplete="off"
                                       placeholder="{{__('Front-end/pages/categories.color_code')}}"
                                       required value="{{$category->color_code}}"
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
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="status">{{__('Front-end/pages/categories.status')}}</label>
                            <select name="status" id="status" class="form-control choices-single" required>
                                <option value="1" {{$category->status ? 'selected' : ''}}>{{__('Front-end/pages/categories.enable')}}</option>
                                <option value="0" {{!$category->status ? 'selected' : ''}}>{{__('Front-end/pages/categories.disable')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="inputEmail4">{{__('Front-end/pages/categories.icon')}}</label>
                            <input type="file" class="form-control" id="image" name="image" autocomplete="off"
                                   accept=".jpg, .jpeg, .png, .svg">
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/categories.icon.invalid')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button id="save_user" type="submit"
                    class="btn btn-primary">{{__('Front-end/pages/categories.edit')}}</button>
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

            if(isColorValid) {
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
    <script>
        new Choices(document.querySelector("#parent_category"));
        new Choices(document.querySelector("#language"));
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
                    url: "{{ URL::to('admin/category-languages') }}/" + languageId + '/' + {{$category->id}},
                    method: "GET",
                    success: function(data) {
                        $("#name").val(data.category_name);
                    },
                    error: function(xhr, status, error) {
                        $("#name").val(initialName);
                    }
                });
            });
        });
    </script>




@endsection

