@extends('layouts.master')
@section('title',__('Front-end/pages/settings.settings'))
@section('css')
    @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
        <link class="js-stylesheet" href="{{URL::asset('css/app.rtl.css')}}" rel="stylesheet">
    @else
        <link class="js-stylesheet" href="{{URL::asset('css/light.css')}}" rel="stylesheet">
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .zip-code-item {
            display: inline-block;
            margin: 5px;
            padding: 8px 15px;
            background-color: #f1f1f1;
            border-radius: 5px;
        }
    </style>
@endsection

@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{__('Front-end/pages/settings.system')}}</strong> / {{__('Front-end/pages/settings.settings')}}
            </h3>
        </div>
        @can('settings.add')
            <div class="col-auto ms-auto text-end mt-n1">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                    {{__('Front-end/pages/settings.add.setting')}}
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addZipCodeModal">
                    {{__('Front-end/pages/settings.serving_area')}}
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#function_setting">
                    {{__('Front-end/pages/settings.function_setting')}}
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
                    <th>{{__('Front-end/pages/settings.display_name')}}</th>
                    <th>{{__('Front-end/pages/settings.namespace')}}</th>
                    <th>{{__('Front-end/pages/settings.key')}}</th>
                    <th>{{__('Front-end/pages/settings.value')}}</th>
                    <th>{{__('Front-end/pages/settings.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @php $rowNumber = 1; @endphp
                @foreach($settings as $setting)
                    <tr>
                        <td>{{$rowNumber++}}</td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#show"
                               data-setting-display-name="{{ $setting->display_name }}"
                               data-setting-namespace="{{ $setting->namespace }}"
                               data-setting-key="{{ $setting->key }}"
                               data-setting-type="{{ $setting->type }}"
                               data-setting-value="{{ $setting->value }}">
                                {{ $setting->display_name }}
                            </a>
                        </td>
                        <td>{{$setting->namespace}}</td>
                        <td>{{$setting->key}}</td>
                        <td>{{$setting->value}}</td>
                        <td>
                            @can('settings.edit')
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit"
                                   data-setting-id="{{ $setting->id }}"
                                   data-setting-display-name="{{ $setting->display_name }}"
                                   data-setting-namespace="{{ $setting->namespace }}"
                                   data-setting-value="{{ $setting->value }}"
                                   data-setting-key="{{ $setting->key }}"
                                   data-setting-type="{{ $setting->type }}">
                                    <i class="align-middle" data-feather="edit-2"></i>
                                </a>

                            @endcan
                            @can('settings.delete')
                                <a href="#" onclick="deletes({{ $setting->id }})"><i class="align-middle"
                                                                                     data-feather="trash"></i></a>
                            @endcan</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add Setting Form -->
        <div class="modal fade" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form action="{{route('settings.store')}}" method="post" class="needs-validation" novalidate>
                @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{__('Front-end/pages/settings.add.setting')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Display Name -->
                        <div class="mb-3">
                            <label class="form-label" for="display_name">{{__('Front-end/pages/settings.display_name')}}</label>
                            <input id="display_name" type="text" class="form-control" placeholder="{{__('Front-end/pages/settings.display_name')}}" autocomplete="off" name="display_name" required>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/settings.display_name.invalid')}}
                            </div>
                        </div>
                        <!-- Namespace -->
                        <div class="mb-3">
                            <label class="form-label" for="namespace">{{__('Front-end/pages/settings.namespace')}}</label>
                            <input type="text" id="namespace" class="form-control" placeholder="{{__('Front-end/pages/settings.namespace')}}" autocomplete="off" name="namespace" required>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/settings.namespace.invalid')}}
                            </div>
                        </div>
                        <!-- Key -->
                        <div class="mb-3">
                            <label class="form-label" for="key">{{__('Front-end/pages/settings.key')}}</label>
                            <input type="text" id="key" class="form-control" placeholder="{{__('Front-end/pages/settings.key')}}" autocomplete="off" name="key" required>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/settings.key.invalid')}}
                            </div>
                        </div>
                        <!-- Type -->
                        <div class="mb-3">
                            <label class="form-label" for="type">{{__('Front-end/pages/settings.type')}}</label>
                            <select id="type" class="form-control" name="type" required>
                                <option selected disabled value="">{{__('Front-end/pages/settings.select.type')}}</option>
                                @foreach($setting->types as $type)
                                    <option value="{{$type}}">{{$type}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/settings.type.invalid')}}
                            </div>
                        </div>
                        <!-- Value -->
                        <div class="mb-3">
                            <label class="form-label" for="value">{{__('Front-end/pages/settings.value')}}</label>
                            <input type="text" id="value" class="form-control" placeholder="{{__('Front-end/pages/settings.value')}}" autocomplete="off" name="value" required>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/settings.value.invalid')}}
                            </div>
                        </div>


                        <!-- Boolean Options (Select for type 'boolean') -->
                        <div class="mb-3" style="display: none;" id="booleanOptionsSelect">
                            <select class="form-select" name="value">
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>
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


        <!-- Edit Setting Form -->
        <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form action="{{route('settings.update',$setting->id)}}" method="post" class="needs-validation" novalidate>
                @csrf
                @method('put')
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">{{__('Front-end/pages/settings.edit.setting')}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Display Name -->
                            <div class="mb-3">
                                <label class="form-label" for="edit_display_name">{{__('Front-end/pages/settings.display_name')}}</label>
                                <input id="edit_display_name" type="text" class="form-control" placeholder="{{__('Front-end/pages/settings.display_name')}}" autocomplete="off" name="display_name" required value="{{ $setting->display_name }}">
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/settings.display_name.invalid')}}
                                </div>
                            </div>
                            <!-- Namespace -->
                            <div class="mb-3">
                                <label class="form-label" for="edit_namespace">{{__('Front-end/pages/settings.namespace')}}</label>
                                <input type="text" id="edit_namespace" class="form-control" placeholder="{{__('Front-end/pages/settings.namespace')}}" autocomplete="off" name="namespace" required value="{{$setting->namespace}}">
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/settings.namespace.invalid')}}
                                </div>
                            </div>
                            <!-- Key -->
                            <div class="mb-3">
                                <label class="form-label" for=edit_"key">{{__('Front-end/pages/settings.key')}}</label>
                                <input type="text" id="edit_key" class="form-control" placeholder="{{__('Front-end/pages/settings.key')}}" autocomplete="off" name="key" required value="{{$setting->key}}">
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/settings.key.invalid')}}
                                </div>
                            </div>
                            <!-- Type -->
                            <div class="mb-3">
                                <label class="form-label" for="edit_type">{{__('Front-end/pages/settings.type')}}</label>
                                <select id="edit_type" class="form-control" name="type" required>
                                    @foreach($setting->types as $type)
                                        <option value="{{$type}}" {{$type == $setting->type ? 'selected' : ''}}>{{$type}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/settings.type.invalid')}}
                                </div>
                            </div>
                            <!-- Value -->
                            <div class="mb-3">
                                <label class="form-label" for="edit_value">{{__('Front-end/pages/settings.value')}}</label>
                                <input type="text" id="edit_value" class="form-control" placeholder="{{__('Front-end/pages/settings.value')}}" autocomplete="off" name="value" required value="{{$setting->value}}">
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/settings.value.invalid')}}
                                </div>
                            </div>


                            <!-- Boolean Options (Select for type 'boolean') -->
                            <div class="mb-3" style="display: none;" id="edit_booleanOptionsSelect">
                                <select class="form-select" name="value">
                                    <option value="true" {{'true' == $setting->value ? 'selected' : ''}}>True</option>
                                    <option value="false" {{'false' == $setting->value ? 'selected' : ''}}>False</option>
                                </select>
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

        <!-- Show Setting Modal -->
        <div class="modal fade" id="show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{__('Front-end/pages/settings.show.setting')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Display Name -->
                        <div class="mb-3">
                            <label class="form-label" for="show_display_name">{{__('Front-end/pages/settings.display_name')}}</label>
                            <input id="show_display_name" type="text" class="form-control" placeholder="{{__('Front-end/pages/settings.display_name')}}" autocomplete="off" name="display_name" disabled>
                        </div>
                        <!-- Namespace -->
                        <div class="mb-3">
                            <label class="form-label" for="show_namespace">{{__('Front-end/pages/settings.namespace')}}</label>
                            <input type="text" id="show_namespace" class="form-control" placeholder="{{__('Front-end/pages/settings.namespace')}}" autocomplete="off" name="namespace" disabled>
                        </div>
                        <!-- Key -->
                        <div class="mb-3">
                            <label class="form-label" for="show_key">{{__('Front-end/pages/settings.key')}}</label>
                            <input type="text" id="show_key" class="form-control" placeholder="{{__('Front-end/pages/settings.key')}}" autocomplete="off" name="key" disabled>
                        </div>
                        <!-- Type -->
                        <div class="mb-3">
                            <label class="form-label" for="show_type">{{__('Front-end/pages/settings.type')}}</label>
                            <select id="show_type" class="form-control" name="type" disabled>
                                @foreach($setting->types as $type)
                                    <option value="{{$type}}">{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Value -->
                        <div class="mb-3">
                            <label class="form-label" for="show_value">{{__('Front-end/pages/settings.value')}}</label>
                            <input type="text" id="show_value" class="form-control" placeholder="{{__('Front-end/pages/settings.value')}}" autocomplete="off" name="value" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Close button -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Front-end/pages/settings.close')}}</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Zip Code Modal -->
        <div class="modal fade" id="addZipCodeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{__('Front-end/pages/settings.add.zip_code')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Zip Code Input and Add Button -->
                        <div class="input-group mb-3">
                            <input type="text" id="inputZipCode" class="form-control" placeholder="{{__('Front-end/pages/settings.enter.zip_code')}}" aria-label="Enter Zip Code" aria-describedby="addZipCodeBtn" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                            <button class="btn btn-primary" type="button" id="addZipCodeBtn">{{__('Front-end/pages/settings.add')}}</button>
                        </div>

                        <!-- Redesigned Existing Zip Codes -->
                        <div id="existingZipCodes" class="d-flex flex-wrap">
                            @foreach($zipCodes as $zipCode)
                                <div class="zip-code-item ">
                                    {{ $zipCode->zip_code }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Front-end/pages/settings.close')}}</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Function Setting Form -->
        @php $staticSetting = \App\Models\StaticSetting::first(); @endphp
            <!-- Function Setting Form -->
        <div class="modal fade" id="function_setting" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form action="{{ route('staticSetting.update') }}" method="post" class="needs-validation" novalidate>
                @csrf
                @method('put')
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">{{ __('Front-end/pages/settings.function_setting') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Update Open Cash Order -->
                            <div class="mb-3">
                                <label class="form-label" for="update_open">{{ __('Front-end/pages/settings.update.open.cash.order') }}</label>
                                <input type="checkbox" class="form-check-input" id="update_open" name="update_open" @if($staticSetting->update_open) checked @endif>
                            </div>
                            <!-- Confirm Place Order -->
                            <div class="mb-3">
                                <label class="form-label" for="confirm_place_order">{{ __('Front-end/pages/settings.confirm.place.order') }}</label>
                                <input type="checkbox" class="form-check-input" id="confirm_place_order" name="confirm_place_order" @if($staticSetting->confirm_place_order) checked @endif>
                            </div>
                            <!-- Create New Order from Back Office -->
                            <div class="mb-3">
                                <label class="form-label" for="create_new_order_back_office">{{ __('Front-end/pages/settings.create.new.order.back.office') }}</label>
                                <input type="checkbox" class="form-check-input" id="create_new_order_back_office" name="create_new_order_back_office" @if($staticSetting->create_new_order_back_office) checked @endif>
                            </div>
                            <!-- Show Unavailable Offers -->
                            <div class="mb-3">
                                <label class="form-label" for="show_unavailable_offers">{{ __('Front-end/pages/settings.show.unavailable.offers') }}</label>
                                <input type="checkbox" class="form-check-input" id="show_unavailable_offers" name="show_unavailable_offers" @if($staticSetting->show_unavailable_offers) checked @endif>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Submit & Close buttons -->
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Front-end/pages/settings.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Front-end/pages/settings.edit') }}</button>
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
            function deletes(settingId) {
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
                        deleteSetting(settingId);
                    }
                })
            }

            function deleteSetting(settingId) {
                // Send an AJAX request or submit a form to the delete route
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('settings.destroy', ['setting' => '__settingId__']) }}'.replace('__settingId__', settingId);
                form.innerHTML = `<input type="hidden" name="_method" value="DELETE">`;
                form.innerHTML = `<input type="hidden" name="id" value="${settingId}">`;
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
                const addTypeSelect = $('#type');
                const addValueInput = $('#value');
                const addBooleanOptionsSelect = $('#booleanOptionsSelect');

                const editTypeSelect = $('#edit_type');
                const editValueInput = $('#edit_value');
                const editBooleanOptionsSelect = $('#edit_booleanOptionsSelect');

                function handleTypeChange(selectedType, valueInput, booleanOptionsSelect) {
                    if (selectedType === 'boolean') {
                        if (valueInput.is(':visible')) {
                            valueInput.replaceWith(booleanOptionsSelect);
                            booleanOptionsSelect.show();
                        }
                    } else {
                        if (booleanOptionsSelect.is(':visible')) {
                            booleanOptionsSelect.replaceWith(valueInput);
                            booleanOptionsSelect.hide();
                        }

                        valueInput.val('').removeClass('is-invalid');

                        if (selectedType === 'integer') {
                            valueInput.attr('pattern', '^\\d+$');
                        } else if (selectedType === 'float') {
                            valueInput.attr('pattern', '^\\d+(\\.\\d+)?$');
                        } else if (selectedType === 'color') {
                            valueInput.attr('pattern', '^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$');
                        } else {
                            valueInput.removeAttr('pattern');
                        }
                    }
                }

                // Add modal type change event
                addTypeSelect.on('change', function() {
                    const selectedType = addTypeSelect.val();
                    handleTypeChange(selectedType, addValueInput, addBooleanOptionsSelect);
                });

                // Edit modal type change event
                editTypeSelect.on('change', function() {
                    const selectedType = editTypeSelect.val();
                    handleTypeChange(selectedType, editValueInput, editBooleanOptionsSelect);
                });

                // Edit modal show event
                $('#edit').on('show.bs.modal', function (event) {
                    const link = $(event.relatedTarget);
                    const settingId = link.data('setting-id');
                    const displayName = link.data('setting-display-name');
                    const value = link.data('setting-value');
                    const key = link.data('setting-key');
                    const type = link.data('setting-type');
                    const namespace = link.data('setting-namespace');

                    const form = $(this).find('form');
                    form.attr('action', form.attr('action').replace(/\/\d+$/, '/' + settingId));

                    $('#edit_display_name').val(displayName);
                    $('#edit_key').val(key);
                    $('#edit_namespace').val(namespace);
                    editTypeSelect.val(type);
                    handleTypeChange(type, editValueInput, editBooleanOptionsSelect);

                    if (type === 'boolean') {
                        editBooleanOptionsSelect.find('option[value="' + value + '"]').prop('selected', true);
                    } else {
                        editValueInput.val(value);
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                // Show modal show event
                $('#show').on('show.bs.modal', function (event) {
                    const link = $(event.relatedTarget);
                    const displayName = link.data('setting-display-name');
                    const namespace = link.data('setting-namespace');
                    const key = link.data('setting-key');
                    const type = link.data('setting-type');
                    const value = link.data('setting-value');

                    // Populate the data into the modal input fields
                    $('#show_display_name').val(displayName);
                    $('#show_namespace').val(namespace);
                    $('#show_key').val(key);
                    $('#show_type').val(type);
                    $('#show_value').val(value);
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                const addZipCodeBtn = $('#addZipCodeBtn');
                const inputZipCode = $('#inputZipCode');
                const existingZipCodes = $('#existingZipCodes');

                addZipCodeBtn.on('click', function() {
                    const zipCode = inputZipCode.val();

                    // Perform validation if needed (e.g., non-empty value)
                    if (!zipCode) {
                        alert('Please enter a valid zip code.');
                        return;
                    }

                    // Send the zip code to the server using AJAX
                    $.ajax({
                        url: '{{route('zip-codes.store')}}',
                        type: 'POST',
                        data: { zip_code: zipCode },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // Handle success response, e.g., display the new zip code in the list
                            const zipCodeItem = $('<div class="zip-code-item"></div>');
                            zipCodeItem.text(response.zip_code);
                            existingZipCodes.append(zipCodeItem);
                            inputZipCode.val(''); // Clear the input field
                        },
                        error: function(error) {
                            console.log(error); // Log the error to the console
                        }
                    });
                });
            });
        </script>











        @if(\Illuminate\Support\Facades\Session::has('delete-success'))
            <script>
                Swal.fire(
                    '{{__('Front-end/pages/users.deleted')}}',
                    '{{\Illuminate\Support\Facades\Session::get('delete-success   ')}}',
                    'success'
                )
            </script>
        @endif
    @endsection
@endsection
