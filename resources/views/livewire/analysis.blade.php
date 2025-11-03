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
            <div class="mt-4">
                <div class="flex items-center gap-4">
                    <span class="text-2xl font-bold">Quality</span>
                    <div class="flex w-full flex-col gap-1">
                        <span class="progress-label">{{ $analysisResult->qualitypercentage }}</span>
                        <div class="progress h-4" role="progressbar" aria-label="Portfolio Quality"
                             aria-valuenow="{{ $analysisResult->qualitypercentage }}" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: {{ round($analysisResult->qualitypercentage) }}%"></div>
                        </div>
                    </div>
                    <span class="text-2xl font-bold">Diversification</span>
                    <div class="flex w-full flex-col gap-1">
                        <span class="progress-label">{{ $analysisResult->diversificationpercentage }}</span>
                        <div class="progress h-4" role="progressbar" aria-label="Diversification"
                             aria-valuenow="{{ $analysisResult->diversificationpercentage }}" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: {{ round($analysisResult->diversificationpercentage) }}%"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h3 class="text-lg font-semibold">Summary & Risk Assessment</h3>
                    <p>{{ $analysisResult->summary }}</p>
                    <p>Risk: {{ $analysisResult->risk }}</p>
                </div>
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
            </div>
        @endif
    @endif
</div>