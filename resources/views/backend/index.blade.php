@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1 class="m-5">All data</h1>
        <table class="table mt-2">
            <thead>
            <tr>
                <th>ID</th>
                <th>JSON string</th>
                <th>Script time</th>
                <th>Script memory</th>
                <th>Actions</th>
            </tr>
            </thead>
            @if ($data)
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="{{ route('backend.show', $item->id) }}">{{ $item->data }}</a></td>
                        <td> {{ $item->script_time }} </td>
                        <td> {{ $item->script_memory }} </td>
                            <td>
                                <a href="{{ route('backend.edit', $item->id) }}">Edit</a>
                                <a class="text-danger" href="{{ route('backend.destroy', $item->id) }}" data-method="delete" rel="nofollow" data-confirm="Are you sure?">Delete</a>
                            </td>
                    </tr>
                @endforeach
            @endif
        </table>
        <nav>
            <ul class="pagination">
                <li>{{ $data->onEachSide(3)->links() }}</li>
            </ul>
        </nav>
    </div>
@endsection
