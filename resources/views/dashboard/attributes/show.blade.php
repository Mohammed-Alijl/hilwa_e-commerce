@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/attributes.attribute.value'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>{{__('Front-end/pages/attributes.attribute.value')}}</h3>
        </div>
        @can('add_attribute')
            <div class="col-auto ms-auto text-end mt-n1">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                    {{__('Front-end/pages/attributes.add.value')}}
                </button>
            </div>
        @endcan
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
    <div class="card">
        <div class="card-body">
            <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Front-end/pages/attributes.name')}}</th>
                    <th>{{__('Front-end/pages/attributes.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $rowNumber = 1;
                @endphp
                @foreach($values as $value)
                    <tr>
                        <td>
                            @if($attribute->frontend_type == 'image')
                                <img src="{{URL::asset('img/attributes/' . $value->frontend_type_value)}}" width="32" height="32" class="rounded-circle my-n1" alt="{{$value->name}}">
                            @else
                            {{$rowNumber++}}
                            @endif
                        </td>
                        <td>{{$value->name}}</td>
                        <td>
                            @can('edit_attribute')
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit"
                                   data-id="{{ $value->id }}"
                                   data-name="{{ $value->name }}"
                                   data-color="{{ $value->frontend_type_value }}"
                                >
                                    <i class="align-middle" data-feather="edit-2"></i>
                                </a>
                            @endcan
                            @can('delete_attribute')
                                <a href="#" onclick="deletes({{ $value->id }})"><i class="align-middle"
                                                                                       data-feather="trash"></i></a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <form action="{{route('values.store')}}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{__('Front-end/pages/attributes.add.value')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label" for="add_name">{{__('Front-end/pages/attributes.name')}}</label>
                            <input id="add_name" type="text" class="form-control" placeholder="{{__('Front-end/pages/attributes.name')}}" autocomplete="off" name="name" required maxlength="30">
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/attributes.name.invalid')}}
                            </div>
                        </div>
                        <!-- Image Frontend Type Value -->
                        @if($attribute->frontend_type == 'image')
                        <div class="mb-3">
                            <label class="form-label" for="add_image_value">{{__('Front-end/pages/attributes.image')}}</label>
                            <input type="file" class="form-control" id="inputEmail4" name="image_value" autocomplete="off"
                                   accept=".jpg, .jpeg, .png, .svg" required>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/attributes.image.invalid')}}
                            </div>
                        </div>
                    @endif
                        <!-- Color Frontend Type Value -->
                        @if($attribute->frontend_type == 'color')
                        <div class="mb-3">
                            <label class="form-label" for="add_color_code">{{__('Front-end/pages/categories.color_code')}}</label>
                            <input id="add_color_code" type="text" class="form-control colorCodeInput" placeholder="{{__('Front-end/pages/categories.color_code')}}" autocomplete="off" name="color_code_value" required maxlength="30">
                            <div class="valid-feedback">
                                {{__('Front-end/pages/categories.color_code.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/categories.color_code.invalid')}}
                            </div>
                        </div>
                    @endif
                        <input type="hidden" name="attribute_id" value="{{$attribute->id}}">
                    </div>
                    <div class="modal-footer">
                        <!-- Submit & Close buttons -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Front-end/pages/cities.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Front-end/pages/attributes.add')}}</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <form action="../values/update" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{__('Front-end/pages/attributes.edit.value')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" name="id" id="edit_id">
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label" for="edit_name">{{__('Front-end/pages/attributes.name')}}</label>
                            <input id="edit_name" type="text" class="form-control" placeholder="{{__('Front-end/pages/attributes.name')}}" autocomplete="off" name="name" required maxlength="30">
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/attributes.name.invalid')}}
                            </div>
                        </div>
                        <!-- Image Frontend Type Value -->
                        @if($attribute->frontend_type == 'image')
                            <div class="mb-3">
                                <label class="form-label" for="add_image_value">{{__('Front-end/pages/attributes.image')}}</label>
                                <input type="file" class="form-control" id="inputEmail4" name="image_value" autocomplete="off"
                                       accept=".jpg, .jpeg, .png, .svg" required>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/attributes.image.invalid')}}
                                </div>
                            </div>
                        @endif
                        <!-- Color Frontend Type Value -->
                        @if($attribute->frontend_type == 'color')
                            <div class="mb-3">
                                <label class="form-label" for="edit_color_code">{{__('Front-end/pages/categories.color_code')}}</label>
                                <input id="edit_color_code" type="text" class="form-control colorCodeInput" placeholder="{{__('Front-end/pages/categories.color_code')}}" autocomplete="off" name="color_code_value" required maxlength="30">
                                <div class="valid-feedback">
                                    {{__('Front-end/pages/categories.color_code.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/categories.color_code.invalid')}}
                                </div>
                            </div>
                        @endif
                        <input type="hidden" name="attribute_id" value="{{$attribute->id}}">
                        <input type="hidden" name="id" value="" id="edit_id">
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Front-end/pages/cities.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Front-end/pages/attributes.edit')}}</button>
                    </div>
                </div>
            </div>
        </form>

    </div>

@endsection
@section('scripts')
    <script src="{{URL::asset('js/datatables.js')}}"></script>

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
        document.querySelector('.colorCodeInput').addEventListener('input', function (){
            checkColorCode('add_color_code')
        });
        document.querySelectorAll('.colorCodeInput')[1].addEventListener('input', function (){
            checkColorCode('edit_color_code')
        });

        function checkColorCode(inputId) {
            let colorInput = document.getElementById(inputId);
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
        $(document).ready(function() {
            $('#edit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var color_code = button.data('color');
                var modal = $(this);
                modal.find('.modal-body #edit_name').val(name);
                modal.find('.modal-body #edit_color_code').val(color_code);
                modal.find('.modal-body #edit_id').val(id);
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                responsive: true
            });
        });
    </script>

    <script>
        function deletes(valueId) {
            Swal.fire({
                title: '{{__('Front-end/pages/users.are.you.sure')}}',
                text: "{{__('Front-end/pages/users.not.able.revert')}}",
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{__('Front-end/pages/users.delete')}}'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the delete operation here
                    deleteAttribute(valueId);
                }
            })
        }

        function deleteAttribute(valueId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('values.destroy', ['value' => '__valueId__']) }}'.replace('__valueId__', valueId);
            form.innerHTML = `<input type="hidden" name="_method" value="DELETE">`;
            form.innerHTML = `<input type="hidden" name="id" value="${valueId}">`;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;

            form.appendChild(csrfInput);
            form.innerHTML += `<input type="hidden" name="_method" value="DELETE">`;

            document.body.appendChild(form);
            form.submit();
        }
    </script>
    @if(\Illuminate\Support\Facades\Session::has('edit-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/attributes.edited')}}',
                '{{\Illuminate\Support\Facades\Session::get('edit-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('add-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/attributes.value.add')}}',
                '{{\Illuminate\Support\Facades\Session::get('add-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('delete-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/attributes.deleted')}}',
                '{{\Illuminate\Support\Facades\Session::get('delete-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('delete-failed'))
        <script>
            Swal.fire({
                title: '{{__('Front-end/pages/attributes.can.not.delete')}}',
                text: '{{\Illuminate\Support\Facades\Session::get('delete-failed')}}',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: '{{__('Front-end/pages/attributes.ok')}}'
            })
        </script>
    @endif
@endsection
