<div class="speech-bubble">
    <p>今日はこの食材を使おう！</p>
</div>

<style>
.speech-bubble {
    position: relative;
    background: #f0f8ff;
    border: 2px solid #00aaff;
    border-radius: 1em;
    padding: 1em 1.5em;
    max-width: 300px;
    margin: 2em auto;
    font-size: 1.2rem;
    color: #333;
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
</style>