<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="p-4">
  <div class="flex justify-between items-center mb-2 flex-wrap">
    <div>
    <p class="font-semibold text-base-content/80">Guten Tag, Akemsoft</p>
      
    <h1 class="text-2xl font-semibold mb-2">Dashboard</h1>
    </div>
    <div class="flex items-center gap-3 flex-wrap">
      <button class="btn btn-primary btn-soft btn-lg">
        <span class="icon-[tabler--share] size-5"></span> Teilen
      </button>
      <button class="btn btn-primary btn-soft btn-lg">
        <span class="icon-[tabler--circle-plus] size-5"></span> Hinzufügen
      </button>
    <nav class="tabs bg-base-200 rounded-btn w-fit space-x-1 overflow-x-auto p-1 rtl:space-x-reverse" aria-label="Tabs" role="tablist" aria-orientation="horizontal" >
      <button type="button" class="btn btn-text active-tab:bg-primary active-tab:text-white hover:text-primary active hover:bg-transparent" id="tabs-segment-item-1" data-tab="#tabs-segment-1" aria-controls="tabs-segment-1" role="tab" aria-selected="true" >
        1W
      </button>
      <button type="button" class="btn btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent" id="tabs-segment-item-2" data-tab="#tabs-segment-2" aria-controls="tabs-segment-2" role="tab" aria-selected="false" >
        1M
      </button>
      <button type="button" class="btn btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent" id="tabs-segment-item-3" data-tab="#tabs-segment-3" aria-controls="tabs-segment-3" role="tab" aria-selected="false" >
        YTD
      </button>
      <button type="button" class="btn btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent" id="tabs-segment-item-4" data-tab="#tabs-segment-4" aria-controls="tabs-segment-4" role="tab" aria-selected="false" >
        1J
      </button>
      <div class="tooltip">
        <button type="button" class="btn blur-sm btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent" id="tabs-segment-item-5" data-tab="#tabs-segment-5" aria-controls="tabs-segment-5" role="tab" aria-selected="false" disabled>
          3J
        </button>
        <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
          <span class="tooltip-body bg-primary">PLUS</span>
        </span>
      </div>
      <div class="tooltip">
        <button type="button" class="btn blur-sm btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent" id="tabs-segment-item-6" data-tab="#tabs-segment-6" aria-controls="tabs-segment-6" role="tab" aria-selected="false" disabled>
          5J
        </button>
        <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
          <span class="tooltip-body bg-primary">PLUS</span>
        </span>
      </div>
      
      <div class="tooltip">
        <button type="button" class="btn blur-sm btn-text active-tab:bg-primary active-tab:text-white hover:text-primary hover:bg-transparent" id="tabs-segment-item-7" data-tab="#tabs-segment-7" aria-controls="tabs-segment-7" role="tab" aria-selected="false" disabled>
          MAX
        </button>
        <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
          <span class="tooltip-body bg-primary">PLUS</span>
        </span>
      </div>
    </nav></div>
  </div>

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
    <div id="tabs-segment-4" class="hidden" role="tabpanel" aria-labelledby="tabs-segment-item-4">
      <p class="text-base-content/80">
        <span class="text-base-content font-semibold">sd:</span> View your recent messages, chat with friends, and manage your conversations.
      </p>
    </div>
  </div>
  
  <div class="p-4">

    <div class="flex gap-3 items-center">

      <div id="apex-doughnut-chart"></div>
            <div class="flex-grow">
              <div id="apex-multiple-line-charts" class="w-full"></div>

      </div>
    </div>
          <div class="flex gap-3 items-center justify-between ">
            <div class="text-center">
              <p class="text-sm font-normal">Aktuelles Vermögen</p>
              <div class="mt-1">

                  <p class="text-xl font-semibold"><span>1€ <span class="badge badge-soft badge-success badge-xl">+12% <span class="icon-[tabler--caret-up-filled] size-6"></span></span></span></p>
              </div>      
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col">
                    <p class="text-sm font-normal">Cash</p>
                    <div class="mt-1">
                        <p class="text-lg font-semibold">0,97€</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-normal">Holdings</p>
                    <p class="text-lg font-semibold">0,03€</p>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-normal">Kursgewinn</p>
                    <div class="mt-1">
                        <p class="text-lg font-semibold">-0,000446€</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-normal">Interner Zinsfuß</p>
                    <div class="mt-1">
                        <p class="text-lg font-semibold text-gray-500">0%</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-normal">Dividenden</p>
                    <div class="mt-1">
                        <p class="text-lg font-semibold">0,00€</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <p class="text-sm font-normal">Realisierte Gewinne</p>
                    <div class="mt-1">
                        <p class="text-lg font-semibold">0,00€</p>
                    </div>
                </div>
            </div>
            </div>
            <div class="flex-grow">
              <div id="apex-column-bar-chart" class="w-full"></div>

            </div>
          </div>
  </div>
  <h1 class="text-2xl font-semibold">Holdings</h1>
  <div class="overflow-x-auto rounded-lg border border-base-content/25">
    <table class="min-w-full divide-y-2 divide-base-content/25 bg-white">
      <thead class="text-left">
        <tr>
          <th class="whitespace-nowrap px-4 py-2 font-medium">Name</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium">Anzahl</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium">Gesamtwert</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium">Änderung</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium">Allokation</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-base-content/25">
        <tr>
          <td class="whitespace-nowrap px-4 py-2 font-medium">Bitcoin</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">0.5</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">50.000$</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">
            <p class="text-base font-semibold"><span>+1.55€ <span class="badge badge-soft badge-success ">+12% <span class="icon-[tabler--caret-up-filled] size-6"></span></span></span></p>
          </td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">2,56%</td>
        </tr>
        <tr>
          <td class="whitespace-nowrap px-4 py-2 font-medium">Bitcoin</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">0.5</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">50.000$</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">
            <p class="text-base font-semibold"><span>+1.55€ <span class="badge badge-soft badge-success ">+12% <span class="icon-[tabler--caret-up-filled] size-6"></span></span></span></p>
          </td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">2,56%</td>
        </tr>
      </tbody>
    </table>
  </div>
  <h1 class="text-2xl font-semibold mt-2">Cash</h1>
  <div class="overflow-x-auto rounded-lg border border-base-content/25">
    <table class="min-w-full divide-y-2 divide-base-content/25 bg-white">
      <thead class="text-left">
        <tr>
          <th class="whitespace-nowrap px-4 py-2 font-medium">Name</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium">Anzahl</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium">Gesamtwert</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium">Änderung</th>
          <th class="whitespace-nowrap px-4 py-2 font-medium">Allokation</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-base-content/25">
        <tr>
          <td class="whitespace-nowrap px-4 py-2 font-medium">Bitcoin</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">0.5</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">50.000$</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">
            <p class="text-base font-semibold"><span>+1.55€ <span class="inline-flex items-center justify-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700 dark:bg-emerald-700 dark:text-emerald-100">+12% <span class="icon-[tabler--caret-up-filled] size-6"></span></span></span></p>
          </td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">2,56%</td>
        </tr>
        <tr>
          <td class="whitespace-nowrap px-4 py-2 font-medium">Bitcoin</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">0.5</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">50.000$</td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">
            <p class="text-base font-semibold"><span>+1.55€ <span class="badge badge-soft badge-success ">+12% <span class="icon-[tabler--caret-up-filled] size-6"></span></span></span></p>
          </td>
          <td class="whitespace-nowrap px-4 py-2 text-gray-700">2,56%</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</x-app-layout>
