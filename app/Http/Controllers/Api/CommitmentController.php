<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commitment\StoreRequest;
use App\Models\Account;
use App\Models\Commitment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommitmentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $commitments = Commitment::where('user_id', $request->user()->id)
            ->get();

        return response()->json(compact('commitments'));
    }

    public function getByAccount(Request $request, int $accountId): JsonResponse
    {
        $commitments = Commitment::where('user_id', $request->user()->id)
            ->where('account_id', $accountId)
            ->get();

        return response()->json(compact('commitments'));
    }

    public function create(StoreRequest $request): JsonResponse
    {
        $account = Account::where('id', $request->input('account_id'))
            ->where('user_id', $request->user()->id) // da pra melhorar bastante
            ->firstOrFail();

        $commitment = Commitment::create([
            'user_id' => $request->user()->id,
            'account_id' => $account->id,
            'fixed_amount' => $request->input('fixed_amount'),
            'is_variable' => $request->input('is_variable', false),
            'description' => $request->input('description'),
            'start_date' => $request->input('start_date', today()->format('Y-m-d')),
            'end_date' => $request->input('end_date'),
            'rrule' => 'pendente', // Vamos adicionar as dependencias para montar e validar essa regra
        ]);

        return response()->json(compact('commitment'));
    }
}
