@php
use \App\Helpers\JSONtoHTMLHelper;
@endphp
@extends('layouts.layout')

@section('content')
    <h2 class="text-break">
        ID: {{ $data['id'] }}
    </h2>
    <h2 class="text-break">
        Token: {{ $token }}
    </h2>

    <h2 class="text-break">
        Script Time: {{ $data['script_time'] }} seconds
    </h2>

    <h2 class="text-break">
        Script Memory: {{ $data['script_memory'] }} bytes
    </h2>

    <h2 class="text-break">
        Data: <a href="{{ route('backend.edit', $data['id']) }}">Edit</a>
    </h2>
    {!! JSONtoHTMLHelper::getMarkList($content) !!}

    <script>
        $('.menu-header').on(`click`, function() {
            $(this).next().stop(true).slideToggle();
        });
    </script>
@endsection('content')
