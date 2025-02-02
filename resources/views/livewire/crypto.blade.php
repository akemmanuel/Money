<div>
    <div class="mt-6">
        <h2 class="text-xl font-semibold">Gesamtwert</h2>
        <div class="text-2xl mb-1 text-green-500">
            <span class="currency-usd">{{ round($cryptos->sum(fn($asset) => $asset->balance * $prices_usd[$asset["currency"]]), 2) }} $</span>
            <span class="currency-eur">{{ round($cryptos->sum(fn($asset) => $asset->balance * $prices_eur[$asset["currency"]]), 2) }} €</span>
        </div>
    </div>
    @if($cryptos->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($cryptos as $asset)
                            <div class="bg-white shadow-md rounded-lg p-4">
                                    <div class="text-lg font-semibold">{{ $asset->name }}</div>
                                    <div class="text-2xl mb-1 {{ $asset->balance > 0 ? 'text-green-500' : 'text-red-500' }}">
                                            <span class="currency-usd ">{{ round($asset->balance * $prices_usd[$asset["currency"]], 2) }} $</span>
                                            <span class="currency-eur">{{ round($asset->balance * $prices_eur[$asset["currency"]], 2) }} €</span>
                                    </div>
                                    <div class="text-sm text-gray-500">21% ↗︎ than last month</div>
                            </div>
                    @endforeach
            </div>
    @else
            <p class="mb-3 text-gray-700">Noch keine Cryptowährungen</p>
            <img src="{{ Vite::asset('resources/images/crypto2.svg') }}" class="w-full h-auto"/>
    @endif
    <div class="flex flex-row justify-center gap-3">
        <div class="flex-grow">
            <h2 class="text-2xl">Preise in USD</h2>
            <div class="flex flex-wrap gap-2 justify-center">
                @foreach ($prices_usd as $currency => $price)
                    <div class="bg-white shadow-md rounded-lg p-4 flex-grow">
                        <div class="text-lg font-semibold">1 {{ $currency }} USD</div>
                        <div class="text-2xl mb-1">{{ $price }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex-grow">
            <h2 class="text-2xl">Preise in EUR</h2>
            <div class="flex flex-wrap gap-2 justify-center">
                @foreach ($prices_eur as $currency => $price)
                    <div class="bg-white shadow-md rounded-lg p-4 flex-grow">
                        <div class="text-lg font-semibold">1 {{ $currency }} EUR</div>
                        <div class="text-2xl mb-1">{{ $price }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>