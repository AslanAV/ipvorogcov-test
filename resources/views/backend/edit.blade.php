@extends('layouts.layout')

@section('content')
    <h1 class="mt-5">ID {{ $data->id }}</h1>
    {{Form::model($data, ['url' => route('backend.update', [$data->id]), 'method' => 'PATCH'])}}
    <div class="form-group mb-3">
        {{Form::label('data', 'JSON string')}}
        {{Form::textarea('data', $data->data, ['class' => 'form-control', 'cols' => '30', 'rows' => '20'])}}
    </div>
    {{Form::submit('update', ['class' => 'btn btn-info mt-3'])}}
    {{Form::close()}}
@endsection
