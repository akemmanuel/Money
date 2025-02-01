<div class="p-3">
    <div class="flex justify-between items-center mb-2">
        <div>
            <h1 class="text-2xl font-semibold">Konto hinzufügen</h1>
        </div>

    </div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<form wire:submit.prevent="create">

    <div>
        <label class="label label-text" for="name">Name des Kontos</label>
        <input type="text" placeholder="Sparkasse Berlin" class="input" id="name" wire:model="name" />

        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <div class="w-96">
        <label class="label label-text" for="amount">Betrag</label>
        <input type="number" placeholder="100" class="input" id="balance" wire:model="balance" step="0.01" />
        <span class="label">
            <span class="label-text-alt">Please enter the amount</span>
        </span>
        @error('balance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <div class="flex justify-end">
        <button type="submit" class="btn btn-primary">Konto erstellen</button>
    </div>
</form>
</div>