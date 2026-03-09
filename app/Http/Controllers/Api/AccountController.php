<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $userAccounts = Account::where('user_id', $request->user()->id)
            ->select('name', 'amount')
            ->get();

        return response()->json(compact('userAccounts'));
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'amount' => 'required|integer',
        ]);

        $account = Account::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'user_id' => $request->user()->id,
        ]);

        return response()->json(compact('account'));
    }
}
