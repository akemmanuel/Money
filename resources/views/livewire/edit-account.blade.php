<div class="text-base-content">
    <div class="card bg-base-200 shadow-md p-6">
    
        <h2 class="text-xl font-bold mb-4">{{$account->name}}</h2>
        <p class="text-sm text-gray-600 mb-2">{{$account->description}}</p>
        
        <div class="flex space-x-4 mt-4">
            <button class="btn btn-secondary">Movement</button>
            <button class="btn btn-accent">Edit</button>
        </div>
        <div class="mt-4">
            <p><span class="font-semibold">Currency:</span> {{$account->currency}}</p>
            <p><span class="font-semibold">Balance:</span> {{$account->balance}}</p>
            <p><span class="font-semibold">Type of Currency:</span> {{$account->type_of_currency}}</p>
        </div>
    </div>

</div>
