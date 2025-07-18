
<div class="p-4">
    <div class="flex justify-between items-center mb-2 flex-wrap">
        <div>
            <p class="font-semibold/80">Good day, {{ Auth::user()->name }}</p>
            <h1 class="text-2xl font-semibold mb-2">Dashboard</h1>
        </div>
        <div class="flex items-center gap-3 flex-wrap">
            <button class="btn btn-primary btn-soft btn-lg">
                <span class="icon-[tabler--share] size-5"></span> Share
            </button>
            <button class="btn btn-primary btn-soft btn-lg">
                <span class="icon-[tabler--circle-plus] size-5"></span> Add
            </button>
            <nav class="tabs bg-base-200 rounded-field space-x-1 overflow-x-auto p-1 rtl:space-x-reverse flex-wrap"
                aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                <button type="button"
                    class="btn btn-text active-tab:bg-primary active-tab:text-white hover:text-primary active hover:bg-transparent"
                    id="tabs-segment-item-1" data-tab="#tabs-segment-1" aria-controls="tabs-segment-1"
                    role="tab" aria-selected="true">
                    1W
                </button>
                <button type="button"
                    class="btn btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent"
                    id="tabs-segment-item-2" data-tab="#tabs-segment-2" aria-controls="tabs-segment-2"
                    role="tab" aria-selected="false">
                    1M
                </button>
                <button type="button"
                    class="btn btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent"
                    id="tabs-segment-item-3" data-tab="#tabs-segment-3" aria-controls="tabs-segment-3"
                    role="tab" aria-selected="false">
                    YTD
                </button>
                <button type="button"
                    class="btn btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent"
                    id="tabs-segment-item-4" data-tab="#tabs-segment-4" aria-controls="tabs-segment-4"
                    role="tab" aria-selected="false">
                    1J
                </button>
                <div class="tooltip">
                    <button type="button"
                        class="btn blur-xs btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent"
                        id="tabs-segment-item-5" data-tab="#tabs-segment-5" aria-controls="tabs-segment-5"
                        role="tab" aria-selected="false" disabled>
                        3J
                    </button>
                    <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <span class="tooltip-body tooltip-primary">PLUS</span>
                    </span>
                </div>
                <div class="tooltip">
                    <button type="button"
                        class="btn blur-xs btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent"
                        id="tabs-segment-item-6" data-tab="#tabs-segment-6" aria-controls="tabs-segment-6"
                        role="tab" aria-selected="false" disabled>
                        5J
                    </button>
                    <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <span class="tooltip-body tooltip-primary">PLUS</span>
                    </span>
                </div>
                <div class="tooltip">
                    <button type="button"
                        class="btn blur-xs btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent"
                        id="tabs-segment-item-7" data-tab="#tabs-segment-7" aria-controls="tabs-segment-7"
                        role="tab" aria-selected="false" disabled>
                        MAX
                    </button>
                    <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <span class="tooltip-body tooltip-primary">PLUS</span>
                    </span>
                </div>
            </nav>
        </div>
    </div>

    <div class="p-4">

        <div class="flex gap-3 items-center justify-center flex-wrap">

            <div id="apex-doughnut-chart"></div>
            <div class="grow">
                <div id="apex-curved-area-charts" class="w-full"></div>

            </div>
        </div>
        <div class="flex gap-3 items-center justify-between">
            <div class="text-center">
                <p class="text-sm font-normal">Current Assets</p>
                <div class="mt-1">

                    <p class="text-xl font-semibold">
                        <span>
                            {{ number_format($this->getTotalValue(), 2) }} {{ Auth::user()->display_currency }}
                            <span class="badge badge-soft badge-success badge-xl">+12% <span class="icon-[tabler--caret-up-filled] size-6">
                            </span>
                        </span>
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <p class="text-sm font-normal">Cash</p>
                        <div class="mt-1">
                            <p class="text-lg font-semibold">0,97€</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-normal">Holdings</p>
                        <p class="text-lg font-semibold">0,03€</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-normal">Capital Gain</p>
                        <div class="mt-1">
                            <p class="text-lg font-semibold">-0,000446€</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-normal">Internal Rate of Return</p>
                        <div class="mt-1">
                            <p class="text-lg font-semibold">0%</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-normal">Dividends</p>
                        <div class="mt-1">
                            <p class="text-lg font-semibold">0,00€</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-normal">Realized Gains</p>
                        <div class="mt-1">
                            <p class="text-lg font-semibold">0,00€</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($depots as $depot)
        <h1 class="text-2xl font-semibold">{{ $depot->name }}</h1>
        <div class="overflow-x-auto rounded-lg border border-base-content/25">
            <table class="min-w-full divide-y-2 divide-base-content/25">
                <thead class="text-left">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-2 font-medium">Name</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium">Quantity</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium">Total Value</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium">Change</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium">Allocation</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-base-content/25">
                    @foreach ($depot->assets as $asset)
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2 font-medium">{{ $asset->name }}</td>
                        <td class="whitespace-nowrap px-4 py-2">{{ $asset->balance }}</td>
                        <td class="whitespace-nowrap px-4 py-2">{{ number_format($this->convert($asset->balance, $asset->currency, $asset->type_of_currency), 2) }} {{ Auth::user()->display_currency }}</td>
                        <td class="whitespace-nowrap px-4 py-2">
                            @php
                                $change = $this->getChange($asset);
                                $status = $change['status'];
                            @endphp

                            @if ($status === 'no_data')
                                <span class="badge badge-soft badge-secondary">N/A</span>
                            @elseif ($status === 'new')
                                <span class="badge badge-soft badge-info">New</span>
                            @elseif ($status === 'no_change')
                                <span class="badge badge-soft badge-secondary">No Change</span>
                            @else
                                @php
                                    $changeValue = $change['value'];
                                    $percentageChange = $change['percentage'];
                                    $isPositive = $changeValue > 0;
                                @endphp
                                <p class="text-base font-semibold">
                                    <span @class([
                                        'badge',
                                        'badge-soft',
                                        'badge-success' => $isPositive,
                                        'badge-danger' => !$isPositive,
                                    ])>
                                        {{ number_format($changeValue, 2) }} {{ Auth::user()->display_currency }}
                                        ({{ number_format($percentageChange, 2) }}%)
                                        <span @class([
                                            'icon-[tabler--caret-up-filled]' => $isPositive,
                                            'icon-[tabler--caret-down-filled]' => !$isPositive,
                                            'size-6',
                                        ])></span>
                                    </span>
                                </p>
                            @endif
                        </td>
                            <td class="whitespace-nowrap px-4 py-2">
                                @php
                                    $totalDepotValue = 0;
                                    foreach ($depot->assets as $a) {
                                        $totalDepotValue += $this->convert($a->balance, $a->currency, $a->type_of_currency);
                                    }
                                    $assetValue = $this->convert($asset->balance, $asset->currency, $asset->type_of_currency);
                                    $allocation = $totalDepotValue > 0 ? ($assetValue / $totalDepotValue) * 100 : 0;
                                @endphp
                                {{ number_format($allocation, 2) }}%
                            </td> </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>