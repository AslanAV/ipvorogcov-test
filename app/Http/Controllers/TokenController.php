<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;


class TokenController extends Controller
{
    public function store(Request $request)
    {
        $login = $request->get('login');
        $password = $request->get('password');

        $carbon = new Carbon();
        $expires_at = $carbon->subMinutes(5);

        $salt = 'ipvorogcov-test';
        $returnToken = md5(microtime() . $salt . time());

        $token = new Token();
        $token->login = $login;
        $token->password = bcrypt($password);
        $token->token = $returnToken;
        $token->expires_at = $expires_at;
        $token->save();


        return response()->json(['token' => $returnToken], 201);
    }
}
