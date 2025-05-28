@extends('layouts.app')

@section('title', '登録 -' . config('app.name'))

@section('content')
<form action="{{ route('ingredients.store') }}" method="POST">
    @csrf
    <div id="ingredient-list">
        @php
            $names = old('name', ['']);
            $dates = old('expiration_date', ['']);
        @endphp

        @foreach ($names as $i => $name )
        <div class="flex items-center space-x-2 mb-2">
            <input type="text" name="name[]" placeholder="食材名"
                value="{{ $name }}"

                class="border px-2 py-1 h-10 rounded">
            <input type="date" name="expiration_date[]"
                value="{{ $dates[$i] ?? '' }}"
                class="border px-2 py-1 h-10 rounded">
            
            @error("name.$i")
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        @endforeach
    </div>

    <button type="button" onclick="addIngredientRow()" class="text-blue-600 underline">+ 行を追加</button>

    <br><br>
    <button type="submit" class="px-4 py-2 bg-blue-500 text-red rounded">一括登録</button>
</form>

<h2>お気に入り食材から選ぶ</h2>
<ul class="flex flex-wrap gap-2 mt-2">
    @foreach ($recommend as $item)
        <li>
            <button class="relative overflow-hidden rounded-md bg-neutral-950 px-4 py-2 text-white transition-all duration-300 [transition-timing-function:cubic-bezier(0.175,0.885,0.32,1.275)] active:-translate-y-1 active:scale-x-90 active:scale-y-110"
                type="button" onclick="addFavoriteIngredientRow('{{ $item->name }}')">
            {{ $item->name }}
            </button>
        </li>
    @endforeach
</ul>
@endsection

<script>
function addIngredientRow(name = '', expiration = '') {
    const row = `
        <div class="flex items-center space-x-2 mb-2">
            <input type="text" name="name[]" placeholder="食材名" value="${name}" class="border px-2 py-1 h-10 rounded">
            <input type="date" name="expiration_date[]" value="${expiration}" class="border px-2 py-1 h-10 rounded">
        </div>
    `;
    document.getElementById('ingredient-list').insertAdjacentHTML('beforeend', row);
}

function addFavoriteIngredientRow(name) {
    addIngredientRow(name);
}
</script>