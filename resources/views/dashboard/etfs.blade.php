<x-app-layout>
    <div class="p-3">
        <div class="flex justify-between items-center mb-2">
            <div>
                <h1 class="text-2xl font-semibold text-base-content">ETFs</h1>
            </div>
            <div>
                <button class="btn btn-primary">ETF hinzufügen</button>
            </div>
        </div>
        <p class="mb-3">Noch keine ETF hinterlegt</p>
        <img src="{{ Vite::asset('resources/images/etfs.svg') }}"/>

        @livewire('bank-account')
    </div>
</x-app-layout>