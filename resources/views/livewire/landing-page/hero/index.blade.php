<section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden">

    <!-- Background -->
    <div class="absolute inset-0 z-0">

        @if(!empty($hero['backgrounds']))
            @foreach($hero['backgrounds'] as $bg)
                @if($bg['type'] === 'image')
                    <img src="{{ cdn_asset('landing-page/' . $bg['path']) }}"
                        alt="{{ $bg['alt'] ?? '' }}" class="w-full h-full object-cover absolute inset-0" loading="lazy" decoding="async" />
                @endif
            @endforeach
        @endif

        <!-- Overlay -->
        <div class="absolute inset-0 bg-linear-to-r from-primary/95 via-primary/85 to-primary/75"></div>
    </div>

    <!-- Content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl">

            {{-- APP/ORG NAME BADGE --}}
            @if(!empty($hero['organization'] ?? false))
                <div
                    class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-6 border border-white/20">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-sparkles-icon w-4 h-4 text-yellow-400">
                        <path
                            d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z" />
                        <path d="M20 2v4" />
                        <path d="M22 4h-4" />
                        <circle cx="4" cy="20" r="2" />
                    </svg>

                    <span class="text-white text-sm font-medium">
                        {{ $hero['organization'] }}
                    </span>
                </div>
            @endif


            {{-- TITLE --}}
            @if(($hero['show_title'] ?? false) && !empty($hero['title']))
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    {{ $hero['title'] }}
                </h1>
            @endif

            {{-- SUBTITLE --}}
            @if(($hero['show_subtitle'] ?? false) && !empty($hero['subtitle']))
                <p class="text-lg sm:text-xl text-white/90 mb-8 max-w-2xl leading-relaxed">
                    {!! nl2br(e($hero['subtitle'])) !!}
                </p>
            @endif


            {{-- BUTTONS --}}
            @if(!empty($hero['buttons']))
                <div class="flex flex-col sm:flex-row gap-4">
                    @foreach($hero['buttons'] as $button)
                        @if($button['show'])
                            <a href="{{ $button['url'] }}" target="{{ $button['target'] ?? '_self' }}"
                            {{ Illuminate\Support\Str::startsWith($button['url'], '/') ? 'wire:navigate.hover' : '' }}
                                class="{{ $button['class'] ?? 'bg-white text-primary' }}">

                                {{ $button['label'] }}

                                @if(str_contains(($button['class'] ?? ''), 'primary'))
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                @endif
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif

        </div>
    </div>

    <!-- Bottom Gradient -->
    <div
        class="absolute bottom-0 left-0 right-0 h-24 bg-linear-to-t from-neutral dark:from-slate-900 to-transparent z-10">
    </div>

</section>