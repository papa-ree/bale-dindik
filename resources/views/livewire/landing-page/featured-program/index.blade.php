<div>
    <section id="programs" class="py-20 bg-white dark:bg-slate-900">
        {{-- @dump($section) --}}
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-primary dark:text-white mb-4">
                    @if(!empty($section['meta']['title']))
                        {{ $section['meta']['title'] }}
                    @endif
                </h2>
                <p class="text-lg text-gray-600 dark:text-slate-400 max-w-2xl mx-auto">
                    @if(!empty($section['meta']['subtitle']))
                        {{ $section['meta']['subtitle'] }}
                    @endif
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
                @if(!empty($section['items']))
                    @foreach ($section['items'] as $item)
                        <a href="{{ $item['url'] }}" wire:navigate.hover
                            class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-gray-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary hover:shadow-xl transition-all duration-300 cursor-pointer group">
                            <div class="relative overflow-hidden h-64">
                                <img src="{{$item['image']}}" alt="{{$item['name']}}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                    loading="lazy" decoding="async" />

                                <div
                                    class="absolute inset-0 bg-linear-to-t from-primary/90 via-primary/50 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300">
                                </div>

                                <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                    <h3 class="text-2xl font-bold mb-2">{{ $item['name'] }}</h3>
                                    <p class="text-white/90 text-sm leading-relaxed">{{ $item['description'] }}</p>
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
                    @endforeach
                @endif
            </div>
        </div>
    </section>
</div>