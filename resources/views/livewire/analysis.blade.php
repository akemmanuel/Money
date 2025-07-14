<div>
    @if($notifications->isNotEmpty())
        <ul
            class="border-base-content/25 divide-base-content/25 w-96 divide-y rounded-md border *:p-3 *:first:rounded-t-md *:last:rounded-b-md">
            @foreach($notifications as $notification)
                <li>
                    <div class="stat-title">{{ $notification->title }}</div>
                    <div class="stat-value mb-1">{{ $notification->message }}</div>
                    <div class="stat-desc">21% ↗︎ than last month</div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-soft alert-primary flex items-start gap-4">
            <div class="flex flex-col">
                <div>
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center gap-2"><span class="icon-[tabler--info-circle] shrink-0 size-6"></span>
                        <h5 class="text-lg font-semibold">Want to get your Portfolio analysed by a professional?</h5></div>
                        <ul class="mt-1.5 list-inside list-disc">
                            <li>Get complete research on how to improve your portfolio</li>
                            <li>Receive personalized recommendations tailored to your goals</li>
                            <li>Understand the risks and opportunities in your investments</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-4 flex gap-2">
                    <button type="button" class="btn btn-primary btn-sm">Upgrade</button>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary mt-4 flex items-center gap-2" wire:click="analyze" wire:loading.attr="disabled">
            <span wire:loading wire:target="analyze" class="animate-spin inline-block size-4 border-2 border-t-transparent border-current rounded-full"></span>
            <span>Analyze Portfolio</span>
        </button>
        @if($analysisResult)
            Summary: {{ $analysisResult->summary ?? 'No analysis available yet.' }}
            <div class="mt-4">
                <h3 class="text-lg font-semibold">Recommendations:</h3>
                <ul class="border-base-content/25 divide-base-content/25 divide-y rounded-md border *:p-3 *:first:rounded-t-md *:last:rounded-b-md">
                    @if(isset($analysisResult->recommendations) && count($analysisResult->recommendations))
                        @foreach($analysisResult->recommendations as $recommendation)
                            <li>{{ $recommendation }}</li>
                        @endforeach
                    @else
                        <li>No recommendations available yet.</li>
                    @endif
                </ul>
            </div>
            <div class="flex w-52 flex-col gap-1">
            <span class="progress-label ms-[calc(25%-1.25rem)]">25%</span>
            <div class="progress h-2" role="progressbar" aria-label="25% Progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar w-1/4"></div>
            </div>
            </div>
            Quality of portfolio: {{ $analysisResult->quality ?? 'No quality assessment available yet.' }}
        @endif
    @endif
    {{-- <div class="flex w-52 flex-col gap-1">
    <span class="progress-label ms-[calc(55%-1.25rem)]">Good</span>
    <div class="progress h-2" role="progressbar" aria-label="Good Progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
    <div class="progress-bar w-[55%]"></div>
    </div>
    </div> --}}
</div>
