<x-app-layout>
    <div class="p-3 text-base-content">
        <div class="flex justify-between items-center mb-2">
            <div>
                <h1 class="text-2xl font-semibold text-base-content">Account</h1>
            </div>
        </div>
        <livewire:edit-account lazy id={{$id}} />
    </div>
</x-app-layout>