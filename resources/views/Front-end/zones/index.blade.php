@extends('layouts.master')
@section('title',__('Front-end/pages/zones.title'))
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
            <h3><strong>{{__('Front-end/pages/zones.location.management')}}</strong> /  {{__('Front-end/pages/zones.title')}}</h3>
        </div>
                @can('add_zone')
        <div class="col-auto ms-auto text-end mt-n1">
            <a href="{{route('zones.create')}}" class="btn btn-primary">{{__('Front-end/pages/zones.add.zone')}}</a>
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
                    <th>{{__('Front-end/pages/zones.name')}}</th>
                    <th>{{__('Front-end/pages/zones.state')}}</th>
                    <th>{{__('Front-end/pages/zones.city')}}</th>
                    <th>{{__('Front-end/pages/zones.store')}}</th>
                    <th>{{__('Front-end/pages/zones.status')}}</th>
                    <th>{{__('Front-end/pages/zones.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($zones as $zone)
                    <tr>
                        <td>{{$rowNumber++}}</td>

                        <td>
                                {{ $zone->name }}
                        </td>
                        <td>{{$zone->city->state->name}}</td>
                        <td>{{$zone->city->name}}</td>
                        <td>{{$zone->store->name}}</td>
                        <td>
                            @if($zone->status)
                                <span class="badge badge-success-light">{{ __('Front-end/pages/zones.enable') }}</span>
                            @else
                                <span class="badge badge-danger-light">{{ __('Front-end/pages/zones.disable') }}</span>
                            @endif
                        </td>

                        <td>
                                @can('edit_zone')
                                    <a href="{{route('zones.edit',$zone->id)}}"><i class="align-middle"
                                                                                   data-feather="edit-2"></i></a>
                                @endcan
                                @can('delete_zone')
                                    <a href="#" onclick="deletes({{ $zone->id }})"><i class="align-middle"
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
    <script>
        function deletes(zoneId) {
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
                    deleteUser(zoneId);
                }
            })
        }

        function deleteUser(zoneId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('zones.destroy', ['zone' => '__zoneId__']) }}'.replace('__zoneId__', zoneId);
            form.innerHTML = `<input type="hidden" name="_method" value="DELETE">`;
            form.innerHTML = `<input type="hidden" name="id" value="${zoneId}">`;
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
    @if(\Illuminate\Support\Facades\Session::has('edit-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/zones.edited')}}',
                '{{\Illuminate\Support\Facades\Session::get('edit-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('add-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/zones.zone.add')}}',
                '{{\Illuminate\Support\Facades\Session::get('add-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('delete-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/zones.deleted')}}',
                '{{\Illuminate\Support\Facades\Session::get('delete-success')}}',
                'success'
            )
        </script>
    @endif
@endsection
