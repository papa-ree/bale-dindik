@props([
    'title',
    'breadcrumbs' => [],
    'subtitle' => null,
    'meta' => null,
])

<section class="relative bg-linear-to-r from-primary to-primary/80 text-white py-20 mt-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            {{-- Breadcrumb --}}
            @if(count($breadcrumbs) > 0)
                <nav class="flex justify-center mb-6" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('index') }}" wire:navigate.hover
                                class="inline-flex items-center text-sm font-medium text-white/80 hover:text-white transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Home
                            </a>
                        </li>
                        @foreach($breadcrumbs as $breadcrumb)
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-white/60" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    @if(isset($breadcrumb['url']))
                                        <a href="{{ $breadcrumb['url'] }}" wire:navigate.hover class="ml-1 text-sm font-medium text-white/80 hover:text-white md:ml-2">
                                            {{ $breadcrumb['label'] }}
                                        </a>
                                    @else
                                        <span class="ml-1 text-sm font-medium text-white md:ml-2">{{ $breadcrumb['label'] }}</span>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </nav>
            @endif

            {{-- Title --}}
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                {{ $title }}
            </h1>

            {{-- Subtitle / Excerpt --}}
            @if($subtitle)
                <p class="text-lg text-white/90 max-w-2xl mx-auto">
                    {{ $subtitle }}
                </p>
            @endif

            {{-- Meta Information --}}
            @if($meta)
                <div class="mt-4 flex items-center justify-center gap-4 text-sm text-white/70">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        {{ $meta }}
                    </span>
                </div>
            @endif
        </div>
    </div>
</section>
