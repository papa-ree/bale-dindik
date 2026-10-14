<header
    class="fixed top-0 left-0 right-0 z-50 bg-white/95 dark:bg-slate-900/95 backdrop-blur-md shadow-sm select-none transition-colors duration-300"
    x-data="{ mobileMenuOpen: false }" @click.away="mobileMenuOpen = false">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            {{-- Logo --}}
            <a href="{{ route('index') }}" wire:navigate.hover class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                    <img src="{{ cdn_asset('shared/logo-png.png') }}" class="size-10 h-auto" loading="lazy"
                        decoding="async" alt="logo ponorogo">
                </div>
                <div>
                    <div class="font-bold text-primary dark:text-white text-lg lg:text-xl leading-tight">Dinas
                        Pendidikan</div>
                    <div class="text-gray-600 dark:text-slate-400">Kabupaten Ponorogo</div>
                </div>
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden lg:flex items-center gap-8" x-data="umpakNav()">
                @forelse ($umpakNav as $i => $item)
                    @php
                        $isInternal = str_starts_with($item->resolvedUrl, '/') || str_contains($item->resolvedUrl, config('app.url'));
                        $isAnchor = str_contains($item->resolvedUrl, '#');
                        $useNavigate = $isInternal && !$isAnchor;
                    @endphp

                    @if ($item->hasChildren())
                        <div class="relative cursor-pointer"
                            @click="isDropdownOpen({{ $i }}) ? closeDropdown() : openDropdown({{ $i }})"
                            @click.outside="isDropdownOpen({{ $i }}) ? closeDropdown() : null">
                            <button @class([
                                'flex items-center cursor-pointer gap-1 font-medium transition-colors duration-300 focus:outline-none',
                                'text-primary dark:text-white' => str_starts_with(request()->url(), $item->resolvedUrl),
                                'text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white' => !str_starts_with(request()->url(), $item->resolvedUrl),
                            ]) type="button">
                                <span>{{ $item->name }}</span>
                                <x-umpak::icon name="chevron-down" class="w-3.5 h-3.5" />
                            </button>

                            <div x-show="isDropdownOpen({{ $i }})" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute left-1/2 -translate-x-1/2 mt-3 w-56 bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700/50 py-2 z-50">
                                @foreach ($item->children as $child)
                                    @php
                                        $childInternal = str_starts_with($child->resolvedUrl, '/') || str_contains($child->resolvedUrl, config('app.url'));
                                        $childAnchor = str_contains($child->resolvedUrl, '#');
                                        $childNavigate = $childInternal && !$childAnchor;
                                    @endphp
                                    <a href="{{ $child->resolvedUrl }}" @if($childNavigate) wire:navigate.hover @endif
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-slate-300 hover:bg-primary/5 dark:hover:bg-primary/10 hover:text-primary dark:hover:text-white transition-colors">
                                        {{ $child->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $item->resolvedUrl }}" @if($useNavigate) wire:navigate.hover @endif @class([
                            'font-medium transition-colors duration-300 relative group',
                            'text-primary dark:text-white' => request()->url() == $item->resolvedUrl,
                            'text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white' => request()->url() != $item->resolvedUrl,
                        ])>
                            {{ $item->name }}
                            <span
                                class="absolute bottom-0 left-0 w-0 h-0.5 bg-secondary group-hover:w-full transition-all duration-300"></span>
                        </a>
                    @endif
                @empty
                    <a href="{{ route('index') }}" wire:navigate.hover
                        class="text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white font-medium transition-colors duration-300 relative group">
                        Home
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-secondary group-hover:w-full transition-all duration-300"></span>
                    </a>
                @endforelse
            </nav>

            {{-- Right Side Actions --}}
            <div class="flex items-center gap-2">
                {{-- Dark Mode Toggle --}}
                <x-bale-dindik::dark-mode-toggle />

                {{-- Mobile Menu Button --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-primary dark:text-white"
                    aria-label="Toggle menu">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenuOpen" x-cloak x-transition
        class="lg:hidden bg-white dark:bg-slate-900 border-t border-gray-200 dark:border-slate-800 shadow-lg max-h-[calc(100vh-80px)] overflow-y-auto scrollbar-thin scrollbar-thumb-primary scrollbar-track-gray-100/50 scrollbar-thumb-rounded-full scrollbar-track-rounded-full overscroll-none">
        <nav class="container mx-auto px-4 py-2 flex flex-col gap-1" x-data="umpakNav()">
            @forelse ($umpakNav as $i => $item)
                @php
                    $isInternal = str_starts_with($item->resolvedUrl, '/') || str_contains($item->resolvedUrl, config('app.url'));
                    $isAnchor = str_contains($item->resolvedUrl, '#');
                    $useNavigate = $isInternal && !$isAnchor;
                @endphp

                @if ($item->hasChildren())
                    <div class="hs-accordion-group">
                        <div class="hs-accordion" id="bale-dindik-{{ $item->slug }}-nav">
                            <button
                                class="hs-accordion-toggle hs-accordion-active:text-primary py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-primary dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400"
                                aria-expanded="false" aria-controls="bale-dindik-{{ $item->slug }}">
                                {{ $item->name }}
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
                            <div id="bale-dindik-{{ $item->slug }}"
                                class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                role="region" aria-labelledby="bale-dindik-{{ $item->slug }}-nav">
                                <div
                                    class="container mx-auto px-4 py-2 flex flex-col gap-1 max-h-[50vh] overflow-y-auto scrollbar-thin scrollbar-thumb-primary scrollbar-track-gray-100/50 scrollbar-thumb-rounded-full scrollbar-track-rounded-full overscroll-none">
                                    @foreach ($item->children as $child)
                                        @php
                                            $childInternal = str_starts_with($child->resolvedUrl, '/') || str_contains($child->resolvedUrl, config('app.url'));
                                            $childAnchor = str_contains($child->resolvedUrl, '#');
                                            $childNavigate = $childInternal && !$childAnchor;
                                        @endphp
                                        <a href="{{ $child->resolvedUrl }}" @if($childNavigate) wire:navigate.hover @endif
                                            @click="mobileMenuOpen = false"
                                            class="text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white font-medium transition-colors duration-300 py-2">
                                            {{ $child->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ $item->resolvedUrl }}" @if($useNavigate) wire:navigate.hover @endif
                        @click="mobileMenuOpen = false"
                        class="text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white font-medium transition-colors duration-300 py-2">
                        {{ $item->name }}
                    </a>
                @endif
            @empty
                <a href="{{ route('index') }}" wire:navigate.hover @click="mobileMenuOpen = false"
                    class="text-gray-700 dark:text-slate-300 hover:text-primary dark:hover:text-white font-medium transition-colors duration-300 py-2">Home</a>
            @endforelse
        </nav>
    </div>
</header>
