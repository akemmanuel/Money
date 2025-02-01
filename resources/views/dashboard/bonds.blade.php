<x-app-layout>
    <div class="p-3">
        <div class="flex justify-between items-center mb-2">
            <div>
                <h1 class="text-2xl font-semibold">Anleihen</h1>
            </div>
            <div>
                <button class="btn btn-primary">Anleihe hinzufügen</button>
            </div>
        </div>
        <p class="mb-3">Noch keine Anleihen</p>
        <img src="{{ Vite::asset('resources/images/bonds.svg') }}"/>

        @livewire('bank-account')
    </div>
</x-app-layout>