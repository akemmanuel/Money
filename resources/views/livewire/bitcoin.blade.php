<div>
    @if ($accounts->isNotEmpty())
        <div class="mt-6">
            <h2 class="text-xl font-semibold">Total value</h2>
            <div class="text-2xl mb-1 text-green-500">
                {{-- <span
                    class="currency-usd">{{ round($accunts->sum(fn($account) => $account->balance * $bitcoin_usd), 2) }}
                    $</span>
                <span
                    class="currency-eur">{{ round($bitcoin_accounts->sum(fn($account) => $account->balance * $bitcoin_eur), 2) }}
                    €</span> --}}
                TODO: do this
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($accounts as $account)
                    <div
                        class="flex items
                    -end justify-between rounded-lg border border-gray-100 bg-white p-6">
                        <div class="flex items
                        -center gap-4">
                            <div class="relative inline-flex">
                                <div
                                    class="bg-neutral
                                text-neutral-content w-10 rounded-full p-2">
                                    <span class="icon-[tabler--cash-banknote] size-full"></span>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">{{ $account->name }}</p>
                                <p class="text-2xl font-medium text-gray-900">
                                    {{  $account->balance  }}

                                    <span
                                        class="currency-usd">{{ round($account->balance * $bitcoin_usd, 2) }}
                                        $</span>
                                    <span
                                        class="currency-eur">{{ round($account->balance * $bitcoin_eur, 2) }}
                                        €</span>
                                </p>
                            </div>
                        </div>
                        <div
                            class="inline-flex gap-2 rounded-sm {{ $account->balance > 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} p-1">
                            <span class="icon-[tabler--trending-up]"></span>
                            <span class="text-xs font-medium"> 21% </span>
                        </div>
                        <a href="{{ route('edit_bitcoin_account', $account->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                @endforeach
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
</div>
