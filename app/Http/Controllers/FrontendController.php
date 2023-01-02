<?php

namespace App\Http\Controllers;

use App\Helpers\IsValidTimeTokenHelpers;
use App\Helpers\ScriptMemoryHelper;
use App\Helpers\ScriptTimeHelper;
use App\Models\Data;
use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function store(Request $request)
    {
        $scriptTimeStart = ScriptTimeHelper::startScriptTime();
        $scriptMemoryStart = ScriptMemoryHelper::startScriptMemory();

        $tokenAuth = $request->header('Authorization');
        $tokenDB = Token::where('token', $tokenAuth)->get();

        $tokenId = $tokenDB->value('id');
        if ($tokenId === null) {
            abort(403);
        }

        if (!IsValidTimeTokenHelpers::validateToken($tokenDB)) {
            abort(403, "Token is out expires!");
        }

        $content = $request->getContent();

        $data = new Data();
        $data->data = $content;
        $data->token_id = $tokenId;
        $data->script_time = ScriptTimeHelper::calculateScriptTime($scriptTimeStart);
        $data->script_memory = ScriptMemoryHelper::calculateScriptMemory($scriptMemoryStart);
        $data->save();

        return response()->json(['id' => $data->id, 'scriptTime' => $data->script_time, 'scriptMemory' => $data->script_memory], 201);
    }
}
