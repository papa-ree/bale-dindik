<div>

    @if ($section['is_active'])
        <section id="news" class="py-20 bg-white">

            <div class="container mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Section Header --}}
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-3xl sm:text-4xl font-bold text-primary mb-4">
                        {{ $section['title'] }}
                    </h2>

                    @if ($section['subtitle'])
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                            {{ $section['subtitle'] }}
                        </p>
                    @endif
                </div>

                {{-- Posts Grid --}}
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ $section['layouts']['grid'] }} gap-8 max-w-7xl mx-auto mb-10">
                    @foreach ($this->availablePosts as $post)
                        <a href="{{ route('bale.view-post', $post->slug) }}" wire:key='{{ $post->slug }}'
                            class="bg-white rounded-lg overflow-hidden border border-gray-200 hover:border-primary hover:shadow-xl transition-all duration-300 cursor-pointer group block">
                            <div class="relative overflow-hidden h-48">
                                @if ($post->thumbnail)
                                    <img src="{{ route('media.show', organization()->slug . '/thumbnails/' . $post->thumbnail) }}" alt=""
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                @else
                                    <div class="w-full h-full group-hover:scale-150 transition-transform duration-500 bg-gray-100 dark:bg-slate-700 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="p-6">
                                <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ $post->created_at }}</span>
                                </div>

                                <h3
                                    class="font-bold text-primary mb-3 text-lg line-clamp-2 group-hover:text-secondary transition-colors duration-300">
                                    {{ $post->title }}
                                </h3>

                                <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                    {{ $post->excerpt(100) }}
                                </p>

                                <span
                                    class="text-primary text-sm font-semibold inline-flex items-center group-hover:text-secondary transition-colors duration-300">
                                    Read more
                                    <svg class="ml-1 w-4 h-4 group-hover:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                        </path>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
                {{-- Button --}}
                @foreach ($section['buttons'] as $index => $button)
                    @if ($button['show'])
                        <div class="text-center" data-aos="fade-up">
                            <a href="{{ $button['url'] ?? '#' }}"
                                class="border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-lg font-semibold transition-all duration-300 inline-flex items-center gap-2">
                                {{ $button['label'] ?? 'See All' }}
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    @endif
                @endforeach

            </div>
        </section>
    @endif

</div>