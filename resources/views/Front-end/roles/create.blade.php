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
            <h3><strong>{{__('Front-end/pages/roles.title')}}</strong> / {{__('Front-end/pages/roles.add')}}</h3>
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
    <form action="{{route('roles.store')}}" method="post" class="needs-validation" novalidate id="myForm">
        @csrf
    <div class="row">
        <input class="form-control form-control-lg mb-3" type="text" placeholder="{{__('Front-end/pages/roles.role.name')}}" name="name" required autocomplete="">
    </div>
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
                            <input type="checkbox" id="dashboardsView"  name="permission[]" value="{{$index++}}"  >
                            <label for="dashboardsView"> {{__('Front-end/pages/roles.view')}}</label>
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
                            <input type="checkbox" id="ordersView"  name="permission[]" value="{{$index++}}"  >
                            <label for="ordersView"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="ordersAdd"  name="permission[]" value="{{$index++}}"  >
                            <label for="ordersAdd"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="ordersEdit"  name="permission[]" value="{{$index++}}"  >
                            <label for="ordersEdit"> {{__('Front-end/pages/roles.edit')}}</label>
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
                            <input type="checkbox" id="viewCustomers"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewCustomers"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addCustomers"  name="permission[]" value="{{$index++}}"  >
                            <label for="addCustomers"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editCustomers"  name="permission[]" value="{{$index++}}"  >
                            <label for="editCustomers"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteCustomers"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteCustomers"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewDrivers"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewDrivers"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addDrivers"  name="permission[]" value="{{$index++}}"  >
                            <label for="addDrivers"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editDrivers"  name="permission[]" value="{{$index++}}"  >
                            <label for="editDrivers"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteDrivers"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteDrivers"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewContact_request"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewContact_request"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addContact_request"  name="permission[]" value="{{$index++}}"  >
                            <label for="addContact_request"> {{__('Front-end/pages/roles.add')}}</label>
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
                            <input type="checkbox" id="viewReview"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewReview"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addReview"  name="permission[]" value="{{$index++}}"  >
                            <label for="addReview"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editReview"  name="permission[]" value="{{$index++}}"  >
                            <label for="editReview"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteReview"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteReview"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewCategory"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewCategory"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addCategory"  name="permission[]" value="{{$index++}}"  >
                            <label for="addCategory"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editCategory"  name="permission[]" value="{{$index++}}"  >
                            <label for="editCategory"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteCategory"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteCategory"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewProduct"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewProduct"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addProduct"  name="permission[]" value="{{$index++}}"  >
                            <label for="addProduct"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editProduct"  name="permission[]" value="{{$index++}}"  >
                            <label for="editProduct"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteProduct"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteProduct"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewAttribute"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewAttribute"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addAttribute"  name="permission[]" value="{{$index++}}"  >
                            <label for="addAttribute"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editAttribute"  name="permission[]" value="{{$index++}}"  >
                            <label for="editAttribute"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteAttribute"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteAttribute"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewReturns"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewReturns"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addReturns"  name="permission[]" value="{{$index++}}"  >
                            <label for="addReturns"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editReturns"  name="permission[]" value="{{$index++}}"  >
                            <label for="editReturns"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteReturns"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteReturns"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewComment"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewComment"> {{__('Front-end/pages/roles.view')}}</label>
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
                            <input type="checkbox" id="viewAdvertisement"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewAdvertisement"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addAdvertisement"  name="permission[]" value="{{$index++}}"  >
                            <label for="addAdvertisement"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editAdvertisement"  name="permission[]" value="{{$index++}}"  >
                            <label for="editAdvertisement"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteAdvertisement"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteAdvertisement"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewMarketing"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewMarketing"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addMarketing"  name="permission[]" value="{{$index++}}"  >
                            <label for="addMarketing"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editMarketing"  name="permission[]" value="{{$index++}}"  >
                            <label for="editMarketing"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteMarketing"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteMarketing"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewCoupons"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewCoupons"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addCoupons"  name="permission[]" value="{{$index++}}"  >
                            <label for="addCoupons"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editCoupons"  name="permission[]" value="{{$index++}}"  >
                            <label for="editCoupons"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteCoupons"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteCoupons"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewUnits"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewUnits"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addUnits"  name="permission[]" value="{{$index++}}"  >
                            <label for="addUnits"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editUnits"  name="permission[]" value="{{$index++}}"  >
                            <label for="editUnits"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteUnits"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteUnits"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewStores"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewStores"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addStores"  name="permission[]" value="{{$index++}}"  >
                            <label for="addStores"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editStores"  name="permission[]" value="{{$index++}}"  >
                            <label for="editStores"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteStores"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteStores"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewSetting"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewSetting"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addSetting"  name="permission[]" value="{{$index++}}"  >
                            <label for="addSetting"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editSetting"  name="permission[]" value="{{$index++}}"  >
                            <label for="editSetting"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteSetting"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteSetting"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewTimeslot"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewTimeslot"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addTimeslot"  name="permission[]" value="{{$index++}}"  >
                            <label for="addTimeslot"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editTimeslot"  name="permission[]" value="{{$index++}}"  >
                            <label for="editTimeslot"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteTimeslot"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteTimeslot"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewUsers"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewUsers"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addUsers"  name="permission[]" value="{{$index++}}"  >
                            <label for="addUsers"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editUsers"  name="permission[]" value="{{$index++}}"  >
                            <label for="editUsers"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteUsers"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteUsers"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewRoles"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewRoles"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addRoles"  name="permission[]" value="{{$index++}}"  >
                            <label for="addRoles"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editRoles"  name="permission[]" value="{{$index++}}"  >
                            <label for="editRoles"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteRoles"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteRoles"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewZones"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewZones"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addZones"  name="permission[]" value="{{$index++}}"  >
                            <label for="addZones"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editZones"  name="permission[]" value="{{$index++}}"  >
                            <label for="editZones"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteZones"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteZones"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewLogs"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewLogs"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addLogs"  name="permission[]" value="{{$index++}}"  >
                            <label for="addLogs"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editLogs"  name="permission[]" value="{{$index++}}"  >
                            <label for="editLogs"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteLogs"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteLogs"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewRewards"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewRewards"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addRewards"  name="permission[]" value="{{$index++}}"  >
                            <label for="addRewards"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editRewards"  name="permission[]" value="{{$index++}}"  >
                            <label for="editRewards"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteRewards"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteRewards"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewCms_pages"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewCms_pages"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addCms_pages"  name="permission[]" value="{{$index++}}"  >
                            <label for="addCms_pages"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editCms_pages"  name="permission[]" value="{{$index++}}"  >
                            <label for="editCms_pages"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteCms_pages"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteCms_pages"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewHolidays"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewHolidays"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addHolidays"  name="permission[]" value="{{$index++}}"  >
                            <label for="addHolidays"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editHolidays"  name="permission[]" value="{{$index++}}"  >
                            <label for="editHolidays"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deleteHolidays"  name="permission[]" value="{{$index++}}"  >
                            <label for="deleteHolidays"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewChats"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewChats"> {{__('Front-end/pages/roles.view')}}</label>
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
                            <input type="checkbox" id="viewOrder_status"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewOrder_status"> {{__('Front-end/pages/roles.view')}}</label>
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
                            <input type="checkbox" id="viewPre_sales_customer"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewPre_sales_customer"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="addPre_sales_customer"  name="permission[]" value="{{$index++}}"  >
                            <label for="addPre_sales_customer"> {{__('Front-end/pages/roles.add')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="editPre_sales_customer"  name="permission[]" value="{{$index++}}"  >
                            <label for="editPre_sales_customer"> {{__('Front-end/pages/roles.edit')}}</label>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox" id="deletePre_sales_customer"  name="permission[]" value="{{$index++}}"  >
                            <label for="deletePre_sales_customer"> {{__('Front-end/pages/roles.delete')}}</label>
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
                            <input type="checkbox" id="viewPayment_services"  name="permission[]" value="{{$index++}}"  >
                            <label for="viewPayment_services"> {{__('Front-end/pages/roles.view')}}</label>
                        </li>
                        <li class="list-group-item">-</li>
                        <li class="list-group-item">-</li>
                        <li class="list-group-item">-</li>
                    </ul>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{__('Front-end/pages/roles.add')}}</button>
    </form>
    @section('scripts')
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
    @endsection
@endsection
