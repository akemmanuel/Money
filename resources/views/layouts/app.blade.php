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
    
            <body class="font-sans antialiased dark:bg-black dark:text-white/50 select-none">
                  <nav class="navbar justify-between gap-4 shadow">
                    <div class="navbar-start">
                      <div class="dropdown relative inline-flex [--auto-close:inside] [--offset:9]">
                        <button id="dropdown-name" type="button" class="dropdown-toggle btn btn-text btn-circle dropdown-open:bg-base-content/10 dropdown-open:text-base-content" aria-haspopup="dialog" aria-expanded="false" aria-controls="overlay-navigation-example" data-overlay="#overlay-navigation-example">
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
                            <button id="dropdown-scrollable" type="button" class="dropdown-toggle btn btn-text btn-circle dropdown-open:bg-base-content/10 size-10" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                              <div class="indicator">
                                <span class="indicator-item bg-error size-2 rounded-full"></span>
                                <span class="icon-[tabler--bell] text-base-content size-[1.375rem]"></span>
                              </div>
                            </button>
                            <div class="dropdown-menu dropdown-open:opacity-100 hidden" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-scrollable">
                              <div class="dropdown-header justify-center">
                                <h6 class="text-base-content text-base">Notifications</h6>
                              </div>
                              <div class="vertical-scrollbar horizontal-scrollbar rounded-scrollbar text-base-content/80 max-h-56 overflow-auto max-md:max-w-60">
                                <div class="dropdown-item">
                                  <div class="avatar away-bottom">
                                    <div class="w-10 rounded-full">
                                      <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-1.png" alt="avatar 1" />
                                    </div>
                                  </div>
                                  <div class="w-60">
                                    <h6 class="truncate text-base">Charles Franklin</h6>
                                    <small class="text-base-content/50 truncate">Accepted your connection</small>
                                  </div>
                                </div>
                                <div class="dropdown-item">
                                  <div class="avatar">
                                    <div class="w-10 rounded-full">
                                      <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-2.png" alt="avatar 2" />
                                    </div>
                                  </div>
                                  <div class="w-60">
                                    <h6 class="truncate text-base">Martian added moved Charts & Maps task to the done board.</h6>
                                    <small class="text-base-content/50 truncate">Today 10:00 AM</small>
                                  </div>
                                </div>
                                <div class="dropdown-item">
                                  <div class="avatar online-bottom">
                                    <div class="w-10 rounded-full">
                                      <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-8.png" alt="avatar 8" />
                                    </div>
                                  </div>
                                  <div class="w-60">
                                    <h6 class="truncate text-base">New Message</h6>
                                    <small class="text-base-content/50 truncate">You have new message from Natalie</small>
                                  </div>
                                </div>
                                <div class="dropdown-item">
                                  <div class="avatar placeholder">
                                    <div class="bg-neutral text-neutral-content w-10 rounded-full p-2">
                                      <span class="icon-[tabler--user] size-full"></span>
                                    </div>
                                  </div>
                                  <div class="w-60">
                                    <h6 class="truncate text-base">Application has been approved 🚀</h6>
                                    <small class="text-base-content/50 text-wrap">Your ABC project application has been approved.</small>
                                  </div>
                                </div>
                                <div class="dropdown-item">
                                  <div class="avatar">
                                    <div class="w-10 rounded-full">
                                      <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-10.png" alt="avatar 10" />
                                    </div>
                                  </div>
                                  <div class="w-60">
                                    <h6 class="truncate text-base">New message from Jane</h6>
                                    <small class="text-base-content/50 text-wrap">Your have new message from Jane</small>
                                  </div>
                                </div>
                                <div class="dropdown-item">
                                  <div class="avatar">
                                    <div class="w-10 rounded-full">
                                      <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-3.png" alt="avatar 3" />
                                    </div>
                                  </div>
                                  <div class="w-60">
                                    <h6 class="truncate text-base">Barry Commented on App review task.</h6>
                                    <small class="text-base-content/50 truncate">Today 8:32 AM</small>
                                  </div>
                                </div>
                              </div>
                              <a href="#" class="dropdown-footer justify-center gap-1">
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
                        <button id="dropdown-scrollable" type="button" class="dropdown-toggle flex items-center" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                          <div class="avatar">
                            <div class="size-9.5 rounded-full">
                              <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-1.png" alt="avatar 1" />
                            </div>
                          </div>
                        </button>
                        <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-60" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-avatar">
                          <li class="dropdown-header gap-2">
                            <div class="avatar">
                              <div class="w-10 rounded-full">
                                <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-1.png" alt="avatar" />
                              </div>
                            </div>
                            <div>
                                <h6 class="text-base-content text-base font-semibold">{{ Auth::user()->name }}</h6>
                              <small class="text-base-content/50">Free plan</small>
                            </div>
                          </li>
                          <li>
                            <a class="dropdown-item bg-primary text-white hover:bg-primary hover:text-white" href="/asd">
                              <span class="icon-[tabler--sparkles]"></span>
                              Upgrade
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                              <span class="icon-[tabler--user]"></span>
                              Mein Profil
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="#">
                              <span class="icon-[tabler--settings]"></span>
                              Einstellungen
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="#">
                              <span class="icon-[tabler--receipt-rupee]"></span>
                              Zahlungen
                            </a>
                          </li>
                          <li class="dropdown-footer gap-2">
                            <a class="btn btn-error btn-soft btn-block" href="#">
                              <span class="icon-[tabler--logout]"></span>
                              Abmelden
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </nav>
        
                  <aside id="overlay-navigation-example" class="overlay overlay-open:translate-x-0 drawer drawer-start hidden max-w-72" tabindex="-1" >
                    <div class="drawer-header">
                      <h3 class="drawer-title">Menu</h3>
                      <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3" aria-label="Close" data-overlay="#overlay-navigation-example" >
                        <span class="icon-[tabler--x] size-4"></span>
                      </button>
                    </div>
                    <div class="drawer-body justify-start pb-6">
                      <ul class="menu space-y-0.5 p-0 [&_.nested-collapse-wrapper]:space-y-0.5 [&_ul]:space-y-0.5">
                        <li>
                          <a href="{{ route('dashboard') }}" wire:navigate>
                            <span class="icon-[tabler--home] size-5"></span>
                            Dashboard
                          </a>
                        </li>
        
                        <li>
                          <a href="{{ route('bank') }}" wire:navigate>
                            <span class="icon-[tabler--credit-card] size-5"></span>
                            Konten
                          </a>
                        </li>
                        <li class="nested-collapse-wrapper">
                          <a class="collapse-toggle nested-collapse" id="front-page-collapse" data-collapse="#front-page-collapse-menu">
                            <span class="icon-[tabler--trending-up] size-5"></span>
                            Investitionen
                            <span class="icon-[tabler--chevron-down] collapse-icon size-4"></span>
                          </a>
                          <ul id="front-page-collapse-menu" class="collapse hidden w-auto overflow-hidden transition-[height] duration-300" aria-labelledby="front-page-collapse" >
                            <li>
                                <a href="{{ route('stocks') }}" wire:navigate>
                              <span class="icon-[tabler--chart-line] size-5"></span>
                              Aktien
                              </a>
                            </li>
                            <li>
                              <a href="{{ route('bonds') }}" wire:navigate>
                              <span class="icon-[tabler--coin] size-5"></span>
                              Anleihen
                              </a>
                            </li>
                            <li>
                              <a href="{{ route('real-estate') }}" wire:navigate>
                              <span class="icon-[tabler--building] size-5"></span>
                              Immobilien
                              </a>
                            </li>
                            <li>
                              <a href="{{ route('mutual-funds') }}" wire:navigate>
                              <span class="icon-[tabler--chart-pie] size-5"></span>
                              Investmentfonds
                              </a>
                            </li>
                            <li>
                              <a href="{{ route('etfs') }}" wire:navigate>
                              <span class="icon-[tabler--chart-bar] size-5"></span>
                              ETFs
                              </a>
                            </li>
                            <li>
                              <a href="{{ route('commodities') }}" wire:navigate>
                              <span class="icon-[tabler--barrel] size-5"></span>
                              Rohstoffe
                              </a>
                            </li>
                            <li>
                              <a href="{{ route('crypto') }}" wire:navigate>
                              <span class="icon-[tabler--currency-bitcoin] size-5"></span>
                              Cryptowährungen
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <a href="{{ route('dashboard') }}" wire:navigate>
                            <span class="icon-[tabler--alert-circle] size-5"></span>
                            High-risk Projekte
                          </a>
                        </li>
                        <div class="divider text-base-content/50 py-6 after:border-0">Insides</div>
                        <li>
                          <a href="#">
                            <span class="icon-[tabler--chart-donut] size-5"></span>
                            Analysen
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
