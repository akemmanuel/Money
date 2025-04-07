<x-app-layout>
    <div class="p-3">
        <div class="flex justify-between items-center mb-2">
            <div>
                <h1 class="text-2xl font-semibold">Investmentfonds</h1>
            </div>
            <div>
                <button class="btn btn-primary">Investmentfond hinzufügen</button>
            </div>
        </div>
        <p class="mb-3">Noch keine Investmentfonds</p>
        <img src="{{ Vite::asset('resources/images/mutual-funds.svg') }}"/>

        @livewire('bank-account')
    </div>
</x-app-layout>