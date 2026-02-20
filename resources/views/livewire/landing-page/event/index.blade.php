<div>
    @if ($actived)
        @if (empty($section) || empty($this->meta))
            {{-- Error Handler: Section Not Found --}}
            <x-emperan::section-error title="Konten Event Tidak Ditemukan"
                message="Silakan konfigurasi metadata section ini di panel admin CMS Anda.">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary/40" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </x-slot:icon>
            </x-emperan::section-error>
        @else
            @php
                $meta = $this->meta;
                $title = $meta['title'] ?? 'Acara dan Pengumuman';
                $subtitle = $meta['subtitle'] ?? null;
                $buttons = $meta['buttons'] ?? [];
            @endphp

            <section id="events" class="py-20 bg-neutral dark:bg-slate-900" x-data="eventSection({
                                                events: @js($this->availableEvents),
                                            })" x-cloak>
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

                    <div class="max-w-4xl mx-auto space-y-6">
                        <template x-for="event in eventsData">
                            <div
                                class="bg-white dark:bg-slate-800 rounded-lg p-6 border border-gray-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary hover:shadow-lg transition-all duration-300 group">
                                <div class="flex gap-6">
                                    <div class="shrink-0">
                                        <div
                                            class="w-20 h-20 bg-primary text-white rounded-lg flex flex-col items-center justify-center group-hover:bg-secondary group-hover:text-primary transition-all duration-300">
                                            <span class="text-2xl font-bold"
                                                x-text="new Date(event.date + 'T00:00:00').getDate()"></span>
                                            <span class="text-xs uppercase font-semibold"
                                                x-text="new Date(event.date + 'T00:00:00').toLocaleDateString('id-ID', { month: 'short' })"></span>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-primary dark:text-white mb-2 group-hover:text-secondary transition-colors duration-300"
                                            x-text="event.name"></h3>
                                        <p class="text-gray-600 dark:text-slate-400 mb-3" x-text="event.description"></p>
                                        <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-slate-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span x-text="formatDate(event.date)"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    {{-- Buttons --}}
                    @if (!empty($buttons))
                        <div class="text-center mt-10">
                            @foreach ($buttons as $button)
                                @if ($button['show'] ?? true)
                                    <a href="{{ $button['url'] ?? '#' }}" {{ Illuminate\Support\Str::startsWith($button['url'] ?? '', '/') ? 'wire:navigate.hover' : '' }}
                                        class="text-primary dark:text-white font-semibold hover:text-secondary transition-colors duration-300 inline-flex items-center gap-2 text-lg">
                                        {{ $button['label'] ?? 'View All Events' }}
                                        @if (!empty($button['icon_svg']))
                                            {!! $button['icon_svg'] !!}
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                                </path>
                                            </svg>
                                        @endif
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
            <script>
                function eventSection ( { events } )
                {
                    return {
                        eventsData: events,

                        formatDate ( dateString )
                        {
                            const options = { year: 'numeric', month: 'long', day: 'numeric' };
                            return new Date( dateString + 'T00:00:00' ).toLocaleDateString( 'id-ID', options );
                        },
                    }
                }
            </script>
        @endif
    @endif
</div>