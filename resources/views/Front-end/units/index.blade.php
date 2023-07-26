@extends('layouts.master')
@section('title',__('Front-end/pages/units.title'))
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
            <h3><strong>{{__('Front-end/pages/units.title')}}</strong></h3>
        </div>
        @can('add_unit')
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="{{route('units.create')}}"
                   class="btn btn-primary">{{__('Front-end/pages/units.add.unit')}}</a>
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
                    <th>{{__('Front-end/pages/units.name')}}</th>
                    <th>{{__('Front-end/pages/users.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($units as $unit)
                    <tr>
                        <td>{{$rowNumber++}}</td>

                        <td>
                            <a href="{{ route('units.show', $unit->id) }}">
                                {{ $unit->translations->first()->name }}
                            </a>
                        </td>
                        <td>
                            @can('edit_unit')
                                <a href="{{route('units.edit',$unit->id)}}"><i class="align-middle"
                                                                                       data-feather="edit-2"></i></a>
                            @endcan
                            @can('delete_customer')
                                <a href="#" onclick="deletes({{ $unit->id }})"><i class="align-middle"
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
        function deletes(unitsId) {
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
                    deleteCustomer(unitsId);
                }
            })
        }

        function deleteCustomer(unitsId) {
            // Send an AJAX request or submit a form to the delete route
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('units.destroy', ['unit' => '__unitsId__']) }}'.replace('__unitsId__', unitsId);
            form.innerHTML = `<input type="hidden" name="_method" value="DELETE">`;
            form.innerHTML = `<input type="hidden" name="id" value="${unitsId}">`;
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
                '{{__('Front-end/pages/units.deleted')}}',
                '{{\Illuminate\Support\Facades\Session::get('delete-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('add-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/units.unit.add')}}',
                '{{\Illuminate\Support\Facades\Session::get('add-success')}}',
                'success'
            )
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('edit-success'))
        <script>
            Swal.fire(
                '{{__('Front-end/pages/units.unit.edit')}}',
                '{{\Illuminate\Support\Facades\Session::get('edit-success')}}',
                'success'
            )
        </script>
    @endif
@endsection
