@extends('layouts.main')
@section('header', 'Product')

@section('content')
<div id="controller">
    <div class="row">
        <!-- Add button -->
        <div class="col-md-3">
            <a class="btn btn-success border" href="{{ route('products.create') }}">
                <i class="fas fa-plus-circle"></i> Add New Data
            </a>
        </div>

        <!-- Search -->
        <div class="col-md-5">
            <form action="{{ route('products.index') }}">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search product name">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <hr>
    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Success!</h5>
        {{ Session::get('message') }}
    </div>
    @endif

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-1">
            <div class="info-box shadow-sm">
                <span class="info-box-icon">
                    <img src="{{ $product->image }}" alt="">
                </span>
                
                <div class="info-box-content">
                    <span class="info-box-text">{{ $product->name }}</span>
                    <span class="info-box-number text-sm">Rp. {{ number_format($product->price) }},-</span>
                </div>

                <div class="icon">
                    <a href="{{ url('products', ['id' => $product->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                </div>
            </div>
        
        </div>
        @endforeach
    </div>
</div>
@endsection
