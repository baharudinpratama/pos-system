@extends('layouts.main')
@section('header', 'Product')

@section('content')
<div id="controller" class="row">
    <div class="col-12">
        <!-- general form elements -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus-circle"></i> Add Product</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="" placeholder="Enter product name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control">
                                    <option selected disabled>Select category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" name="price" id="" placeholder="Enter product price">
                                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Stock</label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}" name="stock" id="" placeholder="Enter product stock">
                                @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Product image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="image" class="" id="">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
