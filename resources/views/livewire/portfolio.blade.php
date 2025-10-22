<div class="container mx-auto p-6">
    @if ($depots->isNotEmpty())
        <div class="mt-6 text-center">
            <h2 class="text-3xl font-bold">Total Portfolio Value</h2>
            <div class="text-4xl font-extrabold text-green-500 mt-2">
                {{ number_format($this->getTotalValue(), 2) }} {{ Auth::user()->display_currency }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            @foreach ($depots as $depot)
                <div class="shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4 truncate">{{ $depot->name }}</h3>
                    <div class="text-lg font-medium mb-4">
                        Total Balance: 
                        <span class="text-2xl font-bold">
                            {{ number_format($depot->assets->sum(function($asset) {
                                return $this->convert($asset->balance, $asset->currency, $asset->type_of_currency);
                            }), 2) }} {{ Auth::user()->display_currency }}
                        </span>
                    </div>
                    @foreach ($depot->assets as $asset)
                        <ul class="divide-base-content/25 divide-y *:py-3">
                                <li class="flex items-center gap-4">
                                    <a href="{{ route('account.edit', ['id' => $asset->id]) }}" class="flex items-center gap-4">
                                        <div class="relative inline-flex">
                                            <div class="bg-neutral text-neutral-content w-10 rounded-full p-2">
                                                @if ($asset->type_of_currency === 'fiats')
                                                    <span class="icon-[tabler--cash-banknote] size-full"></span>
                                                @elseif ($asset->type_of_currency === 'crypto')
                                                    <span class="icon-[tabler--currency-bitcoin] size-full"></span>
                                                @elseif ($asset->type_of_currency === 'stocks')
                                                    <span class="icon-[tabler--trending-up] size-full"></span>
                                                @elseif ($asset->type_of_currency === 'commodities')
                                                    <span class="icon-[tabler--drop-circle] size-full"></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-lg font-medium">{{ $asset->name }}</p>
                                            <p class="text-2xl font-bold mt-1">
                                                {{ number_format($this->convert($asset->balance, $asset->currency, $asset->type_of_currency), 2) }} {{ Auth::user()->display_currency }}
                                            </p>
                                        </div>
                                    </a>
                                </li>
                        </ul>
                    @endforeach
                    @if ($depot->assets->isEmpty())
                        <div class="alert alert-soft alert-warning mt-4 text-center p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex flex-col items-center gap-2">
                                <span class="icon-[tabler--info-circle] size-6 text-yellow-500"></span>
                                <p class="text-sm text-yellow-800">This depot has no assets yet. Add your first asset to start building your portfolio.</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-soft alert-primary mt-8 text-center p-6 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex flex-col items-center gap-4">
                <span class="icon-[tabler--alert-triangle] size-8 text-blue-500"></span>
                <h3 class="text-xl font-semibold text-blue-800">Your portfolio is empty</h3>
                <p class="text-gray-600">Add your first asset and start building your portfolio.</p>
                <a href="{{ route('create_bitcoin_account') }}" class="btn btn-primary mt-4 px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                    Add Asset
                </a>
            </div>
        </div>
    @endif
</div>
