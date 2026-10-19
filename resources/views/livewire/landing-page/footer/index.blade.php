@if (empty($section) || empty($this->meta))
    {{-- Error Handler: Footer Section Not Found --}}
    <footer class="bg-primary dark:bg-slate-950 text-white">
        <div class="border-t border-white/10">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="text-center text-sm text-white/60">
                    <p>&copy; Bale CMS {{ date('Y') }}. Template By Dinas Kominfo dan Statistik Kabupaten Ponorogo</p>
                </div>
            </div>
        </div>
    </footer>
@else
    @php
        $meta = $this->meta;
        $order = $meta['order'] ?? ['quick link', 'contact'];
        $parsed = $this->parsedItems;
        $quickLinks = $parsed['quick_link'] ?? [];
        $contacts = $parsed['contact'] ?? [];
        $socials = $parsed['social'] ?? [];

        // About info from hero section
        $aboutMeta = $this->about;
        $orgName = $aboutMeta['custom']['organization_name'] ?? null;
        $orgTitle = $aboutMeta['title'] ?? null;
    @endphp

    <footer class="bg-primary dark:bg-slate-950 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

                {{-- ABOUT (FROM HERO SECTION) --}}
                <div>
                    @if ($orgName)
                        <h3 class="font-bold text-lg mb-6">{{ $orgName }}</h3>
                    @endif
                    @if ($orgTitle)
                        <ul class="space-y-2">
                            <li class="text-white/80 text-sm leading-relaxed">
                                {{ $orgTitle }}
                            </li>
                        </ul>
                    @endif
                </div>

                {{-- QUICK LINKS --}}
                <div>
                    <h3 class="font-bold text-lg mb-6">Menu Cepat</h3>
                    @if (!empty($quickLinks))
                        <ul class="space-y-3">
                            @foreach ($quickLinks as $link)
                                <li>
                                    <a href="{{ $link['url'] }}" {{ Illuminate\Support\Str::startsWith($link['url'], '/') ? 'wire:navigate.hover' : '' }}
                                        class="inline-flex items-center gap-2 text-white/80 text-sm hover:text-white transition-colors duration-300">
                                        @if (!empty($link['icon_svg']))
                                            <span class="w-4 h-4 shrink-0 flex items-center justify-center [&>svg]:w-4 [&>svg]:h-4">
                                                {!! $link['icon_svg'] !!}
                                            </span>
                                        @endif
                                        {{ $link['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-white/40 text-sm">Belum ada tautan.</p>
                    @endif
                </div>

                {{-- CONTACT --}}
                <div>
                    <h3 class="font-bold text-lg mb-6">Kontak Kami</h3>
                    @if (!empty($contacts))
                        <ul class="space-y-3">
                            @foreach ($contacts as $contact)
                                <li class="flex items-start gap-2 text-white/80 text-sm">
                                    @if (!empty($contact['icon_svg']))
                                        <span class="w-4 h-4 mt-0.5 shrink-0 flex items-center justify-center [&>svg]:w-4 [&>svg]:h-4">
                                            {!! $contact['icon_svg'] !!}
                                        </span>
                                    @endif

                                    @if ($contact['type'] === 'email')
                                        <a href="mailto:{{ $contact['value'] }}"
                                            class="hover:text-white transition-colors duration-300">{{ $contact['value'] }}</a>
                                    @elseif ($contact['type'] === 'phone')
                                        <a href="tel:{{ $contact['value'] }}"
                                            class="hover:text-white transition-colors duration-300">{{ $contact['value'] }}</a>
                                    @else
                                        <span>{{ $contact['value'] }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-white/40 text-sm">Belum ada informasi kontak.</p>
                    @endif
                </div>

                {{-- SOCIAL MEDIA --}}
                <div>
                    <h3 class="font-bold text-lg mb-6">Terhubung dengan Kami</h3>
                    @if (!empty($socials))
                        <ul class="space-y-3 flex flex-wrap gap-4">
                            @foreach ($socials as $social)
                                <li>
                                    <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                                        class="text-white/80 text-sm hover:text-white transition-colors duration-300 inline-flex items-center gap-2 group">
                                        <span class="w-5 h-5 shrink-0 flex items-center justify-center [&>svg]:w-5 [&>svg]:h-5">
                                            @if (!empty($social['icon']))
                                                {!! $social['icon'] !!}
                                            @else
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                                </svg>
                                            @endif
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-white/40 text-sm">Belum ada media sosial.</p>
                    @endif
                </div>

            </div>
        </div>

        <div class="border-t border-white/10">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-white/60">
                    <p>&copy; Bale CMS {{ date('Y') }}. Template By Dinas Kominfo dan Statistik Kabupaten Ponorogo</p>
                </div>
            </div>
        </div>
    </footer>
@endif
