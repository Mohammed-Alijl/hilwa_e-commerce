@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/units.title'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{__('Front-end/pages/units.title')}}</strong></h3>
        </div>
        @can('add_unit')
            <div class="col-auto ms-auto text-end mt-n1">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                    {{__('Front-end/pages/units.add.unit')}}
                </button>
            </div>
        @endcan
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Front-end/pages/units.name')}}</th>
                    <th>{{__('Front-end/pages/users.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($units as $unit)
                    <tr>
                        <td>{{$rowNumber++}}</td>

                        <td>{{ $unit->name }}</td>
                        <td>
                            @can('edit_unit')
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit"
                                   data-id="{{ $unit->id }}"
                                   data-name="{{ $unit->getTranslation('name','en') }}"
                                >
                                    <i class="align-middle" data-feather="edit-2"></i>
                                </a>
                            @endcan
                            @can('delete_customer')
                                <a href="#" onclick="deletes({{ $unit->id }})"><i class="align-middle"
                                                                                      data-feather="trash"></i></a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Add Unit Form -->
    <div class="modal fade" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <form action="{{route('units.store')}}" method="post" class="needs-validation" novalidate>
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{__('Front-end/pages/units.add.unit')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Language -->
                        <div class="mb-3">
                            <label class="form-label" for="type">{{__('Front-end/pages/units.language')}}</label>
                            <select id="type" class="form-control" disabled>
                                <option selected>{{\App\Models\Language::where('code','en')->first()->name}}</option>
                            </select>
                        </div>
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label" for="name">{{__('Front-end/pages/units.name')}}</label>
                            <input id="name" type="text" class="form-control" placeholder="{{__('Front-end/pages/units.name')}}" autocomplete="off" name="name" required>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/units.name.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Submit & Close buttons -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Front-end/pages/settings.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Front-end/pages/settings.add')}}</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <!-- Edit Unit Form -->
    <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <form action="units/update" method="post" class="needs-validation" novalidate>
            @csrf
            @method('put')
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{__('Front-end/pages/units.edit.unit')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="" id="edit_unit_id" name="id">
                        <!-- Language -->
                        <div class="mb-3">
                            <label class="form-label" for="language">{{__('Front-end/pages/units.language')}}</label>
                            <select id="language" class="form-control" required name="language_id">
                                @foreach($languages as $language)
                                <option value="{{$language->id}}" {{$language->code =='en' ? 'selected' : ''}}>{{$language->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label" for="edit_name">{{__('Front-end/pages/units.name')}}</label>
                            <input id="edit_name" type="text" class="form-control" placeholder="{{__('Front-end/pages/units.name')}}" autocomplete="off" name="name" required>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/units.name.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Submit & Close buttons -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Front-end/pages/settings.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Front-end/pages/settings.edit')}}</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
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
        function deletes(unitsId) {
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
                    deleteCustomer(unitsId);
                }
            })
        }

        function deleteCustomer(unitsId) {
            // Send an AJAX request or submit a form to the delete route
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('units.destroy', ['unit' => '__unitsId__']) }}'.replace('__unitsId__', unitsId);
            form.innerHTML = `<input type="hidden" name="_method" value="DELETE">`;
            form.innerHTML = `<input type="hidden" name="id" value="${unitsId}">`;
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
    <script>
        $(document).ready(function() {
            $('#edit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var modal = $(this);
                modal.find('.modal-body #edit_name').val(name);
                modal.find('.modal-body #edit_unit_id').val(id);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Get the initial value of the name input
            const initialName = $("#edit_name").val();

            // Event listener for the language select change
            $("#language").change(function() {
                // Get the selected language ID
                const languageId = $(this).val();

                $.ajax({
                    url: "{{ URL::to('admin/unit-languages') }}/" + languageId + '/' + document.getElementById('edit_unit_id').value,
                    method: "GET",
                    success: function(data) {
                        $("#edit_name").val(data.unit_name);
                    },
                    error: function(xhr, status, error) {
                        $("#edit_name").val(initialName);
                    }
                });
            });
        });
    </script>
    @if(\Illuminate\Support\Facades\Session::has('delete-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/units.deleted')}}',
                '{{\Illuminate\Support\Facades\Session::get('delete-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('add-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/units.unit.add')}}',
                '{{\Illuminate\Support\Facades\Session::get('add-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('edit-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/units.unit.edit')}}',
                '{{\Illuminate\Support\Facades\Session::get('edit-success')}}',
                'success'
            )
        </script>
    @endif
@endsection
