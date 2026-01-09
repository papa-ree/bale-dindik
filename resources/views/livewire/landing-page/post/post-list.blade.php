<div class="min-h-screen bg-gray-50 dark:bg-slate-900">

    {{-- header --}}
    <x-bale-dindik::header-page title="Semua Berita" :breadcrumbs="[['label' => 'Semua Berita']]"
        subtitle="Dapatkan informasi terbaru seputar kegiatan dan perkembangan Dinas Pendidikan Kabupaten Ponorogo." />

    {{-- Search Form Sticky --}}
    <section class="sticky top-20 z-20 bg-gray-50/95 dark:bg-slate-900/95 backdrop-blur-sm border-b border-gray-200 dark:border-slate-800 py-6">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                        {{-- Search Input --}}
                        <div class="lg:col-span-5">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cari Berita</label>
                            <div class="relative">
                                <input type="text" wire:model="search" wire:keydown.enter="$refresh" 
                                    placeholder="Judul berita..."
                                    class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all dark:text-white">
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>

                        {{-- Date Picker --}}
                        <div class="lg:col-span-5" x-data="{
                            picker: null,
                            init() {
                                this.picker = flatpickr(this.$refs.picker, {
                                    mode: 'range',
                                    dateFormat: 'Y-m-d',
                                    defaultDate: @js($date),
                                    onChange: (selectedDates, dateStr) => {
                                        @this.set('date', dateStr);
                                    }
                                });
                            }
                        }">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Tanggal</label>
                            <div class="relative">
                                <input x-ref="picker" type="text" placeholder="Rentang tanggal..."
                                    class="w-full pl-10 pr-10 py-2.5 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all dark:text-white cursor-pointer">
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <button type="button" @click="@this.set('date', ''); picker.clear()" 
                                    x-show="@this.date" 
                                    class="absolute right-3 top-3 cursor-pointer text-gray-400 hover:text-red-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="lg:col-span-2 flex items-end gap-2">
                            <button wire:click="$refresh" type="button" 
                                class="flex-1 px-4 py-2.5 bg-primary text-white cursor-pointer font-medium rounded-xl hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20">
                                Cari
                            </button>
                            @if($search || $date)
                                <button wire:click="search = ''; date = ''" @click="$wire.$refresh()" type="button" 
                                    class="px-4 py-2.5 bg-gray-100 dark:bg-slate-700 cursor-pointer text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors"
                                    title="Reset Filter">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Posts Grid --}}
    <section class="py-12 md:py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Skeleton Loading --}}
            <div wire:loading class="w-full">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto mb-16">
                    @foreach(range(1, 3) as $i)
                        <div class="bg-white dark:bg-slate-800 rounded-lg overflow-hidden border border-gray-200 dark:border-slate-700 animate-pulse">
                            <div class="block">
                                {{-- Image Placeholder --}}
                                <div class="relative overflow-hidden h-48 bg-gray-200 dark:bg-slate-700"></div>

                                <div class="p-6">
                                    {{-- Date Meta --}}
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="w-4 h-4 bg-gray-200 dark:bg-slate-700 rounded-full"></div>
                                        <div class="h-4 w-24 bg-gray-200 dark:bg-slate-700 rounded"></div>
                                    </div>

                                    {{-- Title --}}
                                    <div class="mb-3 space-y-2">
                                        <div class="h-5 bg-gray-200 dark:bg-slate-700 rounded w-full"></div>
                                        <div class="h-5 bg-gray-200 dark:bg-slate-700 rounded w-3/4"></div>
                                    </div>

                                    {{-- Excerpt --}}
                                    <div class="mb-4 space-y-2">
                                        <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-full"></div>
                                        <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-full"></div>
                                        <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-2/3"></div>
                                    </div>

                                    {{-- Read More --}}
                                    <div class="flex items-center gap-1">
                                        <div class="h-4 w-20 bg-gray-200 dark:bg-slate-700 rounded"></div>
                                        <div class="w-4 h-4 bg-gray-200 dark:bg-slate-700 rounded"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div wire:loading.remove class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto mb-16">
                @forelse ($this->posts as $post)
                    <div wire:key='{{ $post->slug }}'
                        class="bg-white dark:bg-slate-800 rounded-lg overflow-hidden border border-gray-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary hover:shadow-xl transition-all duration-300 cursor-pointer group">
                        <a href="{{ route('bale.view-post', $post->slug) }}" class="block" wire:navigate.hover>
                            <div class="relative overflow-hidden h-48">
                                @if ($post->thumbnail)
                                    <img src="{{ route('media.show', organization_slug() . '/thumbnails/' . $post->thumbnail) }}"
                                        alt=""
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
                                <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-slate-400 mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ $post->created_at }}</span>
                                </div>

                                <h3
                                    class="font-bold text-primary dark:text-white mb-3 text-lg line-clamp-2 group-hover:text-secondary transition-colors duration-300">
                                    {{ $post->title }}
                                </h3>

                                <p class="text-gray-600 dark:text-slate-400 text-sm line-clamp-3 mb-4">
                                    {{ $post->excerpt(100) ?? 'Belum ada konten' }}
                                </p>

                                <span
                                    class="text-primary dark:text-white text-sm font-semibold inline-flex items-center group-hover:text-secondary transition-colors duration-300">
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
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-slate-800 mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Tidak ada berita ditemukan</h3>
                        <p class="text-gray-500 dark:text-gray-400">Coba ubah filter pencarian atau tanggal.</p>
                    </div>
                @endforelse
            </div>

            {{-- Load More Button --}}
            @if($this->hasMore)
                <div class="text-center">
                    <button wire:click="loadMore" wire:loading.attr="disabled"
                        class="bg-white dark:bg-slate-800 border-2 border-primary dark:border-white text-primary dark:text-white hover:bg-primary dark:hover:bg-white hover:text-white dark:hover:text-slate-900 px-10 py-4 rounded-xl font-bold transition-all duration-300 inline-flex items-center gap-3 group shadow-sm hover:shadow-xl">
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

@assets
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endassets