<x-app-layout>
    <div class="p-3">
        <div class="flex justify-between items-center mb-2">
            <div>
                <h1 class="text-2xl font-semibold text-base-content">Konten</h1>
            </div>
            <div>
                <a class="btn btn-warning" wire:navigate href="{{ route("create_bank_account") }}">Aktivität hinzufügen</a>

                <a class="btn btn-warning" wire:navigate href="{{ route("create_bank_account") }}">Konto hinzufügen</a>
            </div>
        </div>
        <livewire:bank-account lazy/>
    </div>
</x-app-layout>