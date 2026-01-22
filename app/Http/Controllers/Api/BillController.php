<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function getAll(): JsonResponse
    {
        $bills = Bill::where('user_id', User::first()->id)->orderByDesc('id')->get();
    	return response()->json(['data' => $bills]);
    }
    
    public function find(Bill $bill): JsonResponse
    {
        if ($bill->user_id !== User::first()->id) {
            return response()->json(['error' => 'Acesso negado ao recurso.'], 403);
        }
        
        return response()->json(['data' => $bill]);
    }
    
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'amount' => 'required|integer:strict',
            'label' => 'nullable|string|min:3,max:255',
            'paid' => 'sometimes|boolean',
            'amount_paid' => 'sometimes|integer:strict',
        ]);

        Bill::create([
            'user_id' => User::first()->id,
            'amount' => $request->amount,
            'label' => $request->label,
            'paid' => (bool) $request->get('paid'),
            'amount_paid' => $request->get('amount_paid') ?? 0,
        ]);

        return response()->json(['message' => 'Conta criada com sucesso.'], 201);
    }
}
