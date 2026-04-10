<div class="min-h-screen bg-gray-50 dark:bg-slate-900">

    {{-- header --}}
    <x-bale-dindik::header-page :title="$post->title" :breadcrumbs="[['label' => 'Semua Berita', 'url' => route('bale.post-list')], ['label' => $post->title]]" :meta="$post->created_at" />

    {{-- Main Content Section --}}
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                    {{-- Left Column: Post detail --}}
                    <div class="lg:col-span-8">
                        {{-- Featured Image --}}
                        @if ($post->thumbnail)
                            <div class="mb-10 rounded-2xl overflow-hidden shadow-2xl">
                                <img src="{{ cdn_asset('thumbnails/' . $post->thumbnail) }}"
                                    alt="{{ $post->title }}" class="w-full h-auto object-cover max-h-[500px]" />
                            </div>
                        @endif

                        {{-- Post Content --}}
                        <article class="max-w-none">
                            <div class="prose prose-lg dark:prose-invert max-w-none">
                                @if ($post->content)
                                    <x-emperan::editorjs-renderer :content="$post->content" />
                                @else
                                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">
                                        Tidak ada konten untuk ditampilkan.
                                    </p>
                                @endif
                            </div>
                        </article>

                        <div class="mt-12 flex justify-end">
                            <x-emperan::share-button 
                                :url="route('bale.view-post', $post->slug)"
                                :title="$post->title"
                                :text="$post->getExcerpt(160)"
                            />
                        </div>
                    </div>

                    {{-- Right Column: Sidebar (Suggested Posts) --}}
                    <div class="lg:col-span-4">
                        <livewire:bale-dindik.landing-page.post.section.suggested-posts :currentSlug="$post->slug" />
                    </div>

                </div>

                {{-- Share or Back Button (Placed below both columns on all screens) --}}
                <div
                    class="mt-16 flex items-center justify-between border-t border-gray-200 dark:border-slate-800 pt-8">
                    <a href="{{ route('bale.post-list') }}" wire:navigate.hover
                        class="inline-flex items-center gap-2 text-primary dark:text-white hover:text-primary/80 dark:hover:text-white/80 font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Semua Berita
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>