<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class TokenController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $login = $request->get('login');
        $password = $request->get('password');

        $carbon = new Carbon();
        $expires_at = $carbon->addMinutes(5);

        $returnToken = md5(microtime() . 'ipvorogcov-test'. time());

        $token = new Token();
        $token->login = $login;
        $token->password = bcrypt($password);
        $token->token = $returnToken;
        $token->expires_at = $expires_at;
        $token->save();


        return response()->json(['token' => $token->token], 201);
    }
}
