<div>
    <div class="mt-6">
        <h2 class="text-xl font-semibold">Gesamtwert</h2>
        <div class="text-2xl mb-1 text-green-500">
            <span
                class="currency-usd">{{ round($cryptos->sum(fn($asset) => $asset->balance * $prices_usd[$asset["currency"]]), 2) }}
                $</span>
            <span
                class="currency-eur">{{ round($cryptos->sum(fn($asset) => $asset->balance * $prices_eur[$asset["currency"]]), 2) }}
                €</span>
        </div>
    </div>
    @if($cryptos->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($cryptos as $asset)
                <div class="flex items-end justify-between rounded-lg border border-gray-100 bg-white p-6">
                    <div class="flex items-center gap-4">
                        <div class="relative inline-flex">
                            <div class="bg-neutral text-neutral-content w-10 rounded-full p-2">
                                <span class="icon-[tabler--cash-banknote] size-full"></span>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">{{ $asset->name }}</p>
                            <p class="text-2xl font-medium text-gray-900">
                                <span
                                    class="currency-usd">{{ round($asset->balance * $prices_usd[$asset["currency"]], 2) }}
                                    $</span>
                                <span
                                    class="currency-eur">{{ round($asset->balance * $prices_eur[$asset["currency"]], 2) }}
                                    €</span>
                            </p>
                        </div>
                    </div>
                    <div
                        class="inline-flex gap-2 rounded-sm {{ $asset->balance > 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} p-1">
                        <span class="icon-[tabler--trending-up]"></span>
                        <span class="text-xs font-medium"> 21% </span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="mb-3 text-gray-700">Noch keine Cryptowährungen</p>
        <img src="{{ Vite::asset('resources/images/crypto2.svg') }}" class="w-full h-auto" />
    @endif
    <div class="flex gap-2">
        <div class="flex-grow">
            <h2 class="text-xl font-semibold mt-6">Aktuelle Kurse USD</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                @foreach($prices_usd as $currency => $price)
                    <div class="flex items-end justify-between rounded-lg border border-gray-100 bg-white p-6">
                        <div class="flex items-center gap-4">
                            <div class="relative inline-flex">
                                <div class="bg-neutral text-neutral-content w-10 rounded-full p-2">
                                    <span class="icon-[tabler--trending-up] size-full"></span>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">1 {{ $currency }} USD</p>
                                <p class="text-2xl font-medium text-gray-900">{{ $price }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex-grow">
            <h2 class="text-xl font-semibold mt-6">Aktuelle Kurse EUR</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                @foreach($prices_eur as $currency => $price)
                    <div class="flex items-end justify-between rounded-lg border border-gray-100 bg-white p-6">
                        <div class="flex items-center gap-4">
                            <div class="relative inline-flex">
                                <div class="bg-neutral text-neutral-content w-10 rounded-full p-2">
                                    <span class="icon-[tabler--trending-up] size-full"></span>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">1 {{ $currency }} EUR</p>
                                <p class="text-2xl font-medium text-gray-900">{{ $price }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
