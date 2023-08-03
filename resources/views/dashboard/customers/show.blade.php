@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/customers.customer.details'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3>
                <strong>{{__('Front-end/pages/customers.customers')}}</strong> / {{__('Front-end/pages/customers.customer.details')}}
            </h3>
        </div>
    </div>
@endsection
@section('content')
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{__('Front-end/pages/customers.customer.info')}}</h5>
                </div>
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="inputUsername">{{__('Front-end/pages/users.name')}}</label>
                                    <input type="text" class="form-control" id="inputUsername" placeholder="{{__('Front-end/pages/users.name')}}" value="{{$customer->name}}" disabled>
                                </div>                                                <div class="mb-3">
                                    <label class="form-label" for="inputUsername">{{__('Front-end/pages/users.email')}}</label>
                                    <input type="text" class="form-control" id="inputUsername" value="{{$customer->email}}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" >{{__('Front-end/pages/customers.mobile_number')}}</label>
                                    <input type="text" class="form-control" value="{{$customer->mobile_number}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <img alt="{{"$customer->name"}}" src="{{URL::asset('img/customers/' . $customer->image)}}" class="rounded-circle img-responsive mt-2"
                                         width="128" height="128" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @foreach($customer->addresses as $index => $address)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{__('Front-end/pages/customers.customer.address') . " " . ++$index}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label"
                                       for="latitude">{{__('Front-end/pages/customers.latitude')}}</label>
                                <input type="text" class="form-control" id="latitude"
                                       placeholder="{{__('Front-end/pages/customers.latitude')}}" autocomplete="off" required value="{{$address->latitude}}" disabled
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                >
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="longitude">{{__('Front-end/pages/customers.longitude')}}</label>
                                <input type="text" class="form-control" id="longitude" name="longitude[]"
                                       autocomplete="off" required value="{{$address->longitude}}" disabled
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                >
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
                                    <option selected value="{{$address->city->state->id}}">{{__('Front-end/states.' . $address->city->state->name)}}</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="inputCity">{{__('Front-end/pages/users.city')}}</label>
                                <select id="inputCity" name="city[]" class="form-control choices-single" required disabled>
                                    <option selected disabled value="{{$address->city->id}}">{{$address->city->name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="district">{{__('Front-end/pages/customers.district')}}</label>
                                <input type="text" class="form-control" name="district[]" id="district" value="{{$address->district}}"
                                        required disabled minlength="1">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="street" class="form-label">{{__('Front-end/pages/customers.street')}}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="street" value="{{$address->street}}"
                                           name="street[]" autocomplete="off"
                                           placeholder="{{__('Front-end/pages/customers.street')}}" required disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label"
                                       for="address_one">{{__('Front-end/pages/customers.address_one')}}</label>
                                <input type="text" class="form-control" id="address_one" name="address_one[]" value="{{$address->address_one}}"
                                       placeholder="{{__('Front-end/pages/customers.address_one')}}" autocomplete="off" required disabled>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="address_two">{{__('Front-end/pages/customers.address_two')}}</label>
                                <input type="text" class="form-control" id="address_two" name="address_two[]" value="{{$address->address_two}}" disabled
                                       placeholder="{{__('Front-end/pages/customers.address_two')}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label"
                                       for="postal_code">{{__('Front-end/pages/customers.postal_code')}}</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code[]" value="{{$address->postal_code}}"
                                       placeholder="{{__('Front-end/pages/customers.postal_code')}}" autocomplete="off" required disabled>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="isDefault">{{__('Front-end/pages/customers.isDefault')}}</label>
                                <select name="isDefault[]" id="isDefault" class="form-control choices-single" required disabled>
                                    <option value="1" {{$address->isDefault ? 'selected' : ''}}>{{__('Front-end/pages/customers.true')}}</option>
                                    <option value="0" {{!$address->isDefault ? 'selected' : ''}}>{{__('Front-end/pages/customers.false')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="address_type">{{__('Front-end/pages/customers.address_type')}}</label>
                                <select id="address_type" class="form-control choices-single" required disabled>
                                    <option value="{{$address->addressType->id}}" selected>{{__('Front-end/pages/customers.' .  $address->addressType->name)}}</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="use_for">{{__('Front-end/pages/customers.use_for')}}</label>
                                <select name="use_for[]" id="use_for" class="form-control choices-single" required disabled>
                                    <option value="{{$address->use_for}}" >{{__('Front-end/pages/customers.' . $address->use_for)}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="status">{{__('Front-end/pages/customers.status')}}</label>
                                <select name="status[]" id="status" class="form-control choices-single" required disabled>
                                    <option value="1" {{$address->status ? 'selected' : ''}}>{{__('Front-end/pages/customers.true')}}</option>
                                    <option value="0" {{!$address->status ? 'selected' : ''}}>{{__('Front-end/pages/customers.false')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection

