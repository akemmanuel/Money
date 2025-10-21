<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Gemini Portfolio Insights</h3>

    @if ($isLoading)
        <p class="text-gray-600 dark:text-gray-400">Generating insights...</p>
    @else
        <p class="text-gray-600 dark:text-gray-400">{{ $summary }}</p>
    @endif

    <button wire:click="generateSummary" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
        Refresh Insights
    </button>
</div>
