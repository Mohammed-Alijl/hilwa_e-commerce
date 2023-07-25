@extends('layouts.master')
@section('title',__('Front-end/pages/drivers.title'))
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
            <h3><strong>{{__('Front-end/pages/drivers.title')}}</strong> / {{__('Front-end/pages/drivers.account.details')}}</h3>
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

                            <h5 class="card-title mb-0">{{__('Front-end/pages/drivers.driver.info')}}</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">{{__('Front-end/pages/users.name')}}</label>
                                            <input type="text" class="form-control" id="inputUsername" placeholder="{{__('Front-end/pages/users.name')}}" value="{{$driver->name}}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">{{__('Front-end/pages/users.email')}}</label>
                                            <input type="text" class="form-control" id="inputUsername" placeholder="{{__('Front-end/pages/users.email')}}" value="{{$driver->email}}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">{{__('Front-end/pages/drivers.mobile_number')}}</label>
                                            <input type="text" class="form-control" id="inputUsername" value="{{$driver->mobile_number}}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">{{__('Front-end/pages/users.state')}}</label>
                                            <input type="text" class="form-control" id="inputUsername" value="{{$driver->zone->city->state->name}}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">{{__('Front-end/pages/users.city')}}</label>
                                            <input type="text" class="form-control" id="inputUsername" value="{{$driver->zone->city->name}}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">{{__('Front-end/pages/drivers.zone')}}</label>
                                            <input type="text" class="form-control" id="inputUsername" value="{{$driver->zone->name}}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">{{__('Front-end/pages/drivers.status')}}</label>
                                            <input type="text" class="form-control" id="inputUsername" value="{{$driver->status ? __('Front-end/pages/drivers.enable') : __('Front-end/page/drivers.disable')}}" disabled>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <img alt="{{$driver->name}}" src="{{URL::asset('img/drivers/' . $driver->image)}}" class="rounded-circle img-responsive mt-2"
                                                 width="128" height="128" />
                                        </div>
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
