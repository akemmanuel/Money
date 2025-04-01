<div>
    @if ($accounts->isNotEmpty())
        <div class="mt-6">
            <h2 class="text-xl font-semibold">Total value</h2>
            <div class="text-2xl mb-1 text-green-500">
                {{ number_format($this->getTotalValue(), 2) }} {{ Auth::user()->display_currency }}
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($accounts as $account)
                <a class="flex items-end justify-between rounded-lg border border-gray-100 bg-white p-6" href="{{ route('account.edit', $account->id) }}">
                    <div class="flex items-center gap-4">
                        <div class="relative inline-flex">
                            <div class="bg-neutral text-neutral-content w-10 rounded-full p-2">
                                @if ($account->type_of_currency === 'fiats')
                                    <span class="icon-[tabler--cash-banknote] size-full"></span>
                                @elseif ($account->type_of_currency === 'crypto')
                                    <span class="icon-[tabler--currency-bitcoin] size-full"></span>
                                @elseif ($account->type_of_currency === 'stocks')
                                    <span class="icon-[tabler--currency-dollar] size-full"></span>
                                @elseif ($account->type_of_currency === 'commodities')
                                    <span class="icon-[tabler--drop-circle] size-full"></span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">{{ $account->name }}</p>
                            <p class="text-base-content">{{ $account->type_of_currency }} {{$account->currency}}</p>
                            <p class="text-2xl font-medium text-gray-900">
                                {{ number_format($this->convert($account->balance, $account->currency, $account->type_of_currency), 2) }} {{ Auth::user()->display_currency }}
                            </p>
                        </div>
                    </div>
                    <div class="inline-flex gap-2 rounded-sm {{ $account->balance > 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} p-1">
                        <span class="icon-[tabler--trending-up]"></span>
                        <span class="icon-[tabler--trending-down]"></span>
                        <span class="text-xs font-medium"> Todo </span>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="alert alert-soft alert-primary" role="alert">
            <div class="flex items-center gap-2">
                <span class="icon-[tabler--alert-triangle] size-6"></span>
                <span class="text-lg font-semibold">You still don't have bitcoin?</span>
            </div>
            <div class="mt-4 flex gap-2">
                <a href="{{ route('create_bitcoin_account') }}" class="btn btn-primary">Add bitcoin</a>
            </div>
        </div>
    @endif
</div>
