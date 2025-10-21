<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Ask Gemini about Finance</h2>

    <form wire:submit.prevent="submitQuestion" class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="mb-4">
            <label for="question" class="block text-gray-700 text-sm font-bold mb-2">Your Question:</label>
            <textarea id="question" wire:model="question" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="e.g., What is a stock split? or Give me a quick market summary."></textarea>
            @error('question') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Ask Gemini
            </button>
        </div>
    </form>

    @if ($answer)
        <div class="bg-gray-100 shadow-md rounded-lg p-6">
            <h3 class="text-xl font-bold mb-4">Gemini's Answer:</h3>
            <p class="text-gray-800">{{ $answer }}</p>
        </div>
    @endif
</div>
