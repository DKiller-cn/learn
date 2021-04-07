@extends('app')

@section('title', '新規登録')

@section('contents')

@if (Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('users.save') }}" method="post">

    @csrf

    <div class="form-group">
        <label>ユーザー名</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
    </div>

    <div class="form-group">
        <label>メール</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="form-group">
        <label>パスワード</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label>会社名</label>
        <input type="text" name="customerName" class="form-control">
    </div>

    <button type="submit" class="btn btn-success my-3">保存する</button>

</form>

@endsection

@if (Session::has('message'))
@section('script')
<script>
    setTimeout(function() {
        location.href = "{{ route('users.index') }}";
    }, 1000);
</script>
@endsection
@endif