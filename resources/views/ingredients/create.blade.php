@extends('layouts.app')

@section('content')
<form action="{{ route('ingredients.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="食材名">
    <input type="date" name="expiration_date">
    <button type="submit">登録</button>
</form>
@endsection