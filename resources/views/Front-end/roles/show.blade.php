@extends('layouts.master')
@section('title',__('Front-end/pages/roles.title'))
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
                <h3><strong>{{__('Front-end/pages/roles.title')}}</strong> / {{__('Front-end/pages/roles.show')}}</h3>
        </div>
    </div>
@endsection
@section('content')
    @php
    $index = 1;
    @endphp
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.dashboards')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">-</li>
                    <li class="list-group-item">-</li>
                    <li class="list-group-item">-</li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.orders')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        -
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.customers')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.drivers')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.contact_request')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">-</li>
                    <li class="list-group-item">-</li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.review')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.category')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.product')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.attribute')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.returns')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.comment')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        -
                    </li>
                    <li class="list-group-item">
                        -
                    </li>
                    <li class="list-group-item">
                        -
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.advertisement')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.marketing')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.coupons')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.units')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.stores')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.setting')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.timeslot')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.users')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.roles')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.zones')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.logs')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.rewards')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.cms_pages')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.holidays')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.chats')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        -
                    </li>
                    <li class="list-group-item">
                        -
                    </li>
                    <li class="list-group-item">
                        -
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.order_status')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        -
                    </li>
                    <li class="list-group-item">
                        -
                    </li>
                    <li class="list-group-item">
                        -
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.pre_sales_customer')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="add" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="add"> {{__('Front-end/pages/roles.add')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.edit')}}</label>
                    </li>
                    <li class="list-group-item">
                        <input type="checkbox" id="edit" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="edit"> {{__('Front-end/pages/roles.delete')}}</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-header" style="background: #1cbb8c">
                    <h5 class="card-title mb-0" style="color: white">{{__('Front-end/pages/roles.payment_services')}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <input type="checkbox" id="view" name="checkbox" value="" {{ in_array($index++ , $rolePermissions) ? 'checked': '' }} disabled>
                        <label for="view"> {{__('Front-end/pages/roles.view')}}</label>
                    </li>
                    <li class="list-group-item">-</li>
                    <li class="list-group-item">-</li>
                    <li class="list-group-item">-</li>
                </ul>
            </div>
        </div>
    </div>

@endsection
