<?php

namespace App\Http\Controllers;

use App\Models\Data;

use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function index()
    {
        $data = Data::orderBy('id', 'asc')->paginate();
        return view('backend.index', compact('data'));
    }


    public function show($id)
    {
        $data = Data::findOrFail($id)->toArray();
        $content = json_decode($data['data'], true, 512, JSON_THROW_ON_ERROR);
        $token = \App\Models\Token::findOrFail($data['token_id'])->value('token');
        return view('backend.show', compact('data', 'content', 'token'));
    }

    public function edit($id)
    {
        $data = Data::findOrFail($id);
        return view('backend.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $dataRequest = $request->all('data')['data'];
        $data = Data::find($id);
        $data->data = $dataRequest;
        $data->save();
        return redirect()->route('backend.index');
    }

    public function destroy($id)
    {
        $data = Data::findOrFail($id);
        $data->delete();
        return redirect()->route('backend.index');
    }
}
