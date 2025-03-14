<x-app-layout>
    <div class="p-3">
        <div class="flex justify-between items-center mb-2">
            <div>
                <h1 class="text-2xl font-semibold text-base-content">Kryptowährungen</h1>
            </div>
            <div>
                <a class="btn btn-warning" href="{{ route("create_crypto") }}">Cryptoasset hinzufügen</a>
            </div>
        </div>
        <livewire:crypto lazy />
    </div>
</x-app-layout>