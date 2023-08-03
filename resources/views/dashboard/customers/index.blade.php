@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/customers.title'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{__('Front-end/pages/customers.title')}}</strong></h3>
        </div>
        @can('add_customer')
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{route('customers.create')}}"
                   class="btn btn-primary">{{__('Front-end/pages/customers.add.customer')}}</a>
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
                    <th>{{__('Front-end/pages/customers.name')}}</th>
                    <th>{{__('Front-end/pages/customers.email')}}</th>
                    <th>{{__('Front-end/pages/customers.mobile')}}</th>
                    <th>{{__('Front-end/pages/customers.state')}}</th>
                    <th>{{__('Front-end/pages/customers.city')}}</th>
                    <th>{{__('Front-end/pages/customers.postal_code')}}</th>
                    <th>{{__('Front-end/pages/users.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{$rowNumber++}}</td>

                        <td>
                            <a href="{{ route('customers.show', $customer->id) }}">
                                {{ $customer->name }}
                            </a>
                        </td>
                        <td>{{$customer->email}}</td>
                        <td>05{{$customer->mobile_number}}</td>
                        <td>{{$customer->addresses->where('isDefault',1)->isNotEmpty() ? $customer->addresses->where('isDefault',1)->first()->city->state->name : $customer->addresses->first()->city->state->name}}</td>
                        <td>{{$customer->addresses->where('isDefault',1)->isNotEmpty() ? $customer->addresses->where('isDefault',1)->first()->city->name : $customer->addresses->first()->city->name}}</td>
                        <td>{{$customer->addresses->where('isDefault',1)->isNotEmpty() ? $customer->addresses->where('isDefault',1)->first()->postal_code : $customer->addresses->first()->postal_code}}</td>
                        <td>
                            @can('edit_customer')
                                <a href="{{route('customers.edit',$customer->id)}}"><i class="align-middle"
                                                                                       data-feather="edit-2"></i></a>
                            @endcan
                            @can('delete_customer')
                                <a href="#" onclick="deletes({{ $customer->id }})"><i class="align-middle"
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
        function deletes(customerId) {
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
                    deleteCustomer(customerId);
                }
            })
        }

        function deleteCustomer(customerId) {
            // Send an AJAX request or submit a form to the delete route
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('customers.destroy', ['customer' => '__customerId__']) }}'.replace('__customerId__', customerId);
            form.innerHTML = `<input type="hidden" name="_method" value="DELETE">`;
            form.innerHTML = `<input type="hidden" name="id" value="${customerId}">`;
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
                '{{__('Front-end/pages/customers.deleted')}}',
                '{{\Illuminate\Support\Facades\Session::get('delete-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('add-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/customers.customer.add')}}',
                '{{\Illuminate\Support\Facades\Session::get('add-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('edit-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/customers.customer.edit')}}',
                '{{\Illuminate\Support\Facades\Session::get('edit-success')}}',
                'success'
            )
        </script>
    @endif
@endsection
