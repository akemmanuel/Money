<div class="text-base-content">
    @if (session()->has('message'))
        <div class="alert alert-success shadow-lg mb-4">
            <div>
                <span>{{ session('message') }}</span>
            </div>
        </div>
    @endif
    <div class="flex justify-between items-center mb-2">
        <div>
            <h1 class="text-2xl font-semibold text-base-content">{{$account->name}}</h1>
        </div>
    </div>
        <p class="text-sm text-gray-600 mb-2">{{$account->description}}</p>

        <div class="mt-4">
            @if ((Auth::user()->display_currency == $account->currency && $account->type_of_currency == 'fiats') || 
                 (Auth::user()->display_currency == 'BTC' && $account->type_of_currency == 'crypto' && $account->currency == 'BTC'))
                <p><span class="font-semibold">Balance:</span> {{$account->balance}}{{$account->currency}}</p>
            @else
                <p><span class="font-semibold">Balance:</span> {{$account->balance}}{{$account->currency}}, {{ number_format($this->convert($account->balance, $account->currency, $account->type_of_currency), 2) }} {{ Auth::user()->display_currency }}</p>
            @endif

            <p><span class="font-semibold">Type of Currency:</span> {{$account->type_of_currency}}</p>
        </div>
<div>
<h1 class="text-2xl font-bold mt-6 mb-4">Add Transacion</h1>
<input class="input input-bordered w-full mb-4" type="text" placeholder="Transaction Name" wire:model="transactionName">
<input class="input input-bordered w-full mb-4" type="text" placeholder="Transaction Description" wire:model="transactionDescription">
<input class="input input-bordered w-full mb-4" type="number" step="0.000000000000000000001" placeholder="Transaction Amount in {{$account->currency}}" wire:model="transactionAmount">

<button class="btn btn-success" wire:click="increase">Increase</button>

<button class="btn btn-danger" wire:click="decrease">Decrease</button>
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
                        <button class="btn btn-error" wire:click="deleteTransaction({{ $transaction->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
