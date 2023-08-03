@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/customers.add.customer'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>
                <strong>{{__('Front-end/pages/customers.customers')}}</strong> / {{__('Front-end/pages/customers.add.customer')}}
            </h3>
        </div>
        <div class="col-auto ms-auto text-end mt-n1">
            <button class="btn btn-primary" id="addAddressButton">{{__('Front-end/pages/customers.new.address')}}</button>
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
    <form action="{{route('customers.store')}}" method="post" enctype="multipart/form-data" id="create_user"
          class="needs-validation" novalidate>
        @csrf
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{__('Front-end/pages/customers.add.customer')}}</h5>
                    <h6 class="card-subtitle text-muted">{{__('Front-end/pages/customers.add.description')}}</h6>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="first_name">{{__('Front-end/pages/users.first.name')}}</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                   placeholder="{{__('Front-end/pages/users.first.name')}}" autocomplete="off" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.first_name.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.first_name.invalid')}}
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="last_name">{{__('Front-end/pages/users.last.name')}}</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                   placeholder="{{__('Front-end/pages/users.last.name')}}" autocomplete="off" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.last_name.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.last_name.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="email">{{__('Front-end/pages/users.email')}}</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="{{__('Front-end/pages/users.email')}}" required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.email.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.email.invalid')}}
                            </div>
                            <div id="email-validation-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="mobile_number" class="form-label">{{__('Front-end/pages/users.mobile')}}</label>
                            <div class="input-group">
                                <span class="input-group-text" id="mobile_number">05</span>
                                <input type="text" class="form-control" id="mobile_number"
                                       aria-describedby="inputGroupPrepend" name="mobile_number" autocomplete="off"
                                       placeholder="{{__('Front-end/pages/users.mobile')}}"
                                       required maxlength="8" pattern=".{8,8}"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                >
                                <div id="mobile-validation-feedback"></div>

                                <div class="valid-feedback">
                                    {{__('Front-end/pages/users.user.mobile_number.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/users.user.mobile_number.invalid')}}
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="inputPassword">{{__('Front-end/pages/users.password')}}</label>
                            <input type="password" class="form-control" name="password" id="inputPassword"
                                   placeholder="{{__('Front-end/pages/users.password')}}" autocomplete="off" required
                                   minlength="8">
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.password.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.password.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="inputPasswordConfirm">{{__('Front-end/pages/users.password.confirm')}}</label>
                            <input type="password" class="form-control" id="inputPasswordConfirm"
                                   name="confirm-password"
                                   placeholder="{{__('Front-end/pages/users.password.confirm')}}" autocomplete="off"
                                   required>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.password.confirm.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.password.confirm.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="inputEmail4">{{__('Front-end/pages/users.profile.image')}}</label>
                            <input type="file" class="form-control" id="inputEmail4" name="pic" autocomplete="off"
                                   accept=".jpg, .jpeg, .png, .svg">
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.profile.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.profile.invalid')}}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{__('Front-end/pages/customers.add.customer.address')}}</h5>
                    <h6 class="card-subtitle text-muted">{{__('Front-end/pages/customers.add.description')}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="form-label"
                                   for="latitude">{{__('Front-end/pages/customers.latitude')}}</label>
                            <input type="text" class="form-control" id="latitude" name="latitude[]"
                                   placeholder="{{__('Front-end/pages/customers.latitude')}}" autocomplete="off" required value="24.7521419"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                            >
                            <div class="valid-feedback">
                                {{__('Front-end/pages/customers.latitude.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/customers.latitude.invalid')}}
                            </div>
                        </div>

                        <div class="mb-3 col-md-4"  >
                            <label class="form-label" for="longitude">{{__('Front-end/pages/customers.longitude')}}</label>
                            <input type="text" class="form-control" id="longitude" name="longitude[]"
                                   placeholder="{{__('Front-end/pages/customers.longitude')}}" autocomplete="off" required value="46.7174697"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                            >
                            <div class="valid-feedback">
                                {{__('Front-end/pages/customers.longitude.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/customers.longitude.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <button type="button" class="btn btn-primary" id="lookUpButton">{{__("Front-end/pages/customers.look_up")}}</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="inputCountry">{{__('Front-end/pages/users.country')}}</label>
                            <select id="inputCountry" class="form-control" disabled>
                                <option
                                    selected>{{__('Front-end/country.' . \App\Models\Country::first()->name)}}</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="inputState">{{__('Front-end/pages/users.state')}}</label>
                            <select id="inputState" class="form-control choices-single" required disabled name="state[]">
                                <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{__('Front-end/states.' . $state->name)}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.state.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.state.invalid')}}
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="inputCity">{{__('Front-end/pages/users.city')}}</label>
                            <select id="inputCity" name="city[]" class="form-control choices-single" required disabled>
                                <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/users.user.city.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.city.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="district">{{__('Front-end/pages/customers.district')}}</label>
                            <input type="text" class="form-control" name="district[]" id="district"
                                   placeholder="{{__('Front-end/pages/customers.district')}}" required disabled minlength="1">
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/customers.district.invalid')}}
                            </div>
                            <div id="email-validation-feedback"></div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="street" class="form-label">{{__('Front-end/pages/customers.street')}}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="street"
                                       name="street[]" autocomplete="off"
                                       placeholder="{{__('Front-end/pages/customers.street')}}" required disabled>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/customers.street.invalid')}}
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="address_one">{{__('Front-end/pages/customers.address_one')}}</label>
                            <input type="text" class="form-control" id="address_one" name="address_one[]"
                                   placeholder="{{__('Front-end/pages/customers.address_one')}}" autocomplete="off" required disabled>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/customers.address_one.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/customers.address_one.invalid')}}
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="address_two">{{__('Front-end/pages/customers.address_two')}}</label>
                            <input type="text" class="form-control" id="address_two" name="address_two[]"
                                   placeholder="{{__('Front-end/pages/customers.address_two')}}" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label"
                                   for="postal_code">{{__('Front-end/pages/customers.postal_code')}}</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code[]"
                                   placeholder="{{__('Front-end/pages/customers.postal_code')}}" autocomplete="off" required disabled>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/customers.postal_code.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/customers.postal_code.invalid')}}
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="isDefault">{{__('Front-end/pages/customers.isDefault')}}</label>
                            <select name="isDefault[]" id="isDefault" class="form-control choices-single" required>
                                <option value="1" selected>{{__('Front-end/pages/customers.true')}}</option>
                                <option value="0">{{__('Front-end/pages/customers.false')}}</option>
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/customers.isDefault.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.isDefault.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="address_type">{{__('Front-end/pages/customers.address_type')}}</label>
                            <select name="address_type[]" id="address_type" class="form-control choices-single" required>
                                @foreach($address_types as $address_type)
                                <option value="{{$address_type->id}}">{{__('Front-end/pages/customers.' .  $address_type->name)}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/customers.address_type.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.address_type.invalid')}}
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="use_for">{{__('Front-end/pages/customers.use_for')}}</label>
                            <select name="use_for[]" id="use_for" class="form-control choices-single" required>
                                @foreach(\App\Models\CustomerAddress::$types as $type)
                                <option value="{{$type}}" >{{__('Front-end/pages/customers.' . $type)}}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                {{__('Front-end/pages/customers.use_for.valid')}}
                            </div>
                            <div class="invalid-feedback">
                                {{__('Front-end/pages/users.user.use_for.invalid')}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="status">{{__('Front-end/pages/customers.status')}}</label>
                            <select name="status[]" id="status" class="form-control choices-single" required>
                                    <option value="1">{{__('Front-end/pages/customers.true')}}</option>
                                    <option value="0">{{__('Front-end/pages/customers.false')}}</option>
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
            <div id="addressCardTemplate" style="display: none;">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">{{__('Front-end/pages/customers.add.customer.address')}}</h5>
                        <h6 class="card-subtitle text-muted">{{__('Front-end/pages/customers.add.description')}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label"
                                       for="latitude">{{__('Front-end/pages/customers.latitude')}}</label>
                                <input type="text" class="form-control" id="latitude" name="latitude[]"
                                       placeholder="{{__('Front-end/pages/customers.latitude')}}" autocomplete="off" required value="24.7521419"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                >
                                <div class="valid-feedback">
                                    {{__('Front-end/pages/customers.latitude.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/customers.latitude.invalid')}}
                                </div>
                            </div>

                            <div class="mb-3 col-md-4"  >
                                <label class="form-label" for="longitude">{{__('Front-end/pages/customers.longitude')}}</label>
                                <input type="text" class="form-control" id="longitude" name="longitude[]"
                                       placeholder="{{__('Front-end/pages/customers.longitude')}}" autocomplete="off" required value="46.7174697"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                >
                                <div class="valid-feedback">
                                    {{__('Front-end/pages/customers.longitude.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/customers.longitude.invalid')}}
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <button type="button" class="btn btn-primary look-up-btn" id="lookUpButton">{{__("Front-end/pages/customers.look_up")}}</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="inputCountry">{{__('Front-end/pages/users.country')}}</label>
                                <select id="inputCountry" class="form-control" disabled>
                                    <option
                                        selected>{{__('Front-end/country.' . \App\Models\Country::first()->name)}}</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="inputState">{{__('Front-end/pages/users.state')}}</label>
                                <select id="inputState" class="form-control choices-single" required disabled>
                                    <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{__('Front-end/states.' . $state->name)}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">
                                    {{__('Front-end/pages/users.user.state.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/users.user.state.invalid')}}
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="inputCity">{{__('Front-end/pages/users.city')}}</label>
                                <select id="inputCity" name="city_id[]" class="form-control choices-single" required disabled>
                                    <option selected disabled value="">{{__('Front-end/pages/users.choose')}}</option>
                                </select>
                                <div class="valid-feedback">
                                    {{__('Front-end/pages/users.user.city.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/users.user.city.invalid')}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="district">{{__('Front-end/pages/customers.district')}}</label>
                                <input type="text" class="form-control" name="district[]" id="district"
                                       placeholder="{{__('Front-end/pages/customers.district')}}" required disabled minlength="1">
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/customers.district.invalid')}}
                                </div>
                                <div id="email-validation-feedback"></div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="street" class="form-label">{{__('Front-end/pages/customers.street')}}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="street"
                                           name="street[]" autocomplete="off"
                                           placeholder="{{__('Front-end/pages/customers.street')}}" required disabled>
                                    <div class="invalid-feedback">
                                        {{__('Front-end/pages/customers.street.invalid')}}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label"
                                       for="address_one">{{__('Front-end/pages/customers.address_one')}}</label>
                                <input type="text" class="form-control" id="address_one" name="address_one[]"
                                       placeholder="{{__('Front-end/pages/customers.address_one')}}" autocomplete="off" required disabled>
                                <div class="valid-feedback">
                                    {{__('Front-end/pages/customers.address_one.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/customers.address_one.invalid')}}
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="address_two">{{__('Front-end/pages/customers.address_two')}}</label>
                                <input type="text" class="form-control" id="address_two" name="address_two[]"
                                       placeholder="{{__('Front-end/pages/customers.address_two')}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label"
                                       for="postal_code">{{__('Front-end/pages/customers.postal_code')}}</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code[]"
                                       placeholder="{{__('Front-end/pages/customers.postal_code')}}" autocomplete="off" required disabled>
                                <div class="valid-feedback">
                                    {{__('Front-end/pages/customers.postal_code.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/customers.postal_code.invalid')}}
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="isDefault">{{__('Front-end/pages/customers.isDefault')}}</label>
                                <select name="isDefault[]" id="isDefault" class="form-control choices-single" required>
                                    <option value="1" selected>{{__('Front-end/pages/customers.true')}}</option>
                                    <option value="0">{{__('Front-end/pages/customers.false')}}</option>
                                </select>
                                <div class="valid-feedback">
                                    {{__('Front-end/pages/customers.isDefault.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/users.user.isDefault.invalid')}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="address_type">{{__('Front-end/pages/customers.address_type')}}</label>
                                <select name="address_type[]" id="address_type" class="form-control choices-single" required>
                                    @foreach($address_types as $address_type)
                                        <option value="{{$address_type->id}}">{{__('Front-end/pages/customers.' .  $address_type->name)}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">
                                    {{__('Front-end/pages/customers.address_type.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/users.user.address_type.invalid')}}
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="use_for">{{__('Front-end/pages/customers.use_for')}}</label>
                                <select name="use_for[]" id="use_for" class="form-control choices-single" required>
                                    @foreach(\App\Models\CustomerAddress::$types as $type)
                                        <option value="{{$type}}" >{{__('Front-end/pages/customers.' . $type)}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">
                                    {{__('Front-end/pages/customers.use_for.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/users.user.use_for.invalid')}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="status">{{__('Front-end/pages/customers.status')}}</label>
                                <select name="status[]" id="status" class="form-control choices-single" required>
                                    <option value="1">{{__('Front-end/pages/customers.true')}}</option>
                                    <option value="0">{{__('Front-end/pages/customers.false')}}</option>
                                </select>
                                <div class="valid-feedback">
                                    {{__('Front-end/pages/customers.status.valid')}}
                                </div>
                                <div class="invalid-feedback">
                                    {{__('Front-end/pages/users.user.status.invalid')}}
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger remove-address-btn">{{__('Remove')}}</button>
                    </div>
                </div>
            </div>

            <!-- Address cards container -->
            <div id="addressCardsContainer"></div>
        <button id="save_user" type="submit"
                class="btn btn-primary">{{__('Front-end/pages/users.submit')}}</button>
        </div>
    </form>
@endsection
@section('scripts')
            <script>
                $(document).ready(function () {
                    $('#inputState').on('change', function () {
                        var StateId = $(this).val();
                        if (StateId) {
                            $.ajax({
                                url: "{{ URL::to('state-cities') }}/" + StateId,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    $('select[name="city_id"]').empty();
                                    $.each(data, function (key, value) {
                                        $('select[name="city_id"]').append('<option value="' +
                                            key + '">' + value + '</option>');
                                    });
                                },
                            });

                        }
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
        document.addEventListener("DOMContentLoaded", function () {
            // Get the form element
            const form = document.getElementById("create_user");

            // Get password input and confirm password input
            const passwordInput = document.getElementById("inputPassword");
            const confirmPasswordInput = document.getElementById("inputPasswordConfirm");

            // Event listener for password input change
            passwordInput.addEventListener("input", function () {
                validatePassword();
                validateConfirmPassword();
            });

            // Event listener for confirm password input change
            confirmPasswordInput.addEventListener("input", validateConfirmPassword);

            // Event listener for form submission
            form.addEventListener("submit", function (event) {
                validatePassword();
                validateConfirmPassword();

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
            });

            // Function to validate the password
            function validatePassword() {
                const isPasswordValid = passwordInput.value.length >= 8;
                passwordInput.classList.toggle("is-valid", isPasswordValid);
                passwordInput.classList.toggle("is-invalid", !isPasswordValid);
            }

            // Function to validate the confirm password
            function validateConfirmPassword() {
                const doPasswordsMatch = confirmPasswordInput.value === passwordInput.value;
                confirmPasswordInput.classList.toggle("is-valid", doPasswordsMatch);
                confirmPasswordInput.classList.toggle("is-invalid", !doPasswordsMatch);
                confirmPasswordInput.setCustomValidity(doPasswordsMatch ? "" : "Passwords do not match");
            }
        });
    </script>

            <script>
                let lookUpClicked = false; // Variable to track if the "Look Up" button has been clicked

                document.getElementById("lookUpButton").addEventListener("click", function () {
                    const latitude = document.getElementById("latitude").value;
                    const longitude = document.getElementById("longitude").value;

                    fetch(`{{ route('location') }}?latitude=${latitude}&longitude=${longitude}`)
                        .then(response => response.json())
                        .then(data => {
                            // Populate the form fields with the received data
                            if (data.error) {
                                alert(data.error);
                            } else {
                                document.getElementById("address_one").value = data.address;
                                document.getElementById("district").value = data.district;
                                document.getElementById("street").value = data.street;
                                document.getElementById("postal_code").value = data.postal_code;

                                // Check if the state option already exists, if not, append and select it
                                const stateSelect = document.getElementById("inputState");
                                let stateOption = Array.from(stateSelect.options).find(option => option.textContent === data.state);
                                if (!stateOption) {
                                    stateOption = document.createElement("option");
                                    stateOption.value = data.state;
                                    stateOption.text = data.state;
                                    stateSelect.appendChild(stateOption);
                                }
                                stateSelect.value = stateOption.value;

                                // Check if the city option already exists, if not, append and select it
                                const citySelect = document.getElementById("inputCity");
                                let cityOption = Array.from(citySelect.options).find(option => option.textContent === data.city);
                                if (!cityOption) {
                                    cityOption = document.createElement("option");
                                    cityOption.value = data.city;
                                    cityOption.text = data.city;
                                    citySelect.appendChild(cityOption);
                                }
                                citySelect.value = cityOption.value;
                            }
                            lookUpClicked = true; // Set the flag to true after the first click
                        })
                        .catch(error => {
                            console.error("Error fetching location data:", error);
                        });
                });

                // Function to check if the required fields are filled before form submission
                function validateForm() {
                    if (!lookUpClicked) {
                        alert("Please click the 'Look Up' button to populate the location data before submitting the form.");
                        return false; // Prevent form submission
                    }

                    const addressOne = document.getElementById("address_one").value;
                    const district = document.getElementById("district").value;
                    const street = document.getElementById("street").value;
                    const postalCode = document.getElementById("postal_code").value;
                    const state = document.getElementById("inputState").value;
                    const city = document.getElementById("inputCity").value;

                    if (!addressOne || !district || !street || !postalCode || !state || !city) {
                        alert("Please fill in all required fields.");
                        return false; // Prevent form submission
                    }

                    return true; // Allow form submission
                }

                // Add event listener to the form submit event
                document.getElementById("create_user").addEventListener("submit", function (event) {
                    if (!validateForm()) {
                        event.preventDefault(); // Prevent form submission if validation fails
                    }
                });
            </script>




{{--            <script>--}}
{{--                // Function to create a new address card and append it to the form--}}
{{--                function createAddressCard() {--}}
{{--                    const addressCardTemplate = document.getElementById("addressCardTemplate");--}}
{{--                    const addressCardsContainer = document.getElementById("addressCardsContainer");--}}

{{--                    const newAddressCard = addressCardTemplate.cloneNode(true);--}}
{{--                    newAddressCard.style.display = "block";--}}

{{--                    // Add click event listener to the "Remove" button in the new address card--}}
{{--                    newAddressCard.querySelector(".remove-address-btn").addEventListener("click", function () {--}}
{{--                        addressCardsContainer.removeChild(newAddressCard);--}}
{{--                    });--}}

{{--                    addressCardsContainer.appendChild(newAddressCard);--}}

{{--                    // Update IDs and labels for inputs in the new address card--}}
{{--                    const cardNumber = addressCardsContainer.childElementCount;--}}
{{--                    updateInputIdsAndLabels(newAddressCard, cardNumber);--}}
{{--                    updateSelectIdsAndLabels(newAddressCard, cardNumber);--}}

{{--                    // Add click event listener to the "Look Up" button in the new address card--}}
{{--                    newAddressCard.querySelector(".look-up-btn").addEventListener("click", function () {--}}
{{--                        const latitude = newAddressCard.querySelector(`#latitude_${cardNumber}`).value;--}}
{{--                        const longitude = newAddressCard.querySelector(`#longitude_${cardNumber}`).value;--}}

{{--                        fetch(`{{ route('location') }}?latitude=${latitude}&longitude=${longitude}`)--}}
{{--                            .then(response => response.json())--}}
{{--                            .then(data => {--}}
{{--                                // Populate the form fields with the received data--}}
{{--                                if (data.error) {--}}
{{--                                    alert(data.error);--}}
{{--                                } else {--}}
{{--                                    newAddressCard.querySelector(`#address_one_${cardNumber}`).value = data.address;--}}
{{--                                    newAddressCard.querySelector(`#district_${cardNumber}`).value = data.district;--}}
{{--                                    newAddressCard.querySelector(`#street_${cardNumber}`).value = data.street;--}}
{{--                                    newAddressCard.querySelector(`#postal_code_${cardNumber}`).value = data.postal_code;--}}

{{--                                    // Check if the state option already exists, if not, append and select it--}}
{{--                                    const stateSelect = newAddressCard.querySelector(`#inputState_${cardNumber}`);--}}
{{--                                    let stateOption = Array.from(stateSelect.options).find(option => option.textContent === data.state);--}}
{{--                                    if (!stateOption) {--}}
{{--                                        stateOption = document.createElement("option");--}}
{{--                                        stateOption.value = data.state;--}}
{{--                                        stateOption.text = data.state;--}}
{{--                                        stateSelect.appendChild(stateOption);--}}
{{--                                    }--}}
{{--                                    stateSelect.value = stateOption.value;--}}

{{--                                    // Check if the city option already exists, if not, append and select it--}}
{{--                                    const citySelect = newAddressCard.querySelector(`#inputCity_${cardNumber}`);--}}
{{--                                    let cityOption = Array.from(citySelect.options).find(option => option.textContent === data.city);--}}
{{--                                    if (!cityOption) {--}}
{{--                                        cityOption = document.createElement("option");--}}
{{--                                        cityOption.value = data.city;--}}
{{--                                        cityOption.text = data.city;--}}
{{--                                        citySelect.appendChild(cityOption);--}}
{{--                                    }--}}
{{--                                    citySelect.value = cityOption.value;--}}
{{--                                }--}}
{{--                            })--}}
{{--                            .catch(error => {--}}
{{--                                console.error("Error fetching location data:", error);--}}
{{--                            });--}}
{{--                    });--}}
{{--                }--}}

{{--                // Function to update IDs and labels for inputs in the cloned address card--}}
{{--                function updateInputIdsAndLabels(addressCard, cardNumber) {--}}
{{--                    // Map of old IDs to new IDs--}}
{{--                    const idMap = {--}}
{{--                        latitude: `latitude_${cardNumber}`,--}}
{{--                        longitude: `longitude_${cardNumber}`,--}}
{{--                        // Add other input fields here--}}
{{--                        district: `district_${cardNumber}`,--}}
{{--                        street: `street_${cardNumber}`,--}}
{{--                        address_one: `address_one_${cardNumber}`,--}}
{{--                        address_two: `address_two_${cardNumber}`,--}}
{{--                        postal_code: `postal_code_${cardNumber}`,--}}
{{--                        isDefault: `isDefault_${cardNumber}`,--}}
{{--                        address_type: `address_type_${cardNumber}`,--}}
{{--                        use_for: `use_for_${cardNumber}`,--}}
{{--                        status: `status_${cardNumber}`,--}}
{{--                    };--}}

{{--                    // Update IDs and labels for inputs in the address card--}}
{{--                    Object.keys(idMap).forEach(fieldName => {--}}
{{--                        const inputElement = addressCard.querySelector(`[name='${fieldName}']`);--}}
{{--                        const labelElement = addressCard.querySelector(`[for='${fieldName}']`);--}}
{{--                        const id = idMap[fieldName];--}}
{{--                        inputElement.id = id;--}}
{{--                        labelElement.setAttribute("for", id);--}}
{{--                    });--}}
{{--                }--}}

{{--                // Function to update IDs and labels for state and city select elements in the cloned address card--}}
{{--                function updateSelectIdsAndLabels(addressCard, cardNumber) {--}}
{{--                    // Map of old IDs to new IDs--}}
{{--                    const idMap = {--}}
{{--                        inputCountry: `inputCountry_${cardNumber}`,--}}
{{--                        inputState: `inputState_${cardNumber}`,--}}
{{--                        inputCity: `inputCity_${cardNumber}`,--}}
{{--                    };--}}

{{--                    // Update IDs and labels for select elements in the address card--}}
{{--                    Object.keys(idMap).forEach(fieldName => {--}}
{{--                        const selectElement = addressCard.querySelector(`#${fieldName}`);--}}
{{--                        const labelElement = addressCard.querySelector(`[for='${fieldName}']`);--}}
{{--                        const id = idMap[fieldName];--}}
{{--                        selectElement.id = id;--}}
{{--                        labelElement.setAttribute("for", id);--}}
{{--                    });--}}
{{--                }--}}

{{--                // Add click event listener to the "Add Address" button--}}
{{--                document.getElementById("addAddressButton").addEventListener("click", createAddressCard);--}}

{{--                // Add event listener to the form submit event--}}
{{--                document.getElementById("create_user").addEventListener("submit", function (event) {--}}
{{--                    // Process customer details (same as before)--}}

{{--                    // Process address details--}}
{{--                    const addressCards = document.querySelectorAll("#addressCardsContainer .card");--}}
{{--                    const addressesData = [];--}}

{{--                    addressCards.forEach((addressCard, index) => {--}}
{{--                        // Extract address data from the address card--}}
{{--                        const addressData = {--}}
{{--                            latitude: addressCard.querySelector(`#latitude_${index + 1}`).value,--}}
{{--                            longitude: addressCard.querySelector(`#longitude_${index + 1}`).value,--}}
{{--                            // Extract other address fields here--}}
{{--                            district: addressCard.querySelector(`#district_${index + 1}`).value,--}}
{{--                            street: addressCard.querySelector(`#street_${index + 1}`).value,--}}
{{--                            address_one: addressCard.querySelector(`#address_one_${index + 1}`).value,--}}
{{--                            address_two: addressCard.querySelector(`#address_two_${index + 1}`).value,--}}
{{--                            postal_code: addressCard.querySelector(`#postal_code_${index + 1}`).value,--}}
{{--                            isDefault: addressCard.querySelector(`#isDefault_${index + 1}`).value,--}}
{{--                            address_type: addressCard.querySelector(`#address_type_${index + 1}`).value,--}}
{{--                            use_for: addressCard.querySelector(`#use_for_${index + 1}`).value,--}}
{{--                            status: addressCard.querySelector(`#status_${index + 1}`).value,--}}
{{--                            state: addressCard.querySelector(`#inputState_${index + 1}`).value,--}}
{{--                            city: addressCard.querySelector(`#inputCity_${index + 1}`).value,--}}
{{--                        };--}}

{{--                        addressesData.push(addressData);--}}
{{--                    });--}}

{{--                    // Append the address data to the form before submission--}}
{{--                    const addressesInput = document.createElement("input");--}}
{{--                    addressesInput.type = "hidden";--}}
{{--                    addressesInput.name = "addresses";--}}
{{--                    addressesInput.value = JSON.stringify(addressesData);--}}
{{--                    this.appendChild(addressesInput);--}}
{{--                });--}}
{{--            </script>--}}
            <script>
                // Function to create a new address card and append it to the form
                function createAddressCard() {
                    const addressCardTemplate = document.getElementById("addressCardTemplate");
                    const addressCardsContainer = document.getElementById("addressCardsContainer");

                    const newAddressCard = addressCardTemplate.cloneNode(true);
                    newAddressCard.style.display = "block";

                    // Add click event listener to the "Remove" button in the new address card
                    newAddressCard.querySelector(".remove-address-btn").addEventListener("click", function () {
                        addressCardsContainer.removeChild(newAddressCard);
                    });

                    addressCardsContainer.appendChild(newAddressCard);

                    // Update IDs and labels for inputs in the new address card
                    const cardNumber = addressCardsContainer.childElementCount;
                    updateInputIdsAndLabels(newAddressCard, cardNumber);
                    updateSelectIdsAndLabels(newAddressCard, cardNumber);

                    // Add click event listener to the "Look Up" button in the new address card
                    newAddressCard.querySelector(".look-up-btn").addEventListener("click", function () {
                        const latitude = newAddressCard.querySelector(`#latitude_${cardNumber}`).value;
                        const longitude = newAddressCard.querySelector(`#longitude_${cardNumber}`).value;

                        fetch(`{{ route('location') }}?latitude=${latitude}&longitude=${longitude}`)
                            .then(response => response.json())
                            .then(data => {
                                // Populate the form fields with the received data
                                if (data.error) {
                                    alert(data.error);
                                } else {
                                    newAddressCard.querySelector(`#address_one_${cardNumber}`).value = data.address;
                                    newAddressCard.querySelector(`#district_${cardNumber}`).value = data.district;
                                    newAddressCard.querySelector(`#street_${cardNumber}`).value = data.street;
                                    newAddressCard.querySelector(`#postal_code_${cardNumber}`).value = data.postal_code;

                                    // Check if the state option already exists, if not, append and select it
                                    const stateSelect = newAddressCard.querySelector(`#inputState_${cardNumber}`);
                                    let stateOption = Array.from(stateSelect.options).find(option => option.textContent === data.state);
                                    if (!stateOption) {
                                        stateOption = document.createElement("option");
                                        stateOption.value = data.state;
                                        stateOption.text = data.state;
                                        stateSelect.appendChild(stateOption);
                                    }
                                    stateSelect.value = stateOption.value;

                                    // Check if the city option already exists, if not, append and select it
                                    const citySelect = newAddressCard.querySelector(`#inputCity_${cardNumber}`);
                                    let cityOption = Array.from(citySelect.options).find(option => option.textContent === data.city);
                                    if (!cityOption) {
                                        cityOption = document.createElement("option");
                                        cityOption.value = data.city;
                                        cityOption.text = data.city;
                                        citySelect.appendChild(cityOption);
                                    }
                                    citySelect.value = cityOption.value;
                                }
                            })
                            .catch(error => {
                                console.error("Error fetching location data:", error);
                            });
                    });
                }

                // Function to update IDs and labels for inputs in the cloned address card
                function updateInputIdsAndLabels(addressCard, cardNumber) {
                    // Map of old IDs to new IDs
                    const idMap = {
                        latitude: `latitude_${cardNumber}`,
                        longitude: `longitude_${cardNumber}`,
                        // Add other input fields here
                        district: `district_${cardNumber}`,
                        street: `street_${cardNumber}`,
                        address_one: `address_one_${cardNumber}`,
                        address_two: `address_two_${cardNumber}`,
                        postal_code: `postal_code_${cardNumber}`,
                        isDefault: `isDefault_${cardNumber}`,
                        address_type: `address_type_${cardNumber}`,
                        use_for: `use_for_${cardNumber}`,
                        status: `status_${cardNumber}`,
                    };

                    // Update IDs and labels for inputs in the address card
                    Object.keys(idMap).forEach(fieldName => {
                        const inputElement = addressCard.querySelector(`[name='${fieldName}[]']`);
                        const labelElement = addressCard.querySelector(`[for='${fieldName}']`);
                        const id = idMap[fieldName];
                        inputElement.id = id;
                        labelElement.setAttribute("for", id);
                    });
                }

                // Function to update IDs and labels for state and city select elements in the cloned address card
                function updateSelectIdsAndLabels(addressCard, cardNumber) {
                    // Map of old IDs to new IDs
                    const idMap = {
                        inputCountry: `inputCountry_${cardNumber}`,
                        inputState: `inputState_${cardNumber}`,
                        inputCity: `inputCity_${cardNumber}`,
                    };

                    // Update IDs and labels for select elements in the address card
                    Object.keys(idMap).forEach(fieldName => {
                        const selectElement = addressCard.querySelector(`#${fieldName}`);
                        const labelElement = addressCard.querySelector(`[for='${fieldName}']`);
                        const id = idMap[fieldName];
                        selectElement.id = id;
                        labelElement.setAttribute("for", id);
                    });
                }

                // Add click event listener to the "Add Address" button
                document.getElementById("addAddressButton").addEventListener("click", createAddressCard);

                // Add event listener to the form submit event
                document.getElementById("create_user").addEventListener("submit", function (event) {
                    // Process customer details (same as before)

                    // Process address details
                    const addressCards = document.querySelectorAll("#addressCardsContainer .card");
                    const addressesData = [];

                    addressCards.forEach((addressCard, index) => {
                        // Extract address data from the address card
                        const addressData = {
                            latitude: addressCard.querySelector(`#latitude_${index + 1}`).value,
                            longitude: addressCard.querySelector(`#longitude_${index + 1}`).value,
                            // Extract other address fields here
                            district: addressCard.querySelector(`#district_${index + 1}`).value,
                            street: addressCard.querySelector(`#street_${index + 1}`).value,
                            address_one: addressCard.querySelector(`#address_one_${index + 1}`).value,
                            address_two: addressCard.querySelector(`#address_two_${index + 1}`).value,
                            postal_code: addressCard.querySelector(`#postal_code_${index + 1}`).value,
                            isDefault: addressCard.querySelector(`#isDefault_${index + 1}`).value,
                            address_type: addressCard.querySelector(`#address_type_${index + 1}`).value,
                            use_for: addressCard.querySelector(`#use_for_${index + 1}`).value,
                            status: addressCard.querySelector(`#status_${index + 1}`).value,
                            state: addressCard.querySelector(`#inputState_${index + 1}`).value,
                            city: addressCard.querySelector(`#inputCity_${index + 1}`).value,
                        };

                        addressesData.push(addressData);
                    });

                    // Append the address data to the form before submission
                    const addressesInput = document.createElement("input");
                    addressesInput.type = "hidden";
                    addressesInput.name = "addresses";
                    addressesInput.value = JSON.stringify(addressesData);
                    this.appendChild(addressesInput);
                });
            </script>





@endsection

