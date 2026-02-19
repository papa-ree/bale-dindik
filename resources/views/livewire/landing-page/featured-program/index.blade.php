<div>
    @if ($actived)
        @if (empty($section) || empty($this->meta))
            {{-- Error Handler: Section Not Found --}}
            <section class="py-20 bg-white dark:bg-slate-900">
                <div class="container mx-auto px-4 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-primary/10 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary/40" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5l7 7-7 7M5 5l7 7-7 7" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-white mb-2">Konten Program Unggulan Tidak Ditemukan</h2>
                    <p class="text-slate-500 dark:text-slate-400 max-w-md mx-auto">Silakan konfigurasi metadata section ini di
                        panel admin CMS Anda.</p>
                </div>
            </section>
        @else
            @php
                $meta = $this->meta;
                $title = $meta['title'] ?? 'Program Unggulan';
                $subtitle = $meta['subtitle'] ?? null;
                $buttons = $meta['buttons'] ?? [];
            @endphp

            <section id="programs" class="py-20 bg-white dark:bg-slate-900">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl sm:text-4xl font-bold text-primary dark:text-white mb-4">
                            {{ $title }}
                        </h2>
                        @if ($subtitle)
                            <p class="text-lg text-gray-600 dark:text-slate-400 max-w-2xl mx-auto">
                                {{ $subtitle }}
                            </p>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
                        @forelse ($this->availablePrograms as $item)
                            <a href="{{ $item['url'] ?? '#' }}"
                                {{ Illuminate\Support\Str::startsWith($item['url'] ?? '', '/') ? 'wire:navigate.hover' : '' }}
                                class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-gray-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary hover:shadow-xl transition-all duration-300 cursor-pointer group">
                                <div class="relative overflow-hidden h-64">
                                    @if (!empty($item['card_image']))
                                        <img src="{{ $item['card_image'] }}" alt="{{ $item['name'] ?? '' }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                            loading="lazy" decoding="async" />
                                    @else
                                        <div class="w-full h-full bg-gray-100 dark:bg-slate-700 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                                            <svg class="w-12 h-12 text-gray-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif

                                    <div
                                        class="absolute inset-0 bg-linear-to-t from-primary/90 via-primary/50 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300">
                                    </div>

                                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                        <h3 class="text-2xl font-bold mb-2">{{ $item['name'] ?? '' }}</h3>
                                        @if (!empty($item['description']))
                                            <p class="text-white/90 text-sm leading-relaxed">{{ $item['description'] }}</p>
                                        @endif
                                        <div
                                            class="mt-4 inline-flex items-center text-secondary font-semibold group-hover:gap-2 transition-all duration-300">
                                            Learn more
                                            <svg class="ml-1 w-5 h-5 group-hover:translate-x-1 transition-transform duration-300"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            {{-- No items placeholder --}}
                            <div class="col-span-2 text-center py-12">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 mb-4">
                                    <svg class="w-8 h-8 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                </div>
                                <p class="text-gray-500 dark:text-slate-400">Belum ada program yang ditampilkan.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Buttons --}}
                    @if (!empty($buttons))
                        <div class="text-center mt-10">
                            @foreach ($buttons as $button)
                                @if ($button['show'] ?? true)
                                    <a href="{{ $button['url'] ?? '#' }}"
                                        {{ Illuminate\Support\Str::startsWith($button['url'] ?? '', '/') ? 'wire:navigate.hover' : '' }}
                                        class="border-2 border-primary dark:border-white text-primary dark:text-white hover:bg-primary dark:hover:bg-white hover:text-white dark:hover:text-slate-900 px-8 py-3 rounded-lg font-semibold transition-all duration-300 inline-flex items-center gap-2">
                                        {{ $button['label'] ?? 'Lihat Semua' }}
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        @endif
    @endif
</div>