@extends('layouts.main')
@section('header', 'POS')

@section('content')
    <div id="controller" class="row">
        <!-- Order List -->
        <div class="col-8">
            <form method="POST" action="{{ url('/pos/order/confirm-order') }}">
                @csrf

                <div class="card">
                    <div class="card-header">                    
                        <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Order list</h3>

                        <div class="card-tools">
                            <form action="">
                                <div class="input-group input-group-sm my-auto" style="width: 200px;">
                                    <input type="text" name="search" value="" class="form-control" placeholder="Search order">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0" style="height: 330px;">
                        <table class="table table-bordered table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderDetails as $key => $orderDetail)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $orderDetail->product->name }}</td>
                                    <td class="text-center">{{ $orderDetail->quantity }}</td>
                                    <td>Rp.<span class="float-right">{{ number_format($orderDetail->subtotal, '0', '', '.') }}</span> </td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ url('/pos/order/'.$orderDetail->id) }}">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-7 text-bold my-auto">
                                Total
                            </div>
                            <div class="col-3">
                                <div type="text" class="form-control" value="">
                                    Rp. <span class="float-right">{{ number_format($totalPrice, '0', '', '.') }}</span>
                                </div>
                            </div>
                            <div class="col-2 mx-auto">
                                <button type="submit" class="btn btn-default">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Order -->
        <div class="col-4">
            <div class="card">
                <div class="card-header">                    
                    <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Order</h3>
                </div>

                <div class="card-body">
                    @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        {{ Session::get('message') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ url('pos/order/store') }}">
                        @csrf

                        <div class="form-group">
                            <label>Product</label>
                            <select name="product_id" class="form-control">
                                <option selected disabled>Select product</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        <div class="form-group">
                            <label for="">Quantity</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="" value="{{ old('quantity') }}" name="quantity" placeholder="Add quantity">
                            @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
