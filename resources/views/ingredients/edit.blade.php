@extends('layouts.app')
@section('content')
<form action="{{ route('ingredients.update', $ingredient->id)}}" method="POST">
    @csrf
    @method('PATCH')
    <input type="text" name="name" placeholder="食材名" required value="{{ old('name', $ingredient->name) }}">
    <input type="date" name="expiration_date" value="{{ old('expiration_date', $ingredient->expiration_date) }}">
    <button type="submit">更新</button>
</form>
@endsection