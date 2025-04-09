<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite('resources/css/app.css')
    @vite(['resources/js/app.ts'])
    <!-- Additional Scripts -->

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased select-none h-screen max-h-screen flex flex-col">
    <nav class="top-0 left-0 right-0 flex p-2 justify-between gap-4 border border-base-content/10 bg-base-100">
        <div class="navbar-start">
            <div class="dropdown relative inline-flex [--auto-close:inside] [--offset:9]">
                <button id="dropdown-name" type="button"
                    class="dropdown-toggle btn btn-text dropdown-open:bg-base-content/10 dropdown-open:"
                    aria-expanded="false" aria-controls="default-sidebar" data-overlay="#default-sidebar">
                    <span class="icon-[tabler--menu-2] size-5"></span>
                </button>
            </div>
        </div>
        <div class="navbar-center flex items-center">
            <a class="link text-xl font-semibold no-underline" href="#">
                <span>Money</span>
            </a>
        </div>
        <div class="navbar-end items-center gap-4">
            <div class="dropdown relative inline-flex [--auto-close:inside] [--offset:8] [--placement:bottom-end]">
                <button id="dropdown-scrollable" type="button"
                    class="dropdown-toggle btn btn-text dropdown-open:bg-base-content/10 size-10"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <div class="indicator">
                        <span class="indicator-item bg-primary size-2 rounded-full"></span>
                        <span class="icon-[tabler--bell] size-[1.375rem]"></span>
                    </div>
                </button>
                <div class="dropdown-menu dropdown-open:opacity-100 hidden p-0" role="menu"
                    aria-orientation="vertical" aria-labelledby="dropdown-scrollable">
                    <div class="flex justify-center border-b-2 border-base-content/10 p-2">
                        <h6 class="text-xl">Notifications</h6>
                    </div>
                    <div
                        class="vertical-scrollbar horizontal-scrollbar rounded-scrollbar/80 max-h-56 p-0 overflow-auto ">
                        @php
                            $notifications = [
                                [
                                    'icon' => 'icon-[tabler--caret-down-filled]',
                                    'title' => 'Bitcoin ist jetzt niedrig',
                                    'message' => 'Kaufe jetzt',
                                ],
                                [
                                    'icon' => 'icon-[tabler--confetti]',
                                    'title' => 'Deine Investitionen haben die 100.000$ Marke durchbrochen!',
                                    'message' => 'Super',
                                ],
                                [
                                    'icon' => 'icon-[tabler--mood-confuzed]',
                                    'title' => 'Dieser Monat war nicht so toll',
                                    'message' => 'Deine Investitionen sind um 20% gefallen',
                                ],
                                [
                                    'icon' => 'icon-[tabler--trending-up]',
                                    'title' => 'Aktien steigen',
                                    'message' => 'Deine Aktien sind um 15% gestiegen',
                                ],
                                [
                                    'icon' => 'icon-[tabler--alert-triangle]',
                                    'title' => 'Marktvolatilität',
                                    'message' => 'Der Markt ist heute sehr volatil',
                                ],
                                [
                                    'icon' => 'icon-[tabler--cash]',
                                    'title' => 'Dividende erhalten',
                                    'message' => 'Du hast eine Dividende von $500 erhalten',
                                ],
                                [
                                    'icon' => 'icon-[tabler--news]',
                                    'title' => 'Wichtige Nachrichten',
                                    'message' => 'Neue Finanznachrichten verfügbar',
                                ],
                                [
                                    'icon' => 'icon-[tabler--star]',
                                    'title' => 'Top Performer',
                                    'message' => 'Dein Portfolio gehört zu den Top 10%',
                                ],
                                [
                                    'icon' => 'icon-[tabler--trending-down]',
                                    'title' => 'Aktien fallen',
                                    'message' => 'Deine Aktien sind um 10% gefallen',
                                ],
                                [
                                    'icon' => 'icon-[tabler--chart-pie]',
                                    'title' => 'Portfolio Update',
                                    'message' => 'Dein Portfolio wurde aktualisiert',
                                ],
                                [
                                    'icon' => 'icon-[tabler--trophy]',
                                    'title' => 'Neuer Meilenstein',
                                    'message' => 'Du hast einen neuen Meilenstein erreicht',
                                ],
                            ];
                        @endphp
                        @foreach ($notifications as $notification)
                            <a class="flex items-center gap-2 p-2 justify-center hover:bg-base-content/10 active:bg-base-content/20"
                                href="#">
                                <div class="avatar">
                                    <div class="bg-neutral text-white w-10 rounded-full p-2">
                                        <span class="{{ $notification['icon'] }} size-full"></span>
                                    </div>
                                </div>
                                <div class="w-60">
                                    <h6 class="truncate text-base">{{ $notification['title'] }}</h6>
                                    <small class="/50 text-wrap">{{ $notification['message'] }}</small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <a href="#" class="flex justify-center items-center border-t-2 border-base-content/10 p-2">
                        <span class="icon-[tabler--eye] size-4"></span>
                        View all
                    </a>
                </div>
            </div>

            <label class="swap swap-rotate btn btn-sm btn-text size-10">
                <input type="checkbox" value="dark" class="theme-controller" />
                <span class="swap-off icon-[tabler--sun] size-7"></span>
                <span class="swap-on icon-[tabler--moon] size-7"></span>
              </label>
            <div class="dropdown relative inline-flex [--auto-close:inside] [--offset:8] [--placement:bottom-end]">
                <button id="dropdown-scrollable" type="button" class="dropdown-toggle flex items-center"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <div class="w-10 h-10 bg-base-300 flex justify-center items-center rounded-full text-white">
                        <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                </button>
                <div class="dropdown-menu dropdown-open:opacity-100 hidden p-0" role="menu"
                    aria-orientation="vertical" aria-labelledby="dropdown-scrollable">
                    <div class="flex justify-center border-b-2 border-base-content/10 p-2">
                        <li class="flex gap-2">
                            <div class="w-10 h-10 bg-base-300 flex justify-center items-center rounded-full text-white">
                                <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <h6 class="text-base font-semibold">{{ Auth::user()->name }}</h6>
                                <small class="/50">Free plan</small>
                            </div>
                        </li>
                    </div>
                    <div
                        class="vertical-scrollbar horizontal-scrollbar rounded-scrollbar/80 max-h-56 p-0 overflow-auto w-60">
                        <a class="flex gap-1 p-2 hover:bg-primary hover:text-white active:bg-primary"
                            href="#">
                            <span class="icon-[tabler--sparkles] size-5"></span>
                            <div>
                                <h6 class="truncate text-base font-semibold">Upgrade</h6>
                            </div>
                        </a>
                        <a class="flex gap-1 p-2 hover:bg-base-content/10 active:bg-base-content/20"
                            href="{{ route('profile.show') }}">
                            <span class="icon-[tabler--user] size-5"></span>
                            <div>
                                <h6 class="truncate text-base font-semibold">My Profile</h6>
                            </div>
                        </a>
                        <a class="flex gap-1 p-2 hover:bg-base-content/10 active:bg-base-content/20" href="{{ route("settings") }}">
                            <span class="icon-[tabler--settings] size-5"></span>
                            <div>
                                <h6 class="truncate text-base font-semibold">Settings</h6>
                            </div>
                        </a>
                        <a class="flex gap-1 p-2 hover:bg-base-content/10 active:bg-base-content/20" href="#">
                            <span class="icon-[tabler--receipt-rupee] size-5"></span>
                            <div>
                                <h6 class="truncate text-base font-semibold">Payments</h6>
                            </div>
                        </a>
                        <form method="POST" class="w-full" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex gap-1 p-2 hover:bg-red-600 active:bg-red-500 w-full hover:text-white rounded-b-lg">
                                <span class="icon-[tabler--logout] size-5"></span>
                                <div>
                                    <h6 class="truncate text-base font-semibold">Logout</h6>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex flex-1 overflow-hidden">
        <aside id="default-sidebar"
            class="overlay [--auto-close:sm] sm:shadow-none overlay-open:translate-x-0 drawer drawer-start hidden max-w-64 sm:absolute sm:z-0 sm:flex sm:translate-x-0 border border-base-content/10 overflow-y-auto" role="dialog" tabindex="-1">
            <div class="border-b border-base-content/10 p-3 flex items-center justify-between">
                <h1 class="font-semibold text-2xl">Money</h1>
                <button type="button" class="btn btn-text sm:hidden" aria-label="Close"
                    data-overlay="#default-sidebar">
                    <span class="icon-[tabler--x] size-4"></span>
                </button>
            </div>
            <div class="grow justify-start pb-6">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}" wire:navigate class="menu-item">
                        <span class="icon-[tabler--home] size-5"></span>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('wallet') }}" wire:navigate class="menu-item font-semibold hover:bg-primary">
                        <span class="icon-[tabler--wallet] size-5"></span>
                        Wallet
                        {{-- <span class="badge badge-neutral p-0 pe-1 gap-0!"><span class="icon-[tabler--flame] size-4"></span>New</span> --}}
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('bank') }}" wire:navigate class="menu-item">
                        <span class="icon-[tabler--currency-ethereum] size-5"></span>
                        Cryptocurrencies
                        {{-- <span class="badge badge-neutral p-0 pe-1 gap-0!"><span class="icon-[tabler--flame] size-4"></span>New</span>
                    </a>
                </li> --}}
                <li class="nested-collapse-wrapper">
                    <a class="collapse-toggle nested-collapse menu-item" id="front-page-collapse"
                        data-collapse="#front-page-collapse-menu">
                        <span class="icon-[tabler--trending-up] size-5"></span>
                        Investments
                        <span class="icon-[tabler--chevron-down] collapse-icon size-4"></span>
                    </a>
                    <div id="front-page-collapse-menu"
                        class="collapse hidden w-auto overflow-hidden transition-[height] duration-300 border-s-2 ms-2 border-base-content/20 space-y-1 mt-1"
                        aria-labelledby="front-page-collapse">
                        <div>
                            <a href="{{ route('bonds') }}" wire:navigate class="menu-item">
                                <span class="icon-[tabler--coin] size-5"></span>
                                Bonds
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('real-estate') }}" wire:navigate class="menu-item">
                                <span class="icon-[tabler--building] size-5"></span>
                                Real Estate
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('mutual-funds') }}" wire:navigate class="menu-item">
                                <span class="icon-[tabler--chart-pie] size-5"></span>
                                Mutual Funds
                            </a>
                        </div>
                    </div>
                </li>
                <div class="divider text-base-content/50 py-6 after:border-0">Insides</div>

                <li>
                    <a href="{{ route('forecasts') }}" class="menu-item">
                        <span class="icon-[tabler--cpu] size-5"></span>
                        Forecasts
                    </a>
                </li>
                <li>
                    <a href="{{ route('analysis') }}" class="menu-item">
                      <span class="icon-[tabler--chart-donut] size-5"></span>
                        Analysis
                    </a>
                </li>
                <li>
                    <a href="{{ route('learn') }}" class="menu-item">
                      <span class="icon-[tabler--book] size-5"></span>
                      Learn <span class="badge badge-soft badge-primary">New</span>
                    </a>
                </li>
            </ul>
            {{-- <div class="bg-base-200/30 border-base-content/10 mt-4 rounded-md border p-3 m-3">
                <div class="avatar placeholder">
                    <div class="bg-neutral text-neutral-content w-10 rounded-full">
                        <span class="icon-[tabler--crown] size-6 shrink-0"></span>
                    </div>
                </div>
                <h5 class="mt-4 text-lg font-semibold">Upgrade to Pro</h5>
                <p class="/80 text-xs">Reminder, extra prjects, advanced search and more</p>
                <button class="btn btn-primary btn-block mt-2">Upgrade Now</button>
            </div> --}}
        </div>
    </aside>
    
    <main class="flex-1 sm:ml-64 overflow-y-auto">
        {{ $slot }}
    </main>
</div>

<!-- Page Content -->
@stack('modals')
<script>
    window.HSStaticMethods.autoInit()
    addEventListener('livewired:navigated', () => {
        themeChange(true);
    });
</script>
@livewireScripts
</body>

</html>