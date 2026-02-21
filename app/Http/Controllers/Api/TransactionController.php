<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __invoke(Request $request)
    {
        $dateInterval = [
            'from' => Carbon::parse($request->input('from', now()))->format('Y-m-d 00:00:00'),
            'to' => Carbon::parse($request->input('to', now()))->format('Y-m-d 23:59:59'),
        ];

        $transactions = Transaction::whereBetween('created_at', $dateInterval)
            ->simplePaginate($request->input('per_page', 15));

        return response()->json([
            'transactions' => $transactions,
        ]);
    }
}
