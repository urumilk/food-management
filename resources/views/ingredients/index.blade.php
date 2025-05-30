@extends('layouts.app') {{-- ログイン機能がある場合のレイアウト。なければ 'layout' などに変更 --}}

@section('title', '食材一覧 -' . config('app.name'))

@section('content')

@include('ingredients.today-ingredient')

<div class="container">
    <h1>食材一覧</h1>
    <div id="app">
            <ingredient-like></ingredient-like>
    </div>

    {{-- フラッシュメッセージ --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- 食材があるか確認 --}}
    @if ($ingredients->count())
        <form method="GET" action="{{ route('ingredients.index') }}">
            <div class="sort">
                <select name="sort" onchange="this.form.submit()">
                    <option value="expiration_asc" {{ request('sort')== 'expiration_asc' ? 'selected' : ''}}>賞味期限近い順</option>
                    <option value="expiration_desc" {{ request('sort')== 'expiration_desc' ? 'selected' : ''}}>賞味期限遠い順</option>
                </select>
            </dev>
        </form>
        <form method="POST" action="{{ route('ingredients.bulkDelete') }}">
            @csrf
            @method('DELETE')
            <table class="table border-collapse border border-gray-200 border-4 w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-200 border-4 bg-gray-200 h-10"><input type="checkbox" id="checkAll"></th>
                        <th class="border border-gray-200 border-4 bg-gray-200 h-10">名前</th>
                        <th class="border border-gray-200 border-4 bg-gray-200 h-10">賞味期限</th>
                        <th class="border border-gray-200 border-4 bg-gray-200 h-10">残り日数</th>
                        <th class="border border-gray-200 border-4 bg-gray-200 h-10"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredients as $item)
                        <tr>
                            <td>
                                <input type="checkbox" name="ids[]" value="{{ $item->id }}">
                            </td>
                            <td class="border border-gray-200 border-4">{{ $item->name }}</td>
                            <td class="border border-gray-200 border-4">{{ $item->expiration_date ? \Carbon\Carbon::parse($item->expiration_date)->format('Y年m月d日') : '未設定' }}</td>
                            <td class="border border-gray-200 border-4">@if (is_null($item->expiration_date))
                                    未設定
                                @elseif ($item->diffindays > 0)
                                    あと{{$item->diffindays}}日
                                @elseif ($item->diffindays < 0)
                                    期限切れ！{{abs($item->diffindays)}}日経過
                                @else
                                    今日が期限！
                                @endif
                            </td>
                            <td class="border border-gray-200 border-4 text-center">
                                <!-- 編集ボタン -->
                                <a href="{{ route('ingredients.edit', $item->id) }}" class="text-blue-600 hover:underline">編集</a>

                                <!-- 削除ボタン -->
                                <form action="{{ route('ingredients.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('本当に削除しますか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-2">削除</buttom>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">選択した食材を削除</button>
        </form>
        
    @else
        <p>現在、登録されている食材はありません。</p>
    @endif

    <a href="{{ route('ingredients.create') }}" class="btn btn-primary mt-3">新しい食材を追加</a>
</div>

<script>
    // 全選択チェックボックス機能
    document.getElementById('checkAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
    
</script>
@endsection
