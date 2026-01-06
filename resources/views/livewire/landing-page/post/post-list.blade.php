<div class="min-h-screen bg-gray-50 dark:bg-slate-900">

    {{-- header --}}
    <x-bale-dindik::header-page title="Semua Berita" :breadcrumbs="[['label' => 'Semua Berita']]"
        subtitle="Dapatkan informasi terbaru seputar kegiatan dan perkembangan Dinas Pendidikan Kabupaten Ponorogo." />

    {{-- Posts Grid --}}
    <section class="py-12 md:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto mb-16">
                @foreach ($this->posts as $post)
                    <div wire:key='{{ $post->slug }}'
                        class="bg-white rounded-lg overflow-hidden border border-gray-200 hover:border-primary hover:shadow-xl transition-all duration-300 cursor-pointer group">
                        <a href="{{ route('bale.view-post', $post->slug) }}" class="block">
                            <div class="relative overflow-hidden h-48">
                                @if ($post->thumbnail)
                                    <img src="{{ route('media.show', organization_slug() . '/thumbnails/' . $post->thumbnail) }}" alt=""
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                @else
                                    <div
                                        class="w-full h-full group-hover:scale-150 transition-transform duration-500 bg-gray-100 dark:bg-slate-700 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7">
                                        </path>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Load More Button --}}
            @if($this->hasMore)
                <div class="text-center">
                    <button wire:click="loadMore" wire:loading.attr="disabled"
                        class="bg-white border-2 border-primary text-primary hover:bg-primary hover:text-white px-10 py-4 rounded-xl font-bold transition-all duration-300 inline-flex items-center gap-3 group shadow-sm hover:shadow-xl">
                        <span wire:loading.remove>Muat Lebih Banyak</span>
                        <span wire:loading>Memuat...</span>

                        <svg wire:loading.remove class="w-5 h-5 group-hover:translate-y-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>

                        <svg wire:loading class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </section>
</div>