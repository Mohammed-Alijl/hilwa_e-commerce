@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/users.user.show.title'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{__('Front-end/pages/users.users')}}</strong> / {{__('Front-end/pages/users.account.details')}}</h3>
        </div>
    </div>
@endsection
@section('content')
    <main class="content">
            <div class="row">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="account" role="tabpanel">

                            <div class="card">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">{{__('Front-end/pages/users.user.info')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label class="form-label" for="inputUsername">{{__('Front-end/pages/users.name')}}</label>
                                                    <input type="text" class="form-control" id="inputUsername" placeholder="{{__('Front-end/pages/users.name')}}" value="{{$user->first_name . " " . $user->last_name}}" disabled>
                                                </div>                                                <div class="mb-3">
                                                    <label class="form-label" for="inputUsername">{{__('Front-end/pages/users.email')}}</label>
                                                    <input type="text" class="form-control" id="inputUsername" placeholder="{{__('Front-end/pages/users.email')}}" value="{{$user->email}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center">
                                                    <img alt="{{"$user->first_name $user->last_name"}}" src="{{URL::asset('img/admins/' . $user->image)}}" class="rounded-circle img-responsive mt-2"
                                                         width="128" height="128" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">{{__('Front-end/pages/users.user.all.details')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputFirstName">{{__('Front-end/pages/users.code')}}</label>
                                                <input type="text" class="form-control" id="inputFirstName" value="{{$user->code}}" disabled>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputLastName">{{__('Front-end/pages/users.mobile')}}</label>
                                                <input type="text" class="form-control" id="inputLastName" value="{{$user->mobile_number}}" disabled>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputEmail4">{{__('Front-end/pages/users.role')}}</label>
                                            <input type="email" class="form-control" id="inputEmail4" value="{{$user->roles->pluck('name','name')->first()}}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputAddress">{{__('Front-end/pages/users.address')}}</label>
                                            <input type="text" class="form-control" id="inputAddress" value="{{$user->address}}" disabled>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="inputState">{{__('Front-end/pages/users.country')}}</label>
                                                <select id="inputState" class="form-control" disabled>
                                                    <option selected>{{__('Front-end/country.' . $user->city->state->country->name)}}</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="inputState">{{__('Front-end/pages/users.state')}}</label>
                                                <select id="inputState" class="form-control" disabled>
                                                    <option selected>{{__('Front-end/states.' . $user->city->state->name)}}</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="inputState">{{__('Front-end/pages/users.state')}}</label>
                                                <select id="inputState" class="form-control" disabled>
                                                    <option selected>{{$user->city->name}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </main>
@endsection
