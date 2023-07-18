@extends('layouts.master')
@section('title',__('Front-end/pages/cities.title'))
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
            <h3><strong>{{__('Front-end/pages/cities.location.management')}}</strong> {{__('Front-end/pages/cities.title')}}</h3>
        </div>
{{--        @can('add_city')--}}
            <div class="col-auto ms-auto text-end mt-n1">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                    {{__('Front-end/pages/cities.add.city')}}
                </button>
            </div>
{{--        @endcan--}}
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
                    <th>{{__('Front-end/pages/cities.name')}}</th>
                    <th>{{__('Front-end/pages/cities.state')}}</th>
                    <th>{{__('Front-end/pages/cities.country')}}</th>
                    <th>{{__('Front-end/pages/cities.number.users')}}</th>
                    <th>{{__('Front-end/pages/cities.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cities as $city)
                    <tr>
                        <td>{{$rowNumber++}}</td>
                        <td>{{$city->name}}</td>
                        <td>{{$city->state->name}}</td>
                        <td>{{$city->state->country->name}}</td>
                        <td>{{$city->users->count()}}</td>
                        <td>
{{--                                @can('edit_city')--}}
                            <a href="#" data-bs-toggle="modal" data-bs-target="#edit"
                               data-id="{{ $city->id }}"
                               data-name="{{ $city->name }}"
                               data-state_id="{{$city->state->id}}"
                               data-state_name="{{$city->state->name}}"
                            >
                                <i class="align-middle" data-feather="edit-2"></i>
                            </a>
{{--                                @endcan--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- Add Setting Form -->
        <div class="modal fade" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form action="{{route('cities.store')}}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">{{__('Front-end/pages/cities.add.city')}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label" for="add_name">{{__('Front-end/pages/cities.name')}}</label>
                                <input id="add_name" type="text" class="form-control" placeholder="{{__('Front-end/pages/cities.name')}}" autocomplete="off" name="name" required maxlength="30">
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/cities.name.invalid')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="inputCountry">{{__('Front-end/pages/cities.country')}}</label>
                                <select id="inputCountry" class="form-control" disabled>
                                    <option
                                        selected>{{__('Front-end/country.' . \App\Models\Country::first()->name)}}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="add_inputState">{{__('Front-end/pages/users.state')}}</label>
                                <select id="add_inputState" class="form-control choices-single" required name="state_id">
                                    <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{__('Front-end/states.' . $state->name)}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Submit & Close buttons -->
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Front-end/pages/cities.close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('Front-end/pages/cities.add')}}</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <!-- Edit Setting Form -->
        <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form action="cities/update" method="post" class="needs-validation" novalidate>
                @csrf
                @method('put')
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">{{__('Front-end/pages/cities.edit.city')}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" value="" name="id" id="edit_id">
                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label" for="edit_name">{{__('Front-end/pages/cities.name')}}</label>
                                <input id="edit_name" type="text" class="form-control" placeholder="{{__('Front-end/pages/cities.name')}}" autocomplete="off" name="name" required maxlength="30">
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/cities.name.invalid')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="inputCountry">{{__('Front-end/pages/cities.country')}}</label>
                                <select id="inputCountry" class="form-control" disabled>
                                    <option
                                        selected>{{__('Front-end/country.' . \App\Models\Country::first()->name)}}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="edit_inputState">{{__('Front-end/pages/cities.state')}}</label>
                                <select id="edit_inputState" class="form-control choices-single" required name="state_id">
                                    <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{__('Front-end/states.' . $state->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Front-end/pages/cities.close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('Front-end/pages/cities.edit')}}</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @section('scripts')
        <script src="{{URL::asset('js/datatables.js')}}"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Datatables Responsive
                $("#datatables-reponsive").DataTable({
                    responsive: true
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Choices.js
                new Choices(document.querySelector(".choices-single"));
                new Choices(document.querySelector(".choices-multiple"));
                new Choices(document.querySelector("#add_inputState"));
                // Flatpickr
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
                    dateFormat: "Y-m-d"
                });
                flatpickr(".flatpickr-range", {
                    mode: "range",
                    dateFormat: "Y-m-d"
                });
                flatpickr(".flatpickr-time", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
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
{{--        <script>--}}
{{--            $('#edit').on('show.bs.modal', function(event) {--}}
{{--                var button = $(event.relatedTarget)--}}
{{--                var id = button.data('id');--}}
{{--                var state_id = button.data('state_id');--}}
{{--                var state_name = button.data('state_name');--}}
{{--                var name = button.data('name');--}}
{{--                var modal = $(this)--}}
{{--                modal.find('.modal-body #id').val(id);--}}
{{--                modal.find('.modal-body #edit_state_id').val(state_id);--}}
{{--                modal.find('.modal-body #edit_state_name').val(state_name);--}}
{{--                modal.find('.modal-body #edit_name').val(name);--}}
{{--            })--}}
{{--        </script>--}}
        <script>
            // Use jQuery's ready function to ensure the script runs after the document is fully loaded
            $(document).ready(function() {
                $('#edit').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    var name = button.data('name');
                    var state_id = button.data('state_id');
                    var modal = $(this);
                    modal.find('.modal-body #edit_name').val(name);
                    modal.find('.modal-body #edit_inputState').val(state_id);
                    modal.find('.modal-body #edit_id').val(id);
                });
            });
        </script>
{{--        <script>--}}
{{--            function deletes(cityId) {--}}
{{--                Swal.fire({--}}
{{--                    title: '{{__('Front-end/pages/users.are.you.sure')}}',--}}
{{--                    text: "{{__('Front-end/pages/users.not.able.revert')}}",--}}
{{--                    icon: 'error',--}}
{{--                    showCancelButton: false,--}}
{{--                    confirmButtonColor: '#d33',--}}
{{--                    cancelButtonColor: '#3085d6',--}}
{{--                    confirmButtonText: '{{__('Front-end/pages/users.delete')}}'--}}
{{--                }).then((result) => {--}}
{{--                    if (result.isConfirmed) {--}}
{{--                        // Perform the delete operation here--}}
{{--                        deleteCity(cityId);--}}
{{--                    }--}}
{{--                })--}}
{{--            }--}}

{{--            function deleteCity(cityId) {--}}
{{--                // Send an AJAX request or submit a form to the delete route--}}
{{--                const form = document.createElement('form');--}}
{{--                form.method = 'POST';--}}
{{--                form.action = '{{ route('cities.destroy', ['city' => '__cityId__']) }}'.replace('__cityId__', cityId);--}}
{{--                form.innerHTML = `<input type="hidden" name="_method" value="DELETE">`;--}}
{{--                form.innerHTML = `<input type="hidden" name="id" value="${cityId}">`;--}}
{{--                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');--}}
{{--                const csrfInput = document.createElement('input');--}}
{{--                csrfInput.type = 'hidden';--}}
{{--                csrfInput.name = '_token';--}}
{{--                csrfInput.value = csrfToken;--}}

{{--                form.appendChild(csrfInput);--}}
{{--                form.innerHTML += `<input type="hidden" name="_method" value="DELETE">`;--}}

{{--                document.body.appendChild(form);--}}
{{--                form.submit();--}}
{{--            }--}}
{{--        </script>--}}
        @if(\Illuminate\Support\Facades\Session::has('edit-success'))
            <script>
                Swal.fire(
                    '{{__('Front-end/pages/cities.edited')}}',
                    '{{\Illuminate\Support\Facades\Session::get('edit-success')}}',
                    'success'
                )
            </script>
        @endif
        @if(\Illuminate\Support\Facades\Session::has('add-success'))
            <script>
                Swal.fire(
                    '{{__('Front-end/pages/cities.add')}}',
                    '{{\Illuminate\Support\Facades\Session::get('add-success')}}',
                    'success'
                )
            </script>
        @endif
    @endsection
@endsection
