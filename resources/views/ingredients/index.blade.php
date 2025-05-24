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
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>名前</th>
                    <th>賞味期限</th>
                    <th>残り日数</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ingredients as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->expiration_date ? \Carbon\Carbon::parse($item->expiration_date)->format('Y年m月d日') : '未設定' }}</td>
                        <td>@if (is_null($item->expiration_date))
                                未設定
                            @elseif ($item->diffindays > 0)
                                あと{{$item->diffindays}}日
                            @elseif ($item->diffindays < 0)
                                期限切れ！{{abs($item->diffindays)}}日経過
                            @else
                                今日が期限！
                            @endif
                        </td>
                        <td>
                            <!-- 編集ボタン -->
                            <a href="{{ route('ingredients.edit', $item->id) }}" class="text-blue-600 hover:underline">編集</a>

                            <!-- 削除ボタン -->
                            <form action="{{ route('ingredients.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

        
                
            </tbody>
        </table>
        
    @else
        <p>現在、登録されている食材はありません。</p>
    @endif

    <a href="{{ route('ingredients.create') }}" class="btn btn-primary mt-3">新しい食材を追加</a>
</div>
@endsection
