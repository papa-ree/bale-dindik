<div>
    @if ($section)
        @if (empty($section->meta))
            {{-- Error Handler: Section Not Found --}}
            <x-umpak::section-error title="Konten About Tidak Ditemukan"
                message="Silakan konfigurasi metadata section ini di panel admin CMS Anda." />
        @else
            @php
                $meta = $section->meta;
                $custom = $meta['custom'] ?? [];
                $title = $meta['title'] ?? null;
                $images = $meta['background']['images'] ?? [];
                $leaderPhoto = $images[0]['cdn_url'] ?? null;
                $leaderName = $custom['nama_pimpinan'] ?? null;
                $leaderTitle = $custom['jabatan'] ?? null;
                $testimony = $custom['testimoni'] ?? null;
                $buttons = $meta['buttons'] ?? [];
            @endphp

            <section id="about" class="py-20 bg-neutral dark:bg-slate-900">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">

                    <!-- Leadership -->
                    <div class="max-w-5xl mx-auto mb-20">
                        <div class="text-center mb-12">
                            @if ($title)
                                <h2 class="text-3xl sm:text-4xl font-bold text-primary dark:text-white mb-4">
                                    {{ $title }}
                                </h2>
                            @endif
                        </div>

                        <div
                            class="bg-white dark:bg-slate-800 rounded-lg p-8 md:p-12 border border-gray-200 dark:border-slate-700 shadow-lg">
                            <div class="flex flex-col md:flex-row gap-8 items-center">
                                <div class="shrink-0">
                                    @if ($leaderPhoto)
                                        <img src="{{ $leaderPhoto }}" alt="{{ $leaderName ?? 'Pimpinan' }}"
                                            class="w-48 h-48 rounded-lg object-cover shadow-md" loading="lazy" decoding="async" />
                                    @else
                                        <div
                                            class="w-48 h-48 rounded-lg bg-gray-100 dark:bg-slate-700 flex items-center justify-center shadow-md">
                                            <svg class="w-20 h-20 text-gray-300 dark:text-slate-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 text-center md:text-left">
                                    @if ($leaderName)
                                        <h3 class="text-2xl font-bold text-primary dark:text-white mb-2">
                                            {{ $leaderName }}
                                        </h3>
                                    @endif
                                    @if ($leaderTitle)
                                        <p class="text-secondary font-semibold mb-4">
                                            {{ $leaderTitle }}
                                        </p>
                                    @endif
                                    @if ($testimony)
                                        <p class="text-gray-600 dark:text-slate-400 leading-relaxed">
                                            {{ $testimony }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    @if (!empty($section->items))
                        @php
                            // CMS item bisa berupa skalar maupun struktur EditorJS (array).
                            // Normalisasi agar nilai array tidak memecahkan render.
                            $itemToText = function ($value): string {
                                if (is_string($value) || is_numeric($value)) {
                                    return (string) $value;
                                }

                                if (is_array($value)) {
                                    $texts = [];
                                    array_walk_recursive($value, function ($v, $k) use (&$texts) {
                                        if ($k === 'text' && is_string($v)) {
                                            $texts[] = $v;
                                        }
                                    });

                                    return trim(implode(' ', $texts));
                                }

                                return '';
                            };
                        @endphp

                        <div class="max-w-6xl mx-auto mb-20">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                                @foreach ($section->items as $item)
                                    @php
                                        $itemName = $itemToText($item['name'] ?? '');
                                        $itemCount = (int) preg_replace('/\D+/', '', $itemToText($item['count'] ?? ''));
                                    @endphp
                                    <div
                                        class="bg-white dark:bg-slate-800 rounded-lg p-8 text-center border border-gray-200 dark:border-slate-700 hover:shadow-lg transition-all duration-300">
                                        <div class="text-4xl md:text-5xl font-bold text-primary dark:text-white mb-2 odometer" x-data="{
                                                                                endVal: {{ $itemCount }},
                                                                                initOdometer() {
                                                                                    setTimeout(() => {
                                                                                        this.$el.innerHTML = this.endVal;
                                                                                    }, 100);
                                                                                }
                                                                            }" x-init="initOdometer()">
                                            0
                                        </div>
                                        <div class="text-gray-600 dark:text-slate-400 font-medium capitalize">
                                            {{ $itemName }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @assets
                    <link rel="stylesheet"
                        href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.7/themes/odometer-theme-default.min.css" />
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.7/odometer.min.js"></script>
                    <style>
                        .odometer {
                            font-family: inherit !important;
                        }
                    </style>
                    @endassets
                </div>
            </section>
        @endif
    @endif
</div>
