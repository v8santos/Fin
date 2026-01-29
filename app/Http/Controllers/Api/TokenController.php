<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function getAll(Request $request)
    {
        $userTokens = $request->user()->tokens;

        return ['tokens' => $userTokens];
    }

    public function store(Request $request)
    {
        $token = $request->user()->createToken($request->token_name);

        return ['token' => $token->plainTextToken];
    }
}
