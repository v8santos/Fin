<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Commitment\StoreRequest;
use App\Models\Account;
use App\Models\Commitment;
use Carbon\Carbon;
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

        $rule = new \Recurr\Rule;

        $rule->setFreq($request->frequency)
            ->setInterval($request->interval);

        if ($request->input('weekdays')) {
            $rule->setByDay($request->input('weekdays'));
        }

        if ($request->input('day_of_month')) {
            $rule->setByMonthDay([$request->input('day_of_month')]);
        }

        if ($request->input('month')) {
            $rule->setByMonth([$request->input('month')]);
        }

        if ($request->input('end_date')) {
            $endDate = Carbon::parse($request->input('end_date').'23:59:59');
            $rule->setEndDate($endDate);
        }

        $commitment = Commitment::create([
            'user_id' => $request->user()->id,
            'account_id' => $account->id,
            'fixed_amount' => $request->input('fixed_amount'),
            'is_variable' => $request->is_variable,
            'description' => $request->input('description'),
            'start_date' => $request->input('start_date', today()->format('Y-m-d')),
            'end_date' => $request->input('end_date'),
            'rrule' => $rule->getString(),
        ]);

        return response()->json(compact('commitment'));
    }
}
