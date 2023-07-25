@extends('layouts.master')
@section('title',__('Front-end/pages/drivers.title'))
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
            <h3><strong>{{__('Front-end/pages/drivers.title')}}</strong></h3>
        </div>
        @can('add_driver')
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{route('drivers.create')}}"
                   class="btn btn-primary">{{__('Front-end/pages/drivers.add.driver')}}</a>
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
                    <th>{{__('Front-end/pages/drivers.name')}}</th>
                    <th>{{__('Front-end/pages/drivers.email')}}</th>
                    <th>{{__('Front-end/pages/drivers.mobile')}}</th>
                    <th>{{__('Front-end/pages/drivers.state')}}</th>
                    <th>{{__('Front-end/pages/drivers.city')}}</th>
                    <th>{{__('Front-end/pages/drivers.zone')}}</th>
                    <th>{{__('Front-end/pages/drivers.status')}}</th>
                    <th>{{__('Front-end/pages/drivers.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($drivers as $driver)
                    <tr>
                        <td>
                            <img src="{{URL::asset('img/drivers/' . $driver->image ?? 'default.png')}}" width="32" height="32" class="rounded-circle my-n1" alt="{{$driver->name}}">
                        </td>

                        <td>
                            <a href="{{ route('drivers.show', $driver->id) }}">
                                {{ $driver->name }}
                            </a>
                        </td>
                        <td>{{$driver->email}}</td>
                        <td>05{{$driver->mobile_number}}</td>
                        <td>{{$driver->zone->city->state->name}}</td>
                        <td>{{$driver->zone->city->name}}</td>
                        <td>{{$driver->zone->name}}</td>
                        <td>
                            @if($driver->status)
                                <span class="badge badge-success-light">{{ __('Front-end/pages/drivers.enable') }}</span>
                            @else
                                <span class="badge badge-danger-light">{{ __('Front-end/pages/drivers.disable') }}</span>
                            @endif
                        </td>
                        <td>
                            @can('edit_driver')
                                <a href="{{route('drivers.edit',$driver->id)}}"><i class="align-middle"
                                                                                       data-feather="edit-2"></i></a>
                            @endcan
                            @can('delete_driver')
                                <a href="#" onclick="deletes({{ $driver->id }})"><i class="align-middle"
                                                                                      data-feather="trash"></i></a>
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

    <script>
        function deletes(driverId) {
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
                    deleteDriver(driverId);
                }
            })
        }

        function deleteDriver(driverId) {
            // Send an AJAX request or submit a form to the delete route
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('drivers.destroy', ['driver' => '__driverId__']) }}'.replace('__driverId__', driverId);
            form.innerHTML = `<input type="hidden" name="_method" value="DELETE">`;
            form.innerHTML = `<input type="hidden" name="id" value="${driverId}">`;
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
    @if(\Illuminate\Support\Facades\Session::has('delete-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/drivers.deleted')}}',
                '{{\Illuminate\Support\Facades\Session::get('delete-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('add-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/drivers.driver.add')}}',
                '{{\Illuminate\Support\Facades\Session::get('add-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('edit-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/drivers.driver.edit')}}',
                '{{\Illuminate\Support\Facades\Session::get('edit-success')}}',
                'success'
            )
        </script>
    @endif
@endsection
