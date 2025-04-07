<div>
    <h2 class="text-xl font-bold">Currency</h2>
    <div class="flex gap-2">
    <select class="select max-w-sm" wire:model="currency" wire:change="updateCurrency">
        <option value="EUR">Euro</option>
        <option value="USD">US Dollar</option>
        <option value="BTC">Bitcoin</option>
        <option value="PYG">Paraguayan Guarani</option>
        <option value="GBP">British Pound</option>
        <option value="JPY">Japanese Yen</option>
        <option value="AUD">Australian Dollar</option>
        <option value="CAD">Canadian Dollar</option>
        <option value="CHF">Swiss Franc</option>
        <option value="CNY">Chinese Yuan</option>
        <option value="INR">Indian Rupee</option>
        <option value="BRL">Brazilian Real</option>
        <option value="ZAR">South African Rand</option>
        <option value="MXN">Mexican Peso</option>
        <option value="SGD">Singapore Dollar</option>
    </select>
    <div wire:loading wire:target="updateCurrency" class="spinner-border text-primary" role="status">
        <span class="loading loading-spinner loading-lg"></span>
    </div>
</div>
</div>
