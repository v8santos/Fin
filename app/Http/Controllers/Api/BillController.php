<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function getAll(Request $request): JsonResponse
    {
        $bills = $request->user()->bills()->orderByDesc('id')->get();
    	return response()->json(['data' => $bills]);
    }

    public function search(Request $request): JsonResponse
    {
        /**
         * Available filters
         * 
         * $request->label
         * $request->id
         */
        $bill = $request->user()->bills()
            ->when($request->id, function ($query, $filter) {
                $query->where('id', $filter);
            })->when($request->label, function ($query, $filter) {
                $query->where('label', $filter);
            })->get();

        return response()->json(['bills' => $bill]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'amount' => 'required|integer:strict',
            'label' => 'nullable|string|min:3,max:255',
            'paid' => 'sometimes|boolean',
            'amount_paid' => 'sometimes|integer:strict',
            'due_date' => 'sometimes|date_format:Y-m-d',
        ]);

        $request->user()->bills()->create([
            'amount' => $request->amount,
            'label' => $request->label,
            'paid' => (bool) $request->input('paid'),
            'amount_paid' => $request->input('amount_paid', 0),
            'due_date' => $request->input('due_date'),
        ]);

        return response()->json(['message' => 'Conta criada com sucesso.'], 201);
    }

    public function update(Request $request, Bill $bill): JsonResponse
    {
        $validated = $request->validate([
            'amount' => 'sometimes|integer:strict',
            'label' => 'sometimes|nullable|string|min:3,max:255',
            'paid' => 'sometimes|boolean',
            'amount_paid' => 'sometimes|integer:strict',
            'due_date' => 'sometimes|date_format:Y-m-d',
        ]);

        if ($bill->user_id !== $request->user()->id) {
            \Log::error("Erro ao atualizar conta: dono do recurso não é quem faz a requisição", [
                'user_id' => $request->user()->id,
                'bill_id' => $bill->id,
            ]);
            return response()->json(['error' => 'Conta não encontrada'], 404);
        }

        $updated = $bill->update(array_merge($validated, [
            'user_id' => $request->user()->id,
        ]));

        if (!$updated) {
            \Log::error("Erro ao atualizar conta: Motivo desconhecido");
            return response()->json(['error' => 'Não foi possível editar essa conta.'], 500);
        }

        return response()->json(['message' => 'Conta editada com sucesso.', 'bill' => $bill]);
    }

    public function delete(Bill $bill): JsonResponse
    {
        try {
            if ($bill->user_id !== $request->user()->id) {
                \Log::error("Erro ao atualizar conta: dono do recurso não é quem faz a requisição", [
                    'user_id' => $request->user()->id,
                    'bill_id' => $bill->id,
                ]);
                return response()->json(['error' => 'Conta não encontrada'], 404);
            }

            $bill->delete();

            return response()->json(null,204);
        } catch (\Exception $e) {
            \Log::error("Erro ao remover conta: {$e->getMessage()}");
            return response()->json(['message' => 'Erro ao remover conta.'], 500);
        }
    }
}
