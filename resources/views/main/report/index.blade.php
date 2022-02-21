@extends('layouts.main')
@section('header', 'Report')

@section('content')
    <div id="controller" class="row">
        <!-- List -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <form action="">
                        <input type="date" class="border" name="dateStart" id="" placeholder="yyyy-mm-dd"> -
                        <input type="date" class="border" name="dateEnd" id="" placeholder="yyyy-mm-dd">
                        <button type="submit">Search</button>
                    </form>
                </div>
                <!-- /.card-header -->

                <!-- Table -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center" width="25%">Transactions</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $transactions }}</td>
                                <td class="text-center">Rp. {{ number_format($transactionsTotal, '0', '', '.') }},-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
@endsection
