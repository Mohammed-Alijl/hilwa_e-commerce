@extends('dashboard.layouts.master')
@section('title',__('Front-end/pages/products.title'))
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-header')
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{__('Front-end/pages/products.title')}}</strong></h3>
        </div>
        @can('add_product')
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{route('products.create')}}" class="btn btn-primary">{{__('Front-end/pages/products.add.product')}}</a>
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
                    <th>{{__('Front-end/pages/products.name')}}</th>
                    <th>{{__('Front-end/pages/products.category')}}</th>
                    <th>{{__('Front-end/pages/products.price')}}</th>
                    <th>{{__('Front-end/pages/products.unit')}}</th>
                    <th>{{__('Front-end/pages/products.stock_quantity')}}</th>
                    <th>{{__('Front-end/pages/products.stock_status')}}</th>
                    <th>{{__('Front-end/pages/products.weight_in_points')}}</th>
                    <th>{{__('Front-end/pages/products.status')}}</th>
                    <th>{{__('Front-end/pages/products.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            <img src="{{URL::asset('img/products/' . $product->images->first()->name)}}" width="32" height="32" class="rounded-circle my-n1" alt="{{$product->name}}">
                        </td>
                        <td>
                            @can('view_product')
                                <a href="{{route('products.show',$product->id)}}">
                                    {{$product->name}}
                                </a>
                            @else
                                {{$product->name}}
                            @endcan
                        </td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->special_price != 0 ? $product->special_price : $product->price}}</td>
                        <td>{{$product->unit->name}}</td>
                        <td>{{$product->stock_quantity}}</td>
                        <td>
                            @switch($product->stock_status)
                                @case(0) {{__('Front-end/pages/products.in_stock')}} @break
                                @case(1) {{__('Front-end/pages/products.out_of_stock')}} @break
                                @case(2) {{__('Front-end/pages/products.2_3_days')}} @break
                                @case(3) {{__('Front-end/pages/products.4_7_days')}} @break
                            @endswitch
                        </td>
                        <td>{{$product->weight_in_points}}</td>
                        <td>
                            @if($product->status)
                                <span class="badge badge-success-light">{{ __('Front-end/pages/products.enable') }}</span>
                            @else
                                <span class="badge badge-danger-light">{{ __('Front-end/pages/products.disable') }}</span>
                            @endif
                        </td>

                        <td>
                            @can('edit_product')
                                <a href="{{route('products.edit',$product->id)}}"><i class="align-middle"
                                                                                        data-feather="edit-2"></i></a>
                            @endcan
                            @can('delete_product')
                                <a href="#" onclick="deletes({{ $product->id }})"><i class="align-middle"
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
        function deletes(productId) {
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
                    deleteUser(productId);
                }
            })
        }

        function deleteUser(productId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('products.destroy', ['product' => '__productId__']) }}'.replace('__productId__', productId);
            form.innerHTML = `<input type="hidden" name="_method" value="DELETE">`;
            form.innerHTML = `<input type="hidden" name="id" value="${productId}">`;
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
                '{{__('Front-end/pages/products.edited')}}',
                '{{\Illuminate\Support\Facades\Session::get('edit-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('add-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/products.product.add')}}',
                '{{\Illuminate\Support\Facades\Session::get('add-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('delete-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/products.deleted')}}',
                '{{\Illuminate\Support\Facades\Session::get('delete-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('delete-failed'))
        <script>
            Swal.fire({
                title: '{{__('Front-end/pages/products.can.not.delete')}}',
                text: '{{\Illuminate\Support\Facades\Session::get('delete-failed')}}',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: '{{__('Front-end/pages/stores.ok')}}'
            })
        </script>
    @endif
@endsection
