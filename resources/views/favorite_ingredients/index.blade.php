@extends('layouts.app')

@section('title', 'お気に入り食材 -' . config('app.name'))

@section('content')
<div id="app">
    <favorite-ingredient-app :initial-items='@json($favoriteIngredients)' />
</div>

@endsection

