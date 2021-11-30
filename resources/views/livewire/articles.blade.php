<div>
    <h1>Articles</h1>
    <p>
        Search: <input type="text" wire:model="query" wire:keydown="refresh">
    </p>
    @foreach ($articles as $category => $article)
    <strong>{{ $category }}</strong>
    <ul>
        @foreach ($article as $item)
        <li>
            <label><input type="checkbox" wire:model="pins" name="pins" value="{{ $item['id'] }}"> pin</label>
            <p>
                Title: {{ $item['title'] }}<br />
                Link: <a href="{{ $item['url'] }}" target="_blank">{{ $item['url'] }}</a><br>
                Published: {{ $item['date'] }}
            </p>
        </li>
        @endforeach
    </ul>
    @endforeach
    <hr>
    <h2>Pins</h2>
    <ul>
    @foreach ($pins as $pin) 
        @foreach ($articles as $category => $article)
            @foreach ($article as $item)
                @if ($pin == $item['id'])
                <li>
                <p>
                    Title: {{ $item['title'] }}<br />
                    Link: <a href="{{ $item['url'] }}" target="_blank">{{ $item['url'] }}</a><br>
                    Published: {{ $item['date'] }}
                </p>
                </li>
                @endif
            @endforeach
        @endforeach
    @endforeach
    </ul>
</div>