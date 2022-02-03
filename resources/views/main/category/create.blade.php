@extends('layouts.main')
@section('header', 'Category')

@section('content')
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus-circle"></i> Add new category</h3>
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
                        <button type="submit" class="btn btn-default">Submit</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-default">Back</a>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer"></div>
        </div>
    </div>
@endsection