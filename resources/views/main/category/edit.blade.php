@extends('layouts.main')
@section('header', 'Category')

@section('content')
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit category</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{ url('categories/'.$category->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="" value="{{ $category->name }}" name="name" placeholder="Enter category name">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Update</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
