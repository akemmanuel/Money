<x-app-layout>
    <div class="p-3">
        <div class="flex justify-between items-center mb-2">
            <div>
                <h1 class="text-2xl font-semibold">Immobilien</h1>
            </div>
            <div>
                <button class="btn btn-primary">Immobilie hinzufügen</button>
            </div>
        </div>
        <p class="mb-3">Noch keine Immobilie hinterlegt</p>
        <img src="{{ Vite::asset('resources/images/real-estate.svg') }}"/>

        @livewire('bank-account')
    </div>
</x-app-layout>