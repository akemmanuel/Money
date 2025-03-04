<div>
    @if($accounts->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($accounts as $account)
            <div class="flex items-end justify-between rounded-lg border border-gray-100 bg-white p-6">
                <div class="flex items-center gap-4">
                    <div class="relative inline-flex">
                        <div class="bg-neutral text-neutral-content w-10 rounded-full p-2">
                            <span class="icon-[tabler--cash-banknote] size-full"></span>
                        </div>
                    </div>

                <div>
                    <p class="text-sm text-gray-500">{{ $account->name }}</p>
                    <p class="text-2xl font-medium text-gray-900">{{ $account->balance }}</p>
                </div>
                </div>

                <div class="inline-flex gap-2 rounded-sm {{ $account->balance > 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} p-1">
                <span class="icon-[tabler--trending-up]"></span>

                <span class="text-xs font-medium"> 21% </span>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <p class="mb-3">Noch keine Konten hinterlegt</p>
        <img src="{{ Vite::asset('resources/images/bank.svg') }}"/>
    @endif
</div>
