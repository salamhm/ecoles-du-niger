@extends('admin.layouts.app')
@section('title') {{ $pageTitle }} @endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h1><i class="fa fa-tags fa-sm"></i> {{$pageTitle}}</h1>
    </div>
    @include('admin.partials.flash')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{$subTitle}}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary pull-right">Add Category</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="myDataTable">
                                <thead>                                 
                                    <tr>
                                        <th>id</th>
                                        <th>Nom</th>
                                        <th>Slug</th>
                                        <th>Parent</th>
                                        <th>Featured</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>                                 
                                    @foreach ($categories as $category)
                                        @if ($category->id != 1)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->parent->name }}</td>
                                                <td>
                                                    @if ($category->featured == 1)
                                                        <span class="badge badge-success">Oui</span>
                                                    @else
                                                        <span class="badge badge-danger">Non</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-icon btn-primary">
                                                        <i class="far fa-edit fa-fw"></i>
                                                    </a>
                                                    <a href="{{ route('admin.categories.delete', $category->id) }}" class="btn btn-icon btn-danger">
                                                        <i class="fas fa-trash fa-fw"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
        </div>
    </div>

</section>
@endsection
@push('scripts')
    <script src="{{ asset('/backend/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/backend/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/backend/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('/backend/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/backend/js/custom-table.js') }}"></script>
@endpush