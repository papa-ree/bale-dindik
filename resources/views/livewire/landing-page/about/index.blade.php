<div>
    <section id="about" class="py-20 bg-neutral">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Leadership -->
            <div class="max-w-5xl mx-auto mb-20">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-3xl sm:text-4xl font-bold text-primary mb-4">
                        @if(!empty($meta['title']))
                            {{$meta['title']}}
                        @endif
                    </h2>
                </div>

                <div class="bg-white rounded-lg p-8 md:p-12 border border-gray-200 shadow-lg" data-aos="fade-up">
                    <div class="flex flex-col md:flex-row gap-8 items-center">
                        <div class="shrink-0">
                            @if(!empty($meta['foto pimpinan']['path']))
                                <img src="{{ route('media.show', $meta['foto pimpinan']['path']) }}"
                                    alt="Dr. Suhartono, M.Pd." class="w-48 h-48 rounded-lg object-cover shadow-md" />
                            @endif
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h3 class="text-2xl font-bold text-primary mb-2">
                                {{$meta['nama pimpinan'] ?? 'kosong'}}
                            </h3>
                            <p class="text-secondary font-semibold mb-4">
                                {{$meta['jabatan'] ?? 'kosong'}}
                            </p>
                            <p class="text-gray-600 leading-relaxed">
                                {{$meta['testimoni'] ?? 'kosong'}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="max-w-6xl mx-auto mb-20">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach ($items as $loopIndex => $item)
                        <div class="bg-white rounded-lg p-8 text-center border border-gray-200 hover:shadow-lg transition-all duration-300"
                            data-aos="fade-up" data-aos-delay="{{ $loopIndex * 100 }}">
                            <div class="text-4xl md:text-5xl font-bold text-primary mb-2 odometer" x-data="{
                                                endVal: {{ $item['count'] ?? 0 }},
                                                initOdometer() {
                                                    // Odometer automatically watches for class 'odometer' and value changes
                                                    // We just need to set the value after a short delay to trigger animation
                                                    setTimeout(() => {
                                                        this.$el.innerHTML = this.endVal;
                                                    }, 100);
                                                }
                                            }" x-init="initOdometer()">
                                0
                            </div>
                            <div class="text-gray-600 font-medium">{{$item['name'] ?? 'kosong'}}</div>
                        </div>
                    @endforeach
                </div>
            </div>

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
</div>