<div>
    @if (session()->has('message'))
        <div class="alert alert-success shadow-lg mb-4">
            <div>
                <span>{{ session('message') }}</span>
            </div>
        </div>
    @endif

    <div class="flex justify-between items-center mb-2">
        <div>
            <h1 class="text-2xl font-semibold">{{ $account->name }}</h1>
        </div>
        <button class="btn btn-error btn-soft" wire:click="deleteAccount">
            <span class="icon-[tabler--trash] size-5"></span> Delete Account
        </button>
    </div>

    <p class="text-sm text-gray-600 mb-2">{{ $account->description }}</p>

    <div class="mt-4">
        @if (
            (Auth::user()->display_currency == $account->currency && $account->type_of_currency == 'fiats') ||
            (Auth::user()->display_currency == 'BTC' && $account->type_of_currency == 'crypto' && $account->currency == 'BTC')
        )
            <p>
                <span class="font-semibold">Balance:</span> {{ $account->balance }}{{ $account->currency }}
            </p>
        @else
            <p>
                <span class="font-semibold">Balance:</span> {{ $account->balance }}{{ $account->currency }},
                {{ number_format($this->convert($account->balance, $account->currency, $account->type_of_currency), 2) }}
                {{ Auth::user()->display_currency }}
            </p>
        @endif

        <p>
            <span class="font-semibold">Type of Currency:</span> {{ $account->type_of_currency }}
        </p>
    </div>

    <div>
        <form wire:submit.prevent="submitTransaction">
            <h1 class="text-2xl font-bold mt-6 mb-4">Add Transaction</h1>
            <div class="join drop-shadow mb-3">
                <input
                    class="join-item btn checked:!bg-error btn-soft"
                    type="radio"
                    name="transactionType"
                    value="decrease"
                    wire:model="transactionType"
                    aria-label="Decrease"
                    required
                />
                <input
                    class="join-item btn checked:!bg-success btn-soft"
                    type="radio"
                    name="transactionType"
                    value="increase"
                    wire:model="transactionType"
                    aria-label="Increase"
                    required
                />
            </div>
            @error('transactionType')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <div class="mb-3">
            <input
                class="input input-bordered w-full"
                type="text"
                placeholder="Transaction Name"
                wire:model="transactionName"
                required
            />
            @error('transactionName')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            </div>
            <div class="mb-3">
            <input
                class="input input-bordered w-full"
                type="text"
                placeholder="Transaction Description"
                wire:model="transactionDescription"
                required
            />
            @error('transactionDescription')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            </div>
            <div class="mb-3">
            <input
                class="input input-bordered w-full"
                type="number"
                step="0.000000000000000000001"
                placeholder="Transaction Amount in {{ $account->currency }}"
                wire:model="transactionAmount"
                required
            />
            {{-- <div class="input max-w-sm" data-input-number='{ "step": 0.5
                , "min": 0, "max": 100 }'>
                <input type="text" value="0" aria-label="Step control" data-input-number-input />
                <span class="my-auto flex gap-3">
                  <button type="button" class="btn btn-primary btn-soft size-5.5 min-h-0 rounded-sm p-0" aria-label="Decrement button" data-input-number-decrement >
                    <span class="icon-[tabler--minus] size-3.5 shrink-0"></span>
                  </button>
                  <button type="button" class="btn btn-primary btn-soft size-5.5 min-h-0 rounded-sm p-0" aria-label="Increment button" data-input-number-increment >
                    <span class="icon-[tabler--plus] size-3.5 shrink-0"></span>
                  </button>
                </span>
            </div> --}}
            @error('transactionAmount')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            </div>
            <div class="flex justify-end">
            <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto mt-6">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Transaction Name</th>
                    <th>Transaction Description</th>
                    <th>Transaction Amount</th>
                    <th>Transaction Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->title }}</td>
                        <td>{{ $transaction->description }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->type }}</td>
                        <td>
                            <button
                                class="btn btn-error"
                                wire:click="deleteTransaction({{ $transaction->id }})"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
