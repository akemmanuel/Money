<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
      <h1 class="text-xl font-semibold mb-2">Dashboard</h1>
      <nav class="tabs bg-base-200 rounded-btn w-fit space-x-1 overflow-x-auto p-1 rtl:space-x-reverse" aria-label="Tabs" role="tablist" aria-orientation="horizontal" >
        <button type="button" class="btn btn-text active-tab:bg-primary active-tab:text-white hover:text-primary active hover:bg-transparent" id="tabs-segment-item-1" data-tab="#tabs-segment-1" aria-controls="tabs-segment-1" role="tab" aria-selected="true" >
          1W
        </button>
        <button type="button" class="btn btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent" id="tabs-segment-item-2" data-tab="#tabs-segment-2" aria-controls="tabs-segment-2" role="tab" aria-selected="false" >
          1M
        </button>
        <button type="button" class="btn btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent" id="tabs-segment-item-3" data-tab="#tabs-segment-3" aria-controls="tabs-segment-3" role="tab" aria-selected="false" >
          1J
        </button>
        <button type="button" class="btn btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent" id="tabs-segment-item-3" data-tab="#tabs-segment-3" aria-controls="tabs-segment-3" role="tab" aria-selected="false" >
          3J
        </button>
        <button type="button" class="btn btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent" id="tabs-segment-item-3" data-tab="#tabs-segment-3" aria-controls="tabs-segment-3" role="tab" aria-selected="false" >
          5J
        </button>
        <button type="button" class="btn btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent" id="tabs-segment-item-3" data-tab="#tabs-segment-3" aria-controls="tabs-segment-3" role="tab" aria-selected="false" >
          MAX
        </button>
      </nav>
      
      <div class="mt-3">
        <div id="tabs-segment-1" role="tabpanel" aria-labelledby="tabs-segment-item-1">
          <p class="text-base-content/80">
            Welcome to the <span class="text-base-content font-semibold">Home tab!</span> Explore the latest updates and news here.
          </p>
        </div>
        <div id="tabs-segment-2" class="hidden" role="tabpanel" aria-labelledby="tabs-segment-item-2">
          <p class="text-base-content/80">
            This is your <span class="text-base-content font-semibold">Profile</span> tab, where you can update your personal information and manage your account details.
          </p>
        </div>
        <div id="tabs-segment-3" class="hidden" role="tabpanel" aria-labelledby="tabs-segment-item-3">
          <p class="text-base-content/80">
            <span class="text-base-content font-semibold">Messages:</span> View your recent messages, chat with friends, and manage your conversations.
          </p>
        </div>
      </div>
      <img src="{{ Vite::asset('resources/images/invest.svg') }}"/>
                <div id="chart" class="w-full"></div>

    </div>
</x-app-layout>
