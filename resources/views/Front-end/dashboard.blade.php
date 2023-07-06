@extends('layouts.master')
@section('title','Dashboard')
@section('css')
    <link class="js-stylesheet" href="{{URL::asset('css/light.css')}}" rel="stylesheet">
    @endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Analytics</strong> Dashboard</h3>
        </div>
    </div>
@endsection
