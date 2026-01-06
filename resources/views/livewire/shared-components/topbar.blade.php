<header class="fixed top-0 left-0 right-0 z-50 bg-white/95 dark:bg-slate-900/95 backdrop-blur-md shadow-sm select-none"
    x-data="{mobileMenuOpen: false}" @click.away="mobileMenuOpen=false">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-12 h-12rounded-lg flex items-center justify-center">
                    <img src="{{ route('media.show', 'shared/logo-png.png') }}" class="size-10 h-auto"
                        alt="logo ponorogo">
                </div>
                <div>
                    <div class="font-bold text-primary dark:text-white text-lg lg:text-xl leading-tight">Dinas
                        Pendidikan</div>
                    <div class="text-gray-600 dark:text-slate-400">Kabupaten Ponorogo</div>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-8">
                @if (request()->routeIs('index'))
                    <a href="#"
                        class="text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white font-medium transition-colors duration-300 relative group">
                        Home
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-secondary group-hover:w-full transition-all duration-300"></span>
                    </a>
                @else
                    <a href="{{ route('index') }}" wire:navigate
                        class="text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white font-medium transition-colors duration-300 relative group">
                        Home
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-secondary group-hover:w-full transition-all duration-300"></span>
                    </a>
                @endif

                @foreach ($this->availableNavs as $key => $nav)
                    @if ($nav->children->isNotEmpty())
                        <div
                            class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] md:[--adaptive:adaptive] [--is-collapse:true] md:[--is-collapse:false] ">
                            <button id="bale-dindik-{{$nav->slug}}" type="button"
                                class="hs-dropdown-toggle w-full flex items-center text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white font-medium transition-colors duration-300 relative group focus:outline-hidden hs-scrollspy-active:bg-gray-100 dark:hs-scrollspy-active:bg-neutral-700"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">


                                {{ $nav->name }}
                                <span
                                    class="absolute bottom-0 left-0 w-0 h-0.5 bg-secondary group-hover:w-full transition-all duration-300"></span>

                                <svg class="hs-dropdown-open:-rotate-180 md:hs-dropdown-open:rotate-0 duration-300 shrink-0 size-4 ms-auto md:ms-2"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-150 hs-dropdown-open:opacity-100 opacity-0 relative w-full md:w-52 hidden z-10 top-full ps-7 md:ps-0 md:bg-white/95 md:rounded-lg md:shadow-md before:absolute before:-top-4 before:start-0 before:w-full before:h-5 md:after:hidden after:absolute after:top-1 after:start-4.5 after:w-0.5 after:h-[calc(100%-4px)] after:bg-gray-100 dark:bg-slate-800 dark:md:bg-slate-800/95 dark:after:bg-slate-700"
                                role="menu" aria-orientation="vertical" aria-labelledby="bale-dindik-{{$nav->slug}}">
                                <div class="py-1 md:px-1 space-y-0.5">

                                    @foreach ($nav->children as $navItem)
                                        <div>
                                            <a class="flex items-center p-2 text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white font-medium transition-color duration-300 ease-in-out group rounded-lg md:px-3 focus:outline-none dark:hover:bg-slate-700 dark:focus:bg-slate-700"
                                                @if ($navItem->url_mode) href="{{ $navItem->url }}"
                                                target="{{ $navItem->target ?? '_self' }}" @else
                                                    href="{{ route('bale.view-page', $navItem->page_slug ?? '404') }}" wire:navigate
                                                @endif>
                                                {{ $navItem->name }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    @else
                        <a class="text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white font-medium transition-colors duration-300 relative group"
                            @if ($nav->url_mode) href="{{ $nav->url }}" target="{{ $nav->target ?? '_self' }}" @else
                            href="{{ route('bale.view-page', $nav->page_slug ?? '404') }}" wire:navigate @endif>
                            {{ $nav->name }}
                            <span
                                class="absolute bottom-0 left-0 w-0 h-0.5 bg-secondary group-hover:w-full transition-all duration-300"></span>
                        </a>
                    @endif
                @endforeach
            </nav>

            {{-- Right Side Actions (Desktop: toggle only, Mobile: toggle + hamburger) --}}
            <div class="flex items-center gap-2">
                {{-- Dark Mode Toggle --}}
                <x-bale-emperan::dark-mode-toggle />

                {{-- Mobile Menu Button --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-primary dark:text-white">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-cloak x-transition
        class="lg:hidden bg-white dark:bg-slate-900 border-t border-gray-200 dark:border-slate-800 shadow-lg">
        <nav class="container mx-auto px-4 py-2 flex flex-col gap-1">
            @if (request()->routeIs('index'))
                <a href="#" @click.prevent="mobileMenuOpen = false"
                    class="text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white font-medium transition-colors duration-300 py-2">Home</a>
            @else
                <a href="{{ route('index') }}" wire:navigate @click="mobileMenuOpen = false"
                    class="text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white font-medium transition-colors duration-300 py-2">Home</a>
            @endif

            @foreach ($this->availableNavs as $key => $nav)
                @if ($nav->children->isNotEmpty())
                    <div class="hs-accordion-group">
                        <div class="hs-accordion" id="{{$key . $nav->slug}}-nav">
                            <button
                                class="hs-accordion-toggle hs-accordion-active:text-primary py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-primary dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400"
                                aria-expanded="false" aria-controls="{{$key . $nav->slug}}">
                                {{ $nav->name }}
                                <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6"></path>
                                </svg>
                                <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6"></path>
                                </svg>
                            </button>
                            <div id="{{$key . $nav->slug}}"
                                class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                role="region" aria-labelledby="{{$key . $nav->slug}}-nav">
                                <div class="container mx-auto px-4 py-2 flex flex-col gap-1">
                                    @foreach ($nav->children as $navItem)
                                        <a @if ($navItem->url_mode) href="{{ $navItem->url }}"
                                        target="{{ $navItem->target ?? '_self' }}" @else
                                            href="{{ route('bale.view-page', $navItem->page_slug ?? '404') }}" wire:navigate @endif
                                            @click="mobileMenuOpen = false"
                                            class="text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white font-medium transition-colors duration-300 py-2">
                                            {{ $navItem->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <a @if ($nav->url_mode) href="{{ $nav->url }}" target="{{ $nav->target ?? '_self' }}" @else
                    href="{{ route('bale.view-page', $nav->page_slug ?? '404') }}" wire:navigate @endif
                        @click="mobileMenuOpen = false"
                        class="text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white font-medium transition-colors duration-300 py-2">
                        {{ $nav->name }}
                    </a>
                @endif
            @endforeach

        </nav>
    </div>
</header>