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
    @endif
</div>
