<div>
    @if($accounts->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($accounts as $account)
                <div class="stats max-sm:w-full">
                    <div class="stat">
                        <div class="stat-title">{{ $account->name }}</div>
                        <div class="stat-value mb-1 {{ $account->balance > 0 ? 'text-green-500' : 'text-red-500' }}">{{ $account->balance }}</div>
                        <div class="stat-desc">21% ↗︎ than last month</div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="mb-3">Noch keine Konten hinterlegt</p>
        <img src="{{ Vite::asset('resources/images/bank.svg') }}"/>
    @endif
</div>
