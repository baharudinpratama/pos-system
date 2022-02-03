@extends('layouts.main')
@section('header', 'Category')

@section('content')
    <div id="controller" class="row">
        <!-- List -->
        <div class="col-12">
            <div class="card">
                @if(Session::has('categoryAdded'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('categoryAdded') }}
                    <button type="button" class="btn btn-success btn-sm float-right" data-dismiss="alert">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif
                @if(Session::has('categoryUpdated'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ Session::get('categoryUpdated') }}
                    <button type="button" class="btn btn-info btn-sm float-right" data-dismiss="alert">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif
                @if(Session::has('categoryDeleted'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ Session::get('categoryDeleted') }}
                    <button type="button" class="btn btn-warning btn-sm float-right" data-dismiss="alert">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif
                <div class="card-header">
                    <a class="btn btn-success btn-sm" href="{{ route('categories.create') }}">
                        <i class="fas fa-plus-circle"></i> Add New Data
                    </a>

                    <div class="card-tools">
                        <form action="{{ route('categories.index') }}">
                            <div class="input-group input-group-sm my-auto" style="width: 200px;">
                                <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search name">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->

                <!-- Table -->
                <div class="card-body table-responsive p-0" style="height: 330px;">
                    <table class="table table-bordered table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">#</th>
                                <th class="text-center" width="50%">Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $key => $category)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td class="text-center">
                                    <form method="POST" action="{{ url('categories', ['id' => $category->id]) }}">
                                        @csrf
                                        @method('delete')

                                        <a class="btn btn-warning btn-sm text-white" href="{{ url('/categories/'.$category->id.'/edit') }}">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>   
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
@endsection
