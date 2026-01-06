<div>
    <section id="events" class="py-20 bg-neutral dark:bg-slate-900" x-data="eventSection({
        events: @js($this->availableEvents),
    })" x-cloak>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-primary dark:text-white mb-4">
                    Events & Announcements
                </h2>
                <p class="text-lg text-gray-600 dark:text-slate-400 max-w-2xl mx-auto">
                    Important dates and upcoming educational activities
                </p>
            </div>

            <div class="max-w-4xl mx-auto space-y-6">
                <template x-for="event in eventsData">
                    <div
                        class="bg-white dark:bg-slate-800 rounded-lg p-6 border border-gray-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary hover:shadow-lg transition-all duration-300 group">
                        <div class="flex gap-6">
                            <div class="shrink-0">
                                <div
                                    class="w-20 h-20 bg-primary text-white rounded-lg flex flex-col items-center justify-center group-hover:bg-secondary group-hover:text-primary transition-all duration-300">
                                    <span class="text-2xl font-bold" x-text="new Date(event.date).getDate()"></span>
                                    <span class="text-xs uppercase font-semibold"
                                        x-text="new Date(event.date).toLocaleDateString('id-ID', { month: 'short' })"></span>
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

            <div class="text-center mt-10">
                <a href="{{ $section['meta']['url'] ?? '#' }}" wire:navigate
                    class="text-primary dark:text-white font-semibold hover:text-secondary transition-colors duration-300 inline-flex items-center gap-2 text-lg">
                    {{ $section['meta']['url_text'] ?? 'View All Events' }}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </a>
            </div>
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
                    return new Date( dateString ).toLocaleDateString( 'id-ID', options );
                },
            }
        }
    </script>
</div>