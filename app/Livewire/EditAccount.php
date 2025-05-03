<?php

namespace App\Livewire;

use App\Models\Fiat;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditAccount extends Component
{
    public $account;
    public $transactions;
    public $transactionType;
    public $transactionName;
    public $transactionAmount;
    public $transactionDescription;
    public $depots = [];
    public $depot;

    public function mount($id)
    {
        $this->depots = Auth::user()->depots;

        $this->account = Auth::user()->depots->load('assets')->pluck('assets')->flatten()->firstWhere('id', $id);
        if ($this->account) {
            $this->transactions = $this->account->transactions()->orderBy('created_at', 'asc')->get();
        } else {
            abort(404, 'Account not found.');
        }
    }
    public function updateDepot()
    {
        if (!$this->account) {
            abort(404, 'Account not found.');
        }
        $this->account->update(['depot_id' => $this->depot]);
        session()->flash('message', 'Depot updated successfully.');
    }

    public function render()
    {
        return view('livewire.edit-account');
    }

    public function submitTransaction()
    {
        $this->validate([
            'transactionType' => 'required|in:increase,decrease',
            'transactionAmount' => 'required|numeric|min:0',
            'transactionName' => 'required|string|max:255',
            'transactionDescription' => 'nullable|string|max:255',
        ]);
        $this->account->transactions()->create([
            'amount' => $this->transactionAmount,
            'type' => $this->transactionType,
            'title' => $this->transactionName,
            'description' => $this->transactionDescription,
        ]);
        $this->account->balance = $this->transactionType === 'increase'
            ? $this->account->balance + $this->transactionAmount
            : $this->account->balance - $this->transactionAmount;
        $this->account->save();
        session()->flash('message', 'Transaction created successfully.');
        $this->reset(['transactionName', 'transactionAmount', 'transactionDescription']);
    }

    public function deleteTransaction($transactionId)
    {
        $transaction = $this->account->transactions()->find($transactionId);
        if ($transaction) {
            $this->account->balance = $this->account->balance - $transaction->amount;
            $this->account->save();
            $transaction->delete();
            session()->flash('message', 'Transaction deleted successfully.');
        } else {
            session()->flash('error', 'Transaction not found.');
        }
    }
    public function deleteAccount()
    {
        $this->account->delete();
        session()->flash('message', 'Account deleted successfully.');
        return redirect()->route('portfolio');
    }
    public function convert($balance, $currency, $type)
    {
        $currency_user =  Auth::user()->display_currency;
        if ($currency_user == $currency) {
            return $balance;
        }
        $price = new Price();
        $priceUsd = $price->getPriceUsd($currency, $type) * $balance;
        $fiat = new Fiat();
        $end = $fiat->usdTo($currency_user) * $priceUsd;

        return $end;
    }
}
