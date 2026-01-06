<footer class="bg-primary dark:bg-slate-950 text-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            {{-- ABOUT (FROM HERO SECTION) --}}
            <div>
                <h3 class="font-bold text-lg mb-6">{{ $this->about->name }}</h3>

                <ul class="space-y-2">
                    @if(($this->about->content['show_title'] ?? false) && !empty($this->about->content['title']))
                        <li class="text-white/80 text-sm leading-relaxed">
                            {{ $this->about->content['title'] }}
                        </li>
                    @endif
                </ul>
            </div>

            {{-- QUICK LINK SECTIONS --}}
            <div>
                <h3 class="font-bold text-lg mb-6">Menu Cepat</h3>
                @foreach ($this->availableItems['link cepat'] ?? [] as $name => $link)
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ $link['url'] }}" class="text-white/80 text-sm">
                                {{ $name }}
                            </a>
                        </li>
                    </ul>
                @endforeach
            </div>

            {{-- contact --}}
            <div>
                <h3 class="font-bold text-lg mb-6">Kontak kami</h3>
                @foreach ($this->availableItems['contact'] ?? [] as $name => $contact)
                    <ul class="space-y-3">
                        <li>
                            {{ $contact }}
                        </li>
                    </ul>
                @endforeach
            </div>

            {{-- social --}}
            <div>
                <h3 class="font-bold text-lg mb-6">Terhubung dengan Kami</h3>
                @foreach ($this->availableItems['social'] ?? [] as $name => $social)
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ $social['url'] ?? '' }}" class="text-white/80 text-sm">
                                {{ $name }}
                            </a>
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>

    </div>

    <div class="border-t border-white/10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-white/60">
                <p>&copy; Bale CMS {{date('Y')}}. Template By Dinas Kominfo dan Statistik Kabupaten Ponorogo</p>
                {{-- <div class="flex gap-6">
                    <a href="#" class="hover:text-secondary transition-colors duration-300">Privacy Policy</a>
                    <a href="#" class="hover:text-secondary transition-colors duration-300">Public Information</a>
                </div> --}}
            </div>
        </div>
    </div>
</footer>