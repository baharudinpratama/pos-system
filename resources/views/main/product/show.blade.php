@extends('layouts.main')
@section('header', 'Product')

@section('content')
<div id="controller" class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Product Detail</h3>
                </div>
                <div class="card-body">
                     <div class="row">
                        <div class="col-12 text-center">
                            <img src="/{{ $product->image }}" alt="No image" class="img-circle img-fluid">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            Product Name
                        </div>
                        <div class="col-1 w-10">
                            :
                        </div>
                        <div class="col-7">
                            {{ $product->name }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            Category
                        </div>
                        <div class="col-1 w-10">
                            :
                        </div>
                        <div class="col-7">
                            {{ $product->category->name }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            Stock
                        </div>
                        <div class="col-1 w-10">
                            :
                        </div>
                        <div class="col-7">
                            {{ $product->stock }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            Price
                        </div>
                        <div class="col-1 w-10">
                            :
                        </div>
                        <div class="col-7">
                            Rp. {{ number_format($product->price) }},-
                        </div>
                    </div>
            </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <form method="POST" action="{{ url('products', ['id' => $product->id]) }}">
                                @csrf
                                @method('delete')

                                <a class="btn btn-warning btn-sm text-white" href="{{ url('/products/'.$product->id.'/edit') }}">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <!-- Go back link -->
                            <a href="{{ route('products.index') }}" class="btn btn-default float-right">Go back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
