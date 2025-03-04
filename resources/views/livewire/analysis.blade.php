<div>
    @if($notifications->isNotEmpty())
        <ul class="border-base-content/25 divide-base-content/25 w-96 divide-y rounded-md border *:p-3 first:*:rounded-t-md last:*:rounded-b-md">
            @foreach($notifications as $notification)
            <li>
                <div class="stat-title">{{ $notification->title }}</div>
                <div class="stat-value mb-1">{{ $notification->message }}</div>
                <div class="stat-desc">21% ↗︎ than last month</div>
            </li>
            @endforeach
        </ul>
    @else
        <p class="mb-3">Noch keine Analysen</p>
        <img src="{{ Vite::asset('resources/images/bank.svg') }}"/>
    @endif
</div>
