@extends('layouts.main')
@section('header', 'Category')

@section('content')
    <div id="controller" class="row justify-content-center">
        <!-- List -->
        <div class="col-6">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list"></i> List of category</h3>

                    <div class="card-tools">
                        <form action="/categories">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                <input type="text" name="search" value="{{ $search }}" class="form-control float-right" placeholder="Search name">
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
        
        <!-- Add Form -->
        <div class="col-6">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-plus-square"></i> Add new category</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (session()->has('categoryAdded'))
                    <div class="alert alert-info" role="alert">
                        {{ session('categoryAdded') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="" value="{{ old('name') }}" name="name" placeholder="Enter category name">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
@endsection
