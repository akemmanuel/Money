<x-app-layout>
    <div class="p-3">
        <div class="flex justify-between items-center mb-2">
            <div>
                <h1 class="text-2xl font-semibold">Portfolio</h1>
            </div>
            <div>
                <a class="btn btn-primary" href="{{ route("create_depot") }}">Create depot</a>
                <a class="btn btn-primary" href="{{ route("create_bitcoin_account") }}">Add asset</a>
            </div>
        </div>
        <livewire:portfolio lazy />
    </div>
</x-app-layout>