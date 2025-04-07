<div class="p-3">
    <div class="flex justify-between items-center mb-2">
        <div>
            <h1 class="text-2xl font-semibold">Add account</h1>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="" data-theme="mytheme">
        <form wire:submit.prevent="create">
            <div>
                <div class="grow">
                    <label class="label label-text font-medium" for="name">Name <span class="text-red-600">*</span></label>
                    <input
                        type="text"
                        placeholder="Enter name"
                        class="input"
                        id="name"
                        wire:model="name"
                        maxlength="255"
                        required
                    />
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="grow">
                    <label class="label label-text font-medium" for="name">Description</label>
                    <textarea
                        placeholder="Enter a description"
                        class="textarea input-bordered w-full focus:input-primary"
                        id="name"
                        wire:model="description"
                        maxlength="255"
                    ></textarea>
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="grow">
                    <label class="label label-text font-medium" for="balance">Current Balance</label>
                    <div class="join">
                        <input
                            type="number"
                            placeholder="0.000000000"
                            class="input join-item"
                            id="balance"
                            wire:model="balance"
                            step="0.000000001"
                            required
                        />
                        <select
                            class="select join-item"
                            wire:model="type_of_currency"
                            required
                        >
                            <option value="" disabled>Select type of currency</option>
                            <option value="fiats">Fiats</option>
                            <option value="crypto">Cryptocurrency</option>
                            <option value="stocks">Stocks</option>
                            <option value="commodities">Commodities</option>
                            <option value="etfs">ETFs</option>
                            <option value="fiats">Fiats</option>

                        </select>
                        <input
                            type="text"
                            placeholder="Currency: e. g. BTC"
                            class="input join-item"
                            wire:model="currency"
                            required
                        />
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
