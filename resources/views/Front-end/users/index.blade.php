@extends('layouts.master')
@section('title',__('Front-end/pages/users.title'))
@section('css')
    <link class="js-stylesheet" href="{{URL::asset('css/light.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{__('Front-end/pages/users.definitions')}}</strong> {{__('Front-end/pages/users.users')}}</h3>
        </div>
        @can('users.add')
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{route('users.create')}}" class="btn btn-primary">{{__('Front-end/pages/users.add.user')}}</a>
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
                    <th>{{__('Front-end/pages/users.name')}}</th>
                    <th>{{__('Front-end/pages/users.email')}}</th>
                    <th>{{__('Front-end/pages/users.mobile')}}</th>
                    <th>{{__('Front-end/pages/users.state')}}</th>
                    <th>{{__('Front-end/pages/users.city')}}</th>
                    <th>{{__('Front-end/pages/users.role')}}</th>
                    <th>{{__('Front-end/pages/users.code')}}</th>
                    <th>{{__('Front-end/pages/users.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$rowNumber++}}</td>
                        <td>{{$user->first_name . ' ' .$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>05{{$user->mobile_number}}</td>
                        <td>{{$user->city->state->name}}</td>
                        <td>{{$user->city->name}}</td>
                        <td>{{$user->roles->pluck('name','name')->first()}}</td>
                        <td>{{$user->code}}</td>
                        <td>
                            @can('users.edit')
                                <a href="{{route('users.edit',$user->id)}}"><i class="align-middle"
                                                                               data-feather="edit-2"></i></a>
                            @endcan
                            @can('users.delete')
                                <a href="#" onclick="deletes({{ $user->id }})"><i class="align-middle"
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
        function deletes(userId) {
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
                    deleteUser(userId);
                }
            })
        }

        function deleteUser(userId) {
            // Send an AJAX request or submit a form to the delete route
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('users.destroy', ['user' => '__userId__']) }}'.replace('__userId__', userId);
            form.innerHTML = `<input type="hidden" name="_method" value="DELETE">`;
            form.innerHTML = `<input type="hidden" name="id" value="${userId}">`;
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
    @if(\Illuminate\Support\Facades\Session::has('success-message'))
        <script>
            Swal.fire(
                '{{__('deleted')}}',
                '{{\Illuminate\Support\Facades\Session::get('success-message')}}',
                'success'
            )
        </script>
    @endif
@endsection
