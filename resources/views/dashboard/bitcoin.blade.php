<x-app-layout>
    <div class="p-3">
        <div class="flex justify-between items-center mb-2">
            <div>
                <h1 class="text-2xl font-semibold text-base-content">Bitcoin</h1>
            </div>
            <div>
                <a class="btn btn-warning" href="{{ route("create_crypto") }}">Add bitcoin</a>
            </div>
        </div>
        <livewire:bitcoin lazy />
    </div>
</x-app-layout>