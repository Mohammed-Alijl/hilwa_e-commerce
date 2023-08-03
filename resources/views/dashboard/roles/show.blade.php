@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/roles.title'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
                <h3><strong>{{__('Front-end/pages/roles.title')}}</strong> / {{__('Front-end/pages/roles.show')}}</h3>
        </div>
    </div>
@endsection
@section('content')
    @foreach($models as $index => $model)
        @php
            $isViewModel = ($model == 'dashboard' || $model == 'comment' || $model =='chat' || $model == 'order-status' || $model == 'payment-services');
            $isContactRequestModel = ($model == 'contact-request');
            $noDeleteModel = ($model == 'order' || $model == 'city');
        @endphp

        @if($index % 4 === 0)
            <div class="row">
                @endif
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-header" style="background: #21beb5">
                            <h5 class="card-title mb-0"
                                style="color: white">{{__('Front-end/pages/roles.' . $model)}}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($methods as $method)
                                @if($isViewModel && $method != 'view')
                                    <li class="list-group-item">-</li>
                                    <li class="list-group-item">-</li>
                                    <li class="list-group-item">-</li>
                                    @break
                                @elseif($isContactRequestModel && ($method == 'edit' || $method == 'delete'))
                                    <li class="list-group-item">-</li>
                                    <li class="list-group-item">-</li>
                                    @break
                                @elseif($noDeleteModel && $method == 'delete')
                                    <li class="list-group-item">-</li>
                                    @break
                                @endif
                                <li class="list-group-item">
                                    <input type="checkbox" id="{{ $model . $method }}" name="permission[]"
                                            {{ in_array($method . '_' . $model , $rolePermissions) ? 'checked': '' }} disabled>
                                    <label
                                        for="{{ $model . $method }}"> {{__("Front-end/pages/roles.$method")}}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @if($index % 4 === 3 || $index === count($models) - 1)
            </div>
        @endif
    @endforeach

@endsection
