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

<body class="font-sans antialiased dark:text-white/50 select-none">
    <nav class="flex p-2 justify-between gap-4">
        <div class="navbar-start">
            <div class="dropdown relative inline-flex [--auto-close:inside] [--offset:9]">
                <button id="dropdown-name" type="button"
                    class="dropdown-toggle btn btn-text btn-circle dropdown-open:bg-base-content/10 dropdown-open:text-base-content"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="overlay-navigation-example"
                    data-overlay="#overlay-navigation-example">
                    <span class="icon-[tabler--menu-2] size-5"></span>
                </button>

            </div>
        </div>
        <div class="navbar-center flex items-center">
            <a class="link text-base-content link-neutral text-xl font-semibold no-underline" href="#">
                <span>Money</span>
            </a>
        </div>
        <div class="navbar-end items-center gap-4">
            <div class="dropdown relative inline-flex [--auto-close:inside] [--offset:8] [--placement:bottom-end]">
                <button id="dropdown-scrollable" type="button"
                    class="dropdown-toggle btn btn-text btn-circle dropdown-open:bg-base-content/10 size-10"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <div class="indicator">
                        <span class="indicator-item bg-error size-2 rounded-full"></span>
                        <span class="icon-[tabler--bell] text-base-content size-[1.375rem]"></span>
                    </div>
                </button>
                <div class="dropdown-menu dropdown-open:opacity-100 hidden p-0" role="menu"
                    aria-orientation="vertical" aria-labelledby="dropdown-scrollable">
                    <div class="flex justify-center border-b-2 border-base-content/10 p-2">
                        <h6 class="text-base-content text-xl">Notifications</h6>
                    </div>
                    <div
                        class="vertical-scrollbar horizontal-scrollbar rounded-scrollbar text-base-content/80 max-h-56 p-0 overflow-auto ">
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
                                    <div class="bg-neutral text-neutral-content w-10 rounded-full p-2">
                                        <span class="{{ $notification['icon'] }} size-full"></span>
                                    </div>
                                </div>
                                <div class="w-60">
                                    <h6 class="truncate text-base">{{ $notification['title'] }}</h6>
                                    <small class="text-base-content/50 text-wrap">{{ $notification['message'] }}</small>
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

            <label class="swap swap-rotate btn btn-sm btn-text btn-circle size-[2.125rem]">
                <input type="checkbox" value="dark" class="theme-controller" />
                <span class="swap-off icon-[tabler--sun] size-7"></span>
                <span class="swap-on icon-[tabler--moon] size-7"></span>
            </label>
            <label class="swap swap-rotate btn btn-sm btn-text btn-circle size-[2.125rem]">
                <input type="checkbox" />
                <span class="swap-off icon-[tabler--currency-euro] size-7"></span>
                <span class="swap-on icon-[tabler--currency-dollar] size-7"></span>
            </label>
            <div class="dropdown relative inline-flex [--auto-close:inside] [--offset:8] [--placement:bottom-end]">
                <button id="dropdown-scrollable" type="button" class="dropdown-toggle flex items-center"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <div class=" w-10 h-10 bg-base-300 flex justify-center items-center rounded-full">
                        <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                </button>
                <div class="dropdown-menu dropdown-open:opacity-100 hidden p-0" role="menu"
                    aria-orientation="vertical" aria-labelledby="dropdown-scrollable">
                    <div class="flex justify-center border-b-2 border-base-content/10 p-2">
                        <li class="flex gap-2">
                            <div class=" w-10 h-10 bg-base-300 flex justify-center items-center rounded-full">
                                <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <h6 class="text-base-content text-base font-semibold">{{ Auth::user()->name }}</h6>
                                <small class="text-base-content/50">Free plan</small>
                            </div>
                        </li>
                    </div>
                    <div
                        class="vertical-scrollbar horizontal-scrollbar rounded-scrollbar text-base-content/80 max-h-56 p-0 overflow-auto w-60">
                        <a class="flex gap-1 p-2 hover:bg-primary hover:text-white active:bg-base-content/20"
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
                                <h6 class="truncate text-base font-semibold">Mein Profil</h6>
                            </div>
                        </a>
                        <a class="flex gap-1 p-2 hover:bg-base-content/10 active:bg-base-content/20" href="#">
                            <span class="icon-[tabler--settings] size-5"></span>
                            <div>
                                <h6 class="truncate text-base font-semibold">Einstellungen</h6>
                            </div>
                        </a>
                        <a class="flex gap-1 p-2 hover:bg-base-content/10 active:bg-base-content/20" href="#">
                            <span class="icon-[tabler--receipt-rupee] size-5"></span>
                            <div>
                                <h6 class="truncate text-base font-semibold">Zahlungen</h6>
                            </div>
                        </a>
                        <form method="POST" class="w-full" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex gap-1 p-2 hover:bg-red-600 active:bg-base-content/20 w-full hover:text-white rounded-b-lg">
                                <span class="icon-[tabler--logout] size-5"></span>
                                <div>
                                    <h6 class="truncate text-base font-semibold">Abmelden</h6>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="overlay-navigation-example"
        class="overlay overlay-open:translate-x-0 drawer drawer-start hidden" tabindex="-1">
        <div class="border-b-2 border-base-content/10 p-4 flex items-center justify-between">
            <h1 class="font-semibold text-2xl">Menu</h1>
            <button type="button" class="btn btn-text btn-circle btn-sm" aria-label="Close"
            data-overlay="#overlay-navigation-example">
            <span class="icon-[tabler--x] size-4"></span>
            </button>
        </div>
        <div class="flex-grow justify-start pb-6">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}" wire:navigate class="menu-item">
                        <span class="icon-[tabler--home] size-5"></span>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('bank') }}" wire:navigate class="menu-item">
                        <span class="icon-[tabler--credit-card] size-5"></span>
                        Konten
                    </a>
                </li>
                <li class="nested-collapse-wrapper">
                    <a class="collapse-toggle nested-collapse menu-item" id="front-page-collapse"
                        data-collapse="#front-page-collapse-menu">
                        <span class="icon-[tabler--trending-up] size-5"></span>
                        Investitionen
                        <span class="icon-[tabler--chevron-down] collapse-icon size-4"></span>
                    </a>
                    <div id="front-page-collapse-menu"
                        class="collapse hidden w-auto overflow-hidden transition-[height] duration-300 border-s-2 ms-2 border-base-content/20 space-y-1 mt-1"
                        aria-labelledby="front-page-collapse">
                        <div>
                            <a href="{{ route('stocks') }}" wire:navigate class="menu-item">
                                <span class="icon-[tabler--chart-line] size-5"></span>
                                Aktien
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('bonds') }}" wire:navigate class="menu-item">
                                <span class="icon-[tabler--coin] size-5"></span>
                                Anleihen
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('real-estate') }}" wire:navigate class="menu-item">
                                <span class="icon-[tabler--building] size-5"></span>
                                Immobilien
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('mutual-funds') }}" wire:navigate class="menu-item">
                                <span class="icon-[tabler--chart-pie] size-5"></span>
                                Investmentfonds
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('etfs') }}" wire:navigate class="menu-item">
                                <span class="icon-[tabler--chart-bar] size-5"></span>
                                ETFs
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('commodities') }}" wire:navigate class="menu-item">
                                <span class="icon-[tabler--barrel] size-5"></span>
                                Rohstoffe
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('crypto') }}" wire:navigate class="menu-item">
                                <span class="icon-[tabler--currency-bitcoin] size-5"></span>
                                Cryptowährungen
                            </a>
                        </div>
                    </div>
                </li>
                <div class="divider text-base-content/50 py-6 after:border-0">Insides</div>
                <li>
                    <a href="{{ route('forecasts') }}" class="menu-item">
                        <span class="icon-[tabler--cpu] size-5"></span>
                        Prognosen
                    </a>
                </li>
                <li>
                    <a href="{{ route('analysis') }}" class="menu-item">
                      <span class="icon-[tabler--chart-donut] size-5"></span>
                      Analysis
                    </a>
                </li>

            </ul>
            <div class="bg-base-200/30 border-base-content/10 mt-4 rounded-md border p-3">
                <div class="avatar placeholder">
                    <div class="bg-neutral text-neutral-content w-10 rounded-full">
                        <span class="icon-[tabler--crown] size-6 shrink-0"></span>
                    </div>
                </div>
                <h5 class="text-base-content mt-4 text-lg font-semibold">Upgrade to Pro</h5>
                <p class="text-base-content/80 text-xs">Reminder, extra prjects, advanced search and more</p>
                <button class="btn btn-primary btn-block mt-2">Upgrade Now</button>
            </div>
        </div>
    </aside>
    <main>
        {{ $slot }}
    </main>

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
