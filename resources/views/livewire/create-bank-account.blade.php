<div class="p-3">
    <div class="flex justify-between items-center mb-2">
        <div>
            <h1 class="text-2xl font-semibold">Konto hinzufügen</h1>
        </div>

    </div>
    @if (session()->has('message'))
    <div class="mb-4 p-4 rounded-md text-white bg-green-500">
        {{ session('message') }}
    </div>
@endif
@if (session()->has('error'))
    <div class="mb-4 p-4 rounded-md text-white bg-red-500">
        {{ session('error') }}
    </div>
@endif
<form wire:submit.prevent="create" x-data="{ name: @entangle('name').defer, nameError: '', balance: @entangle('balance').defer, balanceError: '' }">

    <div>
        <label class="label label-text font-medium" for="name">Name des Kontos</label>
        <input type="text" placeholder="Sparkasse Berlin" class="input" id="name" wire:model="name" x-model="name" x-on:input="nameError = name.trim() === '' ? 'Name is required.' : ''" />

        <span x-show="nameError" x-text="nameError" class="text-red-500 text-sm mt-1"></span>
    </div>
    <div>
        <label class="label label-text font-medium" for="amount">Betrag</label>
        <input type="number" placeholder="100" class="input" id="balance" wire:model="balance" x-model="balance" x-on:input="balanceError = balance === '' || isNaN(balance) ? 'Balance must be a number.' : ''" step="0.01" />
        <span class="label">
            <span class="label-text-alt">Please enter the amount</span>
        </span>
        <span x-show="balanceError" x-text="balanceError" class="text-red-500 text-sm mt-1"></span>
    </div>
    <div class="flex justify-end">
        <button type="submit" class="btn btn-primary hover:btn-primary-focus transition" wire:loading.attr="disabled" wire:target="create">
            <span wire:loading wire:target="create">Creating...</span>
            <span wire:loading.remove wire:target="create">Create Account</span>
        </button>
    </div>
</form>
</div>