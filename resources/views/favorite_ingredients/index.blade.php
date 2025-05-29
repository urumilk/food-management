@extends('layouts.app')

@section('title', 'お気に入り食材 -' . config('app.name'))

@section('content')
<div id="app">
    <favorite-ingredient-list :initial-items='@json($favoriteIngredients)' />
</div>
<div id="app">
    <ingredient-like></ingredient-like>
</div>

@endsection

