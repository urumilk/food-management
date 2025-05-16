@extends('layouts.app') {{-- ログイン機能がある場合のレイアウト。なければ 'layout' などに変更 --}}

@section('content')
<div class="container">
    <h1>食材一覧</h1>

    {{-- フラッシュメッセージ --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- 食材があるか確認 --}}
    @if ($ingredients->count())
        <table class="table">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>賞味期限</th>
                    <th>登録日</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ingredients as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->expiration_date ? \Carbon\Carbon::parse($item->expiration_date)->format('Y-m-d') : '未設定' }}</td>
                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
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
