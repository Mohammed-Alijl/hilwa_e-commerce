@extends('layouts.master')
@section('title',__('Front-end/pages/timeslots.title'))
@section('css')
    @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
        <link class="js-stylesheet" href="{{URL::asset('css/app.rtl.css')}}" rel="stylesheet">
    @else
        <link class="js-stylesheet" href="{{URL::asset('css/light.css')}}" rel="stylesheet">
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{__('Front-end/pages/timeslots.definitions')}}</strong> / {{__('Front-end/pages/timeslots.title')}}</h3>
        </div>
        @can('add_timeslot')
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{route('timeslots.create')}}" class="btn btn-primary">{{__('Front-end/pages/timeslots.add.timeslot')}}</a>
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
                    <th>{{__('Front-end/pages/timeslots.day')}}</th>
                    <th>{{__('Front-end/pages/timeslots.title')}}</th>
                    <th>{{__('Front-end/pages/timeslots.delivery_available')}}</th>
                    <th>{{__('Front-end/pages/timeslots.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($days as $day)
                    <tr>
                        <td>{{$rowNumber++}}</td>

                        <td>{{$day->name}}</td>
                        <td>
                            @foreach($day->timeslots as $timeslot)
                                <span class="btn btn-warning btn-sm">
                                    {{\Carbon\Carbon::createFromFormat('H:i:s',$timeslot->start_time)->format('h:i A')}} - {{\Carbon\Carbon::createFromFormat('H:i:s',$timeslot->end_time)->format('h:i A')}} ({{$timeslot->total_order}})
                                </span>
                            @endforeach
                        </td>
                        <td>
                            @if($day->delivery_available)
                                <span class="badge badge-success-light">{{ __('Front-end/pages/timeslots.enable') }}</span>
                            @else
                                <span class="badge badge-danger-light">{{ __('Front-end/pages/timeslots.disable') }}</span>
                            @endif
                        </td>
                        <td>
                                @can('edit_timeslot')
                                    <a href="{{route('timeslots.edit',$day->id)}}"><i class="align-middle"
                                                                                   data-feather="edit-2"></i></a>
                                @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
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
    @if(\Illuminate\Support\Facades\Session::has('add-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/timeslots.timeslot.add')}}',
                '{{\Illuminate\Support\Facades\Session::get('add-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('edit-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/timeslots.timeslot.edit')}}',
                '{{\Illuminate\Support\Facades\Session::get('edit-success')}}',
                'success'
            )
        </script>
    @endif
@endsection
