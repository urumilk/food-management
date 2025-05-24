@if($ingredients -> contains(fn($i) => $i->diffindays == 0))
<div class="speech-bubble">
    <p>今日はこれを使おう！</p>
    @foreach ($ingredients as $item)
        @if ($item->diffindays == 0)
            <div class="today-ingredient">{{$item->name}}</div>
        @endif
    @endforeach
</div>
@endif

<style>
.speech-bubble {
    position: relative;
    background: #f0f8ff;
    border: 2px solid #00aaff;
    border-radius: 1em;
    padding: 1em 1.5em;
    max-width: 90%;
    margin: 2em auto;
    font-size: 1.2rem;
    color: #333;

    display: flex; 
    flex-wrap: wrap; 
    gap: 0.5em;
    justify-content: center;

}

.speech-bubble > p {
    width: 100%;
    text-align: center;
    margin-bottom: 0.5em;
}

.speech-bubble::after {
    content: '';
    position: absolute;
    bottom: -20px;
    left: 30px;
    border-width: 10px 10px 0;
    border-style: solid;
    border-color: #00aaff transparent;
    display: block;
    width: 0;
}

.today-ingredient {
    background: #f0f8ff;
    border: 2px solid #00aaff;
    border-radius: 1em;
    padding: 0.5em 1em;
    font-size: 1.2rem;
    color: #333;
    white-space: nowrap;
}

</style>