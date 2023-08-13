@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/categories.title'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{__('Front-end/pages/categories.title')}}</strong></h3>
        </div>
        @can('add_category')
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{route('categories.child.create',$id)}}" class="btn btn-primary">{{__('Front-end/pages/categories.add.category')}}</a>
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
                    <th>{{__('Front-end/pages/categories.name')}}</th>
                    <th>{{__('Front-end/pages/categories.display_order')}}</th>
                    <th>{{__('Front-end/pages/categories.status')}}</th>
                    <th>{{__('Front-end/pages/categories.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>
                            <img src="{{URL::asset('img/categories/' . $category->image)}}" width="32" height="32" class="rounded-circle my-n1" alt="{{$category->name}}">
                        </td>
                        <td>
                            <a href="{{route('categories.show',$category->id)}}">
                            {{$category->translations->first()->name}}
                            </a>
                        </td>
                        <td>{{$category->display_order}}</td>
                        <td>
                            @if($category->status)
                                <span class="badge badge-success-light">{{ __('Front-end/pages/categories.enable') }}</span>
                            @else
                                <span class="badge badge-danger-light">{{ __('Front-end/pages/categories.disable') }}</span>
                            @endif
                        </td>

                        <td>
                            @can('edit_category')
                                <a href="{{route('categories.edit',$category->id)}}"><i class="align-middle"
                                                                                 data-feather="edit-2"></i></a>
                            @endcan
                            @can('delete_category')
                                <a href="#" onclick="deletes({{ $category->id }})"><i class="align-middle"
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
        function deletes(categoryId) {
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
                    deleteUser(categoryId);
                }
            })
        }

        function deleteUser(categoryId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('categories.destroy', ['category' => '__categoryId__']) }}'.replace('__categoryId__', categoryId);
            form.innerHTML = `<input type="hidden" name="_method" value="DELETE">`;
            form.innerHTML = `<input type="hidden" name="id" value="${categoryId}">`;
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
                '{{__('Front-end/pages/categories.edited')}}',
                '{{\Illuminate\Support\Facades\Session::get('edit-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('add-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/categories.category.add')}}',
                '{{\Illuminate\Support\Facades\Session::get('add-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('delete-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/categories.deleted')}}',
                '{{\Illuminate\Support\Facades\Session::get('delete-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('delete-failed'))
        <script>
            Swal.fire({
                title: '{{__('Front-end/pages/categories.can.not.delete')}}',
                text: '{{\Illuminate\Support\Facades\Session::get('delete-failed')}}',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: '{{__('Front-end/pages/stores.ok')}}'
            })
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
