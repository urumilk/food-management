@extends('layouts.app')

@section('title', 'お気に入り食材 -' . config('app.name'))

@section('content')
<div id="app">
    <favorite-ingredient-list :initial-items='@json($favoriteIngredients)' />
</div>
<div id="app">
    <ingredient-like></ingredient-like>
</div>
<div class="container">

    {{-- お気に入り食材があるか確認 --}}
    @if ($favoriteIngredients->count())
        <!-- <form method="GET" action="{{ route('favorite-ingredients.index') }}">
            <div class="sort">
                <select name="sort" onchange="this.form.submit()">
                    <option value="expiration_asc" {{ request('sort')== 'expiration_asc' ? 'selected' : ''}}>賞味期限近い順</option>
                    <option value="expiration_desc" {{ request('sort')== 'expiration_desc' ? 'selected' : ''}}>賞味期限遠い順</option>
                </select>
            </dev>
        </form> -->
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>名前</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($favoriteIngredients as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <!-- <td> -->
                            <!-- 編集ボタン -->
                            <!-- <a href="{{ route('ingredients.edit', $item->id) }}" class="text-blue-600 hover:underline">編集</a> -->

                            <!-- 削除ボタン -->
                            <!-- <form action="{{ route('ingredients.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2">削除</button>
                            </form> -->
                        <!-- </td> -->
                    </tr>
                @endforeach

        
                
            </tbody>
        </table>
        
    @else
        <p>現在、登録されている食材はありません。</p>
    @endif

    <!-- <a href="{{ route('ingredients.create') }}" class="btn btn-primary mt-3">新しい食材を追加</a> -->
</div>
@endsection

