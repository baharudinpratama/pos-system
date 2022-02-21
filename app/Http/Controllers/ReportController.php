<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (!empty($request->dateStart) && !empty($request->dateEnd)) {
            $dateStart = $request->dateStart;
            $dateEnd = $request->dateEnd;

            $transactions = Transaction::whereBetween('created_at', [
                $request->dateStart,
                Carbon::parse($request->dateEnd)->endOfDay(),
            ])->count();

            $transactionsTotal = Transaction::whereBetween('created_at', [
                $request->dateStart,
                Carbon::parse($request->dateEnd)->endOfDay(),
            ])->sum('total');
        } else {
            $transactions = Transaction::where('created_at', Carbon::today()->format('Y-m-d'))->count();

            $transactionsTotal = Transaction::where('created_at', Carbon::today()->format('Y-m-d'))->sum('total');
        }

        return view('main.report.index', compact('transactions', 'transactionsTotal'));
    }
}
