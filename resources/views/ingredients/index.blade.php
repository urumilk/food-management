ingredients

@foreach($ingredients as $item)
<li>{{ $item->name }}（賞味期限：{{ $item->expiration_date }}）</li>
@endforeach