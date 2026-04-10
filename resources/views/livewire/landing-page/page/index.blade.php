<div class="min-h-screen bg-gray-50 dark:bg-slate-900">

    {{-- header --}}
    <x-bale-dindik::header-page :title="$page->title" :breadcrumbs="[['label' => $page->title]]"
        :subtitle="$page->getExcerpt()" />

    {{-- Page Content --}}
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">

                {{-- Page Content --}}
                <article class="max-w-none">
                    <div class="">
                        @if($page->content)
                            <x-emperan::editorjs-renderer :content="$page->content" />
                        @else
                            <p class="text-gray-500 dark:text-gray-400 text-center py-8">
                                Tidak ada konten untuk ditampilkan.
                            </p>
                        @endif
                    </div>
                </article>

                {{-- Share or Back Button --}}
                <div class="mt-12 flex justify-end">
                    <x-emperan::share-button :url="route('bale.view-page', $page->slug)" :title="$page->title"
                        :text="$page->getExcerpt(160)" />
                </div>
            </div>
        </div>
    </section>
</div>