<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Log New Transaction</h2>

    @if (session()->has('message'))
        <div class="alert alert-success mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="store" class="bg-base-200 shadow-lg rounded-lg p-6">
        <div class="mb-4">
            <label for="asset_id" class="block text-sm font-medium text-base-content">Asset</label>
            <select wire:model="asset_id" id="asset_id" class="mt-1 block w-full rounded-md border-base-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                <option value="">Select an Asset</option>
                @foreach ($assets as $asset)
                    <option value="{{ $asset->id }}">{{ $asset->name }} ({{ $asset->currency }})</option>
                @endforeach
            </select>
            @error('asset_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-base-content">Transaction Type</label>
            <select wire:model="type" id="type" class="mt-1 block w-full rounded-md border-base-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                <option value="buy">Buy</option>
                <option value="sell">Sell</option>
            </select>
            @error('type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-base-content">Title</label>
            <input type="text" wire:model="title" id="title" class="mt-1 block w-full rounded-md border-base-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-base-content">Description (Optional)</label>
            <textarea wire:model="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-base-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"></textarea>
            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="amount" class="block text-sm font-medium text-base-content">Amount</label>
            <input type="number" wire:model="amount" id="amount" step="0.01" class="mt-1 block w-full rounded-md border-base-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            @error('amount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="btn btn-primary px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                Log Transaction
            </button>
        </div>
    </form>
</div>