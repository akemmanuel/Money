<x-app-layout>
    <div class="p-3">
        <div class="flex justify-between items-center mb-2">
            <div>
                <h1 class="text-2xl font-semibold">Rohstoffe</h1>
            </div>
            <div>
                <button class="btn btn-primary">Rohstoff hinzufügen</button>
            </div>
        </div>
        <p class="mb-3">Noch keine Rohstoffe hinterlegt</p>
        <img src="{{ Vite::asset('resources/images/commodities.svg') }}" loading="lazy"/>

        @livewire('bank-account')
    </div>
</x-app-layout>