@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/stores.title'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{__('Front-end/pages/stores.definitions')}}</strong> /  {{__('Front-end/pages/stores.title')}}</h3>
        </div>
        @can('add_store')
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{route('stores.create')}}" class="btn btn-primary">{{__('Front-end/pages/stores.add.store')}}</a>
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
                    <th>{{__('Front-end/pages/stores.name')}}</th>
                    <th>{{__('Front-end/pages/stores.email')}}</th>
                    <th>{{__('Front-end/pages/stores.mobile_number')}}</th>
                    <th>{{__('Front-end/pages/stores.city')}}</th>
                    <th>{{__('Front-end/pages/stores.postal_code')}}</th>
                    <th>{{__('Front-end/pages/stores.open-closed.time')}}</th>
                    <th>{{__('Front-end/pages/stores.status')}}</th>
                    <th>{{__('Front-end/pages/stores.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stores as $store)
                    <tr>
                        <td>{{$rowNumber++}}</td>
                        <td>{{$store->translations->first()->name}}</td>
                        <td>{{$store->email}}</td>
                        <td>{{$store->mobile_number}}</td>
                        <td>{{$store->city->name}}</td>
                        <td>{{$store->zip_code}}</td>
                        <td>{{\Carbon\Carbon::createFromFormat('H:i:s',$store->open_time)->format('h:i A')}} - {{\Carbon\Carbon::createFromFormat('H:i:s',$store->close_time)->format('h:i A')}}</td>
                        <td>
                            @if($store->status)
                                <span class="badge badge-success-light">{{ __('Front-end/pages/stores.enable') }}</span>
                            @else
                                <span class="badge badge-danger-light">{{ __('Front-end/pages/stores.disable') }}</span>
                            @endif
                        </td>

                        <td>
                            @can('edit_store')
                                <a href="{{route('stores.edit',$store->id)}}"><i class="align-middle"
                                                                               data-feather="edit-2"></i></a>
                            @endcan
                            @can('delete_store')
                                <a href="#" onclick="deletes({{ $store->id }})"><i class="align-middle"
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
        function deletes(storeId) {
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
                    deleteUser(storeId);
                }
            })
        }

        function deleteUser(storeId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('stores.destroy', ['store' => '__storeId__']) }}'.replace('__storeId__', storeId);
            form.innerHTML = `<input type="hidden" name="_method" value="DELETE">`;
            form.innerHTML = `<input type="hidden" name="id" value="${storeId}">`;
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
                '{{__('Front-end/pages/stores.edited')}}',
                '{{\Illuminate\Support\Facades\Session::get('edit-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('add-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/stores.store.add')}}',
                '{{\Illuminate\Support\Facades\Session::get('add-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('delete-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/stores.deleted')}}',
                '{{\Illuminate\Support\Facades\Session::get('delete-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('delete-failed'))
        <script>
            Swal.fire({
                title: '{{__('Front-end/pages/stores.can.not.delete')}}',
                text: '{{\Illuminate\Support\Facades\Session::get('delete-failed')}}',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: '{{__('Front-end/pages/stores.ok')}}'
            })
        </script>
    @endif
@endsection
