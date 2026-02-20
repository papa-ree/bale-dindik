<div>
    @if($actived)
        @if (empty($section) || empty($this->meta))
            {{-- Error Handler: Section Not Found --}}
            <x-emperan::section-error title="Konten Aplikasi Tidak Ditemukan"
                message="Silakan konfigurasi metadata section ini di panel admin CMS Anda.">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary/40" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </x-slot:icon>
            </x-emperan::section-error>
        @else
            @php
                $meta = $this->meta;
                $title = $meta['title'] ?? null;
                $subtitle = $meta['subtitle'] ?? null;
            @endphp
            <section id="applications" class="py-20 bg-neutral dark:bg-slate-900" x-data="appSection({
                                apps: @js($this->availableApps),
                                categories: @js($this->availableCategories)
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

                    <!-- Search and Filter -->
                    <div class="max-w-4xl mx-auto mb-10">
                        <div class="relative mb-6">
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" x-model="searchQuery" placeholder="Search applications..."
                                class="w-full pl-12 pr-4 py-4 text-base border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-700 dark:text-white rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all placeholder:text-gray-400 dark:placeholder:text-slate-500" />
                            <!-- Clear Icon -->
                            <button x-show="searchQuery.length > 0" @click="searchQuery = ''"
                                class="absolute right-4 top-1/2 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-primary transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-x">
                                    <path d="M18 6 6 18" />
                                    <path d="m6 6 12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex flex-wrap gap-3 justify-center">
                            <template x-for="cat in categories" :key="cat">
                                <button @click="selectedCategory = cat"
                                    :class="selectedCategory === cat ? 'bg-primary text-white' : 'bg-white dark:bg-slate-800 text-gray-700 dark:text-slate-300 border border-gray-300 dark:border-slate-700 hover:border-primary dark:hover:border-primary hover:text-primary dark:hover:text-white'"
                                    class="px-5 py-2 text-sm capitalize font-medium rounded-lg transition-all duration-300"
                                    x-text="cat"></button>
                            </template>
                        </div>
                    </div>

                    <!-- Applications Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">

                        <!-- Jika tidak ada aplikasi -->
                        <div x-show="filteredApplications.length === 0"
                            class="bg-white dark:bg-slate-800 col-span-3 rounded-lg p-8 border border-gray-200 dark:border-slate-700 text-center shadow-sm">
                            <div class="flex flex-col items-center mx-auto w-full gap-4">

                                <!-- Icon (search slash / not found) -->
                                <div class="p-4 bg-red-50 dark:bg-red-900/20 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="lucide lucide-circle-off-icon lucide-circle-off text-red-500 dark:text-red-400">
                                        <path d="m2 2 20 20" />
                                        <path d="M8.35 2.69A10 10 0 0 1 21.3 15.65" />
                                        <path d="M19.08 19.08A10 10 0 1 1 4.92 4.92" />
                                    </svg>
                                </div>

                                <h3 class="text-lg font-semibold text-gray-700 dark:text-white">
                                    Aplikasi tidak ditemukan
                                </h3>

                                <p class="text-gray-500 dark:text-slate-400 text-sm max-w-sm">
                                    Tidak ada aplikasi yang sesuai pencarian atau kategori yang dipilih.
                                </p>
                            </div>
                        </div>

                        <!-- DAFTAR APLIKASI -->
                        <template x-if="filteredApplications.length > 0">
                            <template x-for="app in filteredApplications">
                                <a :href="app.url" target="_blank"
                                    class="bg-white dark:bg-slate-800 rounded-lg p-6 border border-gray-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary hover:shadow-xl transition-all duration-300 cursor-pointer group">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="p-3 bg-primary/5 rounded-lg group-hover:bg-primary transition-all duration-300">
                                            <div class="w-6 h-6 text-primary group-hover:text-white transition-all duration-300"
                                                x-html="app.icon_svg"></div>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-primary dark:text-white mb-1 text-lg capitalize"
                                                x-text="app.name">
                                            </h3>
                                            <p class="text-sm text-gray-600 dark:text-slate-400 mb-3 capitalize"
                                                x-text="app.description"></p>
                                            <span
                                                class="inline-block px-3 py-1 capitalize bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-300 text-xs rounded-full"
                                                x-text="app.category"></span>
                                        </div>
                                    </div>
                                </a>
                            </template>
                        </template>

                    </div>
                </div>
            </section>
            <script>
                function appSection ( { apps, categories } )
                {
                    return {
                        searchQuery: '',
                        selectedCategory: 'All',

                        applications: apps,
                        categories: categories,

                        get filteredApplications ()
                        {
                            return this.applications.filter( app =>
                            {
                                const q = this.searchQuery.toLowerCase();

                                const matchesSearch =
                                    app.name.toLowerCase().includes( q ) ||
                                    app.description.toLowerCase().includes( q );

                                const matchesCategory =
                                    this.selectedCategory === 'All' ||
                                    app.category === this.selectedCategory;

                                return matchesSearch && matchesCategory;
                            } );
                        },
                    }
                }
            </script>
        @endif
    @endif
</div>