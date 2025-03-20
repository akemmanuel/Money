<div class="p-3">
    <div class="flex justify-between items-center mb-2">
        <div>
            <h1 class="text-2xl font-semibold text-base-content">Add bitcoin account</h1>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="" data-theme="mytheme">
        <form wire:submit.prevent="create">
            <div class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-grow">
                    <label class="label label-text font-medium" for="name">Name</label>
                    <input
                        type="text"
                        placeholder="Name eingeben"
                        class="input input-bordered w-full focus:input-primary"
                        id="name"
                        wire:model="name"
                    />
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex-grow">
                    <label class="label label-text font-medium" for="balance">Current Balance</label>
                    <div class="input-group">
                        <input
                            type="number"
                            placeholder="0.000000000"
                            class="input grow input-bordered w-full focus:input-primary"
                            id="balance"
                            wire:model="balance"
                            step="0.000000001"
                        />
                        <label class="sr-only" for="balance">Enter amount</label>
                        <span class="input-group-text">BTC</span>
                    </div>
                    @error('balance')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- Submit Button -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="btn btn-primary hover:btn-primary-focus transition"
                >
                    Add Account
                </button>
            </div>
        </form>
    </div>
</div>
