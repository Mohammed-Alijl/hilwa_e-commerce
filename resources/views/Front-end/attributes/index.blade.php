@extends('layouts.master')
@section('title',__('Front-end/pages/attributes.title'))
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
            <h3>{{__('Front-end/pages/attributes.title')}}</h3>
        </div>
        @can('add_attribute')
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{route('attributes.create')}}" class="btn btn-primary">{{__('Front-end/pages/attributes.add.attribute')}}</a>
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
                    <th>{{__('Front-end/pages/attributes.name')}}</th>
                    <th>{{__('Front-end/pages/attributes.is.boolean')}}</th>
                    <th>{{__('Front-end/pages/attributes.entity')}}</th>
                    <th>{{__('Front-end/pages/attributes.display_order')}}</th>
                    <th>{{__('Front-end/pages/attributes.status')}}</th>
                    <th>{{__('Front-end/pages/attributes.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($attributes as $attribute)
                    <tr>
                        <td>{{$rowNumber++}}</td>
                        <td>{{$attribute->translations->first()->name}}</td>
                        <td>
                            @if($attribute->isBoolean)
                                {{ __('Front-end/pages/attributes.yes') }}
                            @else
                                {{ __('Front-end/pages/attributes.no') }}
                            @endif
                        </td>
                        <td>{{$attribute->entity->name}}</td>
                        <td>{{$attribute->display_order}}</td>
                        <td>
                            @if($attribute->status)
                                <span class="badge badge-success-light">{{ __('Front-end/pages/attributes.enable') }}</span>
                            @else
                                <span class="badge badge-danger-light">{{ __('Front-end/pages/attributes.disable') }}</span>
                            @endif
                        </td>

                        <td>
                            @can('edit_attribute')
                                <a href="{{route('stores.edit',$attribute->id)}}"><i class="align-middle"
                                                                                 data-feather="edit-2"></i></a>
                            @endcan
                            @can('delete_attribute')
                                <a href="#" onclick="deletes({{ $attribute->id }})"><i class="align-middle"
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
                '{{__('Front-end/pages/attributes.edited')}}',
                '{{\Illuminate\Support\Facades\Session::get('edit-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('add-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/attributes.attribute.add')}}',
                '{{\Illuminate\Support\Facades\Session::get('add-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('delete-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/attributes.deleted')}}',
                '{{\Illuminate\Support\Facades\Session::get('delete-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('delete-failed'))
        <script>
            Swal.fire({
                title: '{{__('Front-end/pages/attributes.can.not.delete')}}',
                text: '{{\Illuminate\Support\Facades\Session::get('delete-failed')}}',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: '{{__('Front-end/pages/attributes.ok')}}'
            })
        </script>
    @endif
@endsection
