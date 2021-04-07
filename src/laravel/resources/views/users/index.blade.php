@extends('app')

@section('title', 'ユーザー一覧')

@section('contents')

<div class="my-3">
    <a href="{{ route('users.create') }}" class="btn btn-primary">
        新規登録
    </a>
</div>

@if ($users->isEmpty())
<div>ユーザーのデータがありません。</div>
@else
<table class="table table-bordered my-2">
    <thead>
        <tr>
            <th>#</th>
            <th>ユーザー名</th>
            <th>会社名</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>
                <a href="{{ route('users.edit', $user) }}">{{ $user->name }}</a>
            </td>
            <td>{{ $user->customer->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection