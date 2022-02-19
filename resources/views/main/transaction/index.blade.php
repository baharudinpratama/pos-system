@extends('layouts.main')
@section('header', 'Transaction')

@section('content')
    <div id="controller" class="row">
        <!-- List -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transaction list</h3>
                </div>
                <!-- /.card-header -->

                <!-- Table -->
                <div class="card-body table-responsive p-0" style="height: 330px;">
                    <table class="table table-bordered table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">#</th>
                                <th class="text-center">Cashier</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $key => $transaction)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $transaction->cashier }}</td>
                                <td>Rp. <span class="float-right">{{ number_format($transaction->total, '0', '', '.') }}</span></td>   
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
