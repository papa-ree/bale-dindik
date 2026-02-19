@if (empty($hero) || empty($this->meta))
    {{-- Error Handler: Section Not Found --}}
    <section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden bg-slate-50 border-y border-slate-200">
        <div class="container mx-auto px-4 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-primary/10 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 mb-2">Konten Hero Tidak Ditemukan</h2>
            <p class="text-slate-500 max-w-md mx-auto">Silakan konfigurasi metadata section ini di panel admin CMS Anda agar tampil di halaman utama.</p>
        </div>
    </section>
@else
    @php
        $meta = $this->meta;
        $background = $meta['background'] ?? null;
        $images = $background['images'] ?? [];
        $organization = $meta['custom']['organization_name'] ?? null;
        $buttons = $meta['buttons'] ?? [];
    @endphp

    <section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden">

        <!-- Background -->
        <div class="absolute inset-0 z-0">
            @if (!empty($images))
                @foreach ($images as $bg)
                    @if (($background['type'] ?? 'image') === 'image')
                        <img src="{{ $bg['cdn_url'] ?? cdn_asset($bg['path'] ?? '') }}"
                            alt="{{ $bg['alt'] ?? ($meta['title'] ?? '') }}"
                            class="w-full h-full object-cover absolute inset-0" loading="lazy" decoding="async" />
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
                @if ($organization)
                    <div
                        class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-6 border border-white/20">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-sparkles-icon w-4 h-4 text-yellow-400">
                            <path
                                d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z" />
                            <path d="M20 2v4" />
                            <path d="M22 4h-4" />
                            <circle cx="4" cy="20" r="2" />
                        </svg>

                        <span class="text-white text-sm font-medium">
                            {{ $organization }}
                        </span>
                    </div>
                @endif


                {{-- TITLE --}}
                @if (!empty($meta['title']))
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                        {{ $meta['title'] }}
                    </h1>
                @endif

                {{-- SUBTITLE --}}
                @if (!empty($meta['subtitle']))
                    <p class="text-lg sm:text-xl text-white/90 mb-8 max-w-2xl leading-relaxed">
                        {!! nl2br(e($meta['subtitle'])) !!}
                    </p>
                @endif


                {{-- BUTTONS --}}
                @if (!empty($buttons))
                    <div class="flex flex-col sm:flex-row gap-4 z-20">
                        @foreach ($buttons as $button)
                            @if ($button['show'] ?? true)
                                <a href="{{ $button['url'] }}" target="{{ $button['target'] ?? '_self' }}"
                                    {{ Illuminate\Support\Str::startsWith($button['url'] ?? '', '/') ? 'wire:navigate.hover' : '' }}
                                    class="{{ $button['class'] ?? ($loop->first ? 'inline-flex items-center justify-center px-8 py-3 rounded-xl font-bold transition-all duration-300 bg-white text-primary hover:bg-neutral-100 hover:shadow-lg hover:-translate-y-0.5' : 'inline-flex items-center justify-center px-8 py-3 rounded-xl font-bold transition-all duration-300 bg-white/10 text-white border border-white/20 backdrop-blur-sm hover:bg-white/20 hover:shadow-lg hover:-translate-y-0.5') }} z-20">

                                    {{ $button['label'] }}

                                    @if (str_contains($button['class'] ?? '', 'primary') || !isset($button['class']))
                                        @if ($loop->first)
                                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        @endif
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
            class="absolute bottom-0 left-0 right-0 h-16 bg-linear-to-t from-neutral dark:from-slate-900 to-transparent z-10">
        </div>

    </section>
@endif