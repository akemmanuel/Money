<div class="container mx-auto p-6" wire:loading.class="opacity-50" wire:target="selectedRange, startDate, endDate, saveDepotName, editDepot">
        <div wire:loading wire:target="selectedRange, startDate, endDate, saveDepotName, editDepot" class="fixed inset-0 bg-black bg-opacity-20 flex items-center justify-center z-50">
            <div class="bg-white p-4 rounded-lg shadow-lg flex items-center">
                <svg class="animate-spin h-8 w-8 text-blue-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-lg font-medium">Updating...</span>
            </div>
        </div>
        <div class="mt-6 text-center">
            <h2 class="text-3xl font-bold">Total Portfolio Value</h2>
            <div class="text-4xl font-extrabold text-green-500 mt-2">
                {{ number_format($totalValue ?? 0, 2) }} {{ Auth::user()->display_currency }}
            </div>
            <div class="flex justify-center gap-4 mt-4">
                <div class="text-center">
                    <p class="text-lg font-medium">Daily Change</p>
                    <p class="text-xl font-bold @if(($dailyChange ?? 0) > 0) text-green-500 @elseif(($dailyChange ?? 0) < 0) text-red-500 @else text-gray-500 @endif">
                        {{ number_format($dailyChange ?? 0, 2) }} {{ Auth::user()->display_currency }} ({{ number_format($dailyPercentageChange ?? 0, 2) }}%)
                    </p>
                </div>
                <div class="text-center">
                    <p class="text-lg font-medium">Weekly Change</p>
                    <p class="text-xl font-bold @if(($weeklyChange ?? 0) > 0) text-green-500 @elseif(($weeklyChange ?? 0) < 0) text-red-500 @else text-gray-500 @endif">
                        {{ number_format($weeklyChange ?? 0, 2) }} {{ Auth::user()->display_currency }} ({{ number_format($weeklyPercentageChange ?? 0, 2) }}%)
                    </p>
                </div>
                <div class="text-center">
                    <p class="text-lg font-medium">Monthly Change</p>
                    <p class="text-xl font-bold @if(($monthlyChange ?? 0) > 0) text-green-500 @elseif(($monthlyChange ?? 0) < 0) text-red-500 @else text-gray-500 @endif">
                        {{ number_format($monthlyChange ?? 0, 2) }} {{ Auth::user()->display_currency }} ({{ number_format($monthlyPercentageChange ?? 0, 2) }}%)
                    </p>
                </div>
            </div>
            <div class="mt-6 flex justify-center gap-4">
                <a href="{{ route('transactions.create') }}" class="btn btn-primary px-6 py-3 text-white bg-blue-600 hover:bg-blue-700 rounded-lg" wire:loading.class="opacity-50" wire:loading.attr="disabled">
                    Add New Transaction
                </a>
                <a href="{{ route('depots.create') }}" class="btn btn-secondary px-6 py-3 text-white bg-gray-600 hover:bg-gray-700 rounded-lg" wire:loading.class="opacity-50" wire:loading.attr="disabled">
                    Create New Depot
                </a>
            </div>
        </div>

        <div class="mt-8">
            <div class="flex justify-end mb-4">
                <select wire:model="selectedRange" class="form-select rounded-md shadow-sm" wire:loading.attr="disabled">
                    <option value="7days">7 Days</option>
                    <option value="30days">30 Days</option>
                    <option value="3months">3 Months</option>
                    <option value="1year">1 Year</option>
                    <option value="all">All Time</option>
                    <option value="custom">Custom Range</option>
                </select>
                <div wire:loading wire:target="selectedRange" class="ml-2 flex items-center">
                    <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>

            @if ($selectedRange === 'custom')
                <div class="flex justify-end mb-4 space-x-2">
                    <input type="date" wire:model="startDate" class="form-input rounded-md shadow-sm" wire:loading.attr="disabled" />
                    <input type="date" wire:model="endDate" class="form-input rounded-md shadow-sm" wire:loading.attr="disabled" />
                    <div wire:loading wire:target="startDate, endDate" class="flex items-center">
                        <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            @endif
            <div class="shadow-lg rounded-lg p-6">
                <div wire:loading wire:target="selectedRange, startDate, endDate">
                    @include('placeholder.skeleton')
                </div>
                <div wire:loading.remove wire:target="selectedRange, startDate, endDate">
                    @if (empty($portfolioChart->dataset[0]['data']))
                        <div class="alert alert-soft alert-info mt-4 text-center p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex flex-col items-center gap-2">
                                <span class="icon-[tabler--info-circle] size-6 text-blue-500"></span>
                                <p class="text-sm text-blue-800">No portfolio history data available for the selected range.</p>
                            </div>
                        </div>
                    @else
                        {!! $portfolioChart->render() !!}
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            @foreach ($depots as $depot)
                <div class="shadow-lg rounded-lg p-6">
                    @if ($editingDepotId === $depot->id)
                        <div class="flex items-center gap-2">
                            <input type="text" wire:model.defer="editedDepotName" class="input input-sm" wire:loading.attr="disabled" wire:target="saveDepotName" />
                            <button wire:click="saveDepotName({{ $depot->id }})" class="btn btn-sm btn-primary" wire:loading.attr="disabled" wire:target="saveDepotName">
                                <span wire:loading.remove wire:target="saveDepotName">Save</span>
                                <span wire:loading wire:target="saveDepotName">Saving...</span>
                            </button>
                            <button wire:click="cancelEdit" class="btn btn-sm btn-ghost" wire:loading.attr="disabled" wire:target="saveDepotName">Cancel</button>
                        </div>
                        @error('editedDepotName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    @else
                        <h3 class="text-xl font-semibold truncate flex items-center justify-between">
                            {{ $depot->name }}
                            <button wire:click="editDepot({{ $depot->id }}, '{{ $depot->name }}')" class="btn btn-ghost btn-sm" wire:loading.attr="disabled" wire:target="editDepot">
                                <span wire:loading.remove wire:target="editDepot">
                                    <span class="icon-[tabler--edit] size-5"></span>
                                </span>
                                <span wire:loading wire:target="editDepot">
                                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                        </h3>
                    @endif
                    @if ($depot->description)
                        <p class="text-sm text-gray-500">{{ $depot->description }}</p>
                    @endif
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
                                <li class="flex items-center justify-between gap-4">
                                    <a href="{{ route('account.edit', ['id' => $asset->id]) }}" class="flex items-center gap-4">
                                        <div class="relative inline-flex">
                                            <div class="bg-neutral text-neutral-content w-10 rounded-full p-2">
                                                @if ($asset->type_of_currency === 'fiats')
                                                    <div class="tooltip" data-tip="Fiat Account">
                                                        <span class="icon-[tabler--cash-banknote] size-full"></span>
                                                    </div>
                                                @elseif ($asset->type_of_currency === 'crypto')
                                                    <div class="tooltip" data-tip="Crypto Asset">
                                                        <span class="icon-[tabler--currency-bitcoin] size-full"></span>
                                                    </div>
                                                @elseif ($asset->type_of_currency === 'stocks')
                                                    <div class="tooltip" data-tip="Stock Asset">
                                                        <span class="icon-[tabler--trending-up] size-full"></span>
                                                    </div>
                                                @elseif ($asset->type_of_currency === 'commodities')
                                                    <div class="tooltip" data-tip="Commodity Asset">
                                                        <span class="icon-[tabler--drop-circle] size-full"></span>
                                                    </div>
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
                                    <a href="{{ route('transactions.index', ['asset_id' => $asset->id]) }}" class="btn btn-sm btn-outline">View Transactions</a>
                                </li>
                        </ul>
                    @endforeach
                    @if ($depot->assets->isEmpty())
                        <div class="alert alert-soft alert-warning mt-4 text-center p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex flex-col items-center gap-2">
                                <span class="icon-[tabler--info-circle] size-6 text-yellow-500"></span>
                                <p class="text-sm text-yellow-800">This depot has no assets yet. Add your first asset to get started.</p>
                                <a href="{{ route('assets.create', ['depot_id' => $depot->id]) }}" class="btn btn-sm btn-warning mt-2">Add Asset to this Depot</a>
                            </div>
                        </div>
                    @endif
                </div>
            @empty
        <div class="alert alert-soft alert-primary mt-8 text-center p-6 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex flex-col items-center gap-4">
                <span class="icon-[tabler--alert-triangle] size-8 text-blue-500"></span>
                <h3 class="text-xl font-semibold text-blue-800">Your portfolio is empty!</h3>
                <p class="text-gray-600">Start building your financial overview by creating your first depot.</p>
                <a href="{{ route('depots.create') }}" class="btn btn-primary mt-4 px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                    Create Your First Depot
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>