<div class="min-h-screen bg-gray-50 dark:bg-slate-900">
    <x-bale-dindik::header-page title="Agenda & Kegiatan" :breadcrumbs="[['label' => 'Agenda']]" />

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

            {{-- Main Content: Event List --}}
            <div class="lg:col-span-8 space-y-12">
                {{-- Loading Skeleton --}}
                <div wire:loading class="space-y-12 w-full">
                    <div class="relative">
                        <div class="sticky top-24 z-10 bg-gray-50/95 dark:bg-slate-900/95 backdrop-blur-sm py-4 mb-6 border-b border-gray-200 dark:border-slate-800">
                            <div class="h-8 w-48 bg-gray-200 dark:bg-slate-700 rounded animate-pulse"></div>
                        </div>
                        <div class="grid gap-6">
                            @foreach(range(1, 3) as $i)
                                <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-gray-100 dark:border-slate-700">
                                    <div class="flex flex-col sm:flex-row gap-6 animate-pulse">
                                        <div class="shrink-0 w-24 h-24 bg-gray-200 dark:bg-slate-700 rounded-xl"></div>
                                        <div class="grow space-y-4">
                                            <div class="h-6 bg-gray-200 dark:bg-slate-700 rounded w-3/4"></div>
                                            <div class="space-y-2">
                                                <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-full"></div>
                                                <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-2/3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div wire:loading.remove>
                    @forelse ($this->groupedEvents as $monthYear => $events)
                        <div class="relative">
                            <div class="sticky top-24 z-10 bg-gray-50/95 dark:bg-slate-900/95 backdrop-blur-sm py-4 mb-6 border-b border-gray-200 dark:border-slate-800">
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                                    <span class="w-1.5 h-8 bg-primary rounded-full"></span>
                                    {{ $monthYear }}
                                </h2>
                            </div>

                            <div class="grid gap-6">
                                @foreach ($events as $event)
                                    <div class="group bg-white dark:bg-slate-800 rounded-2xl p-6 border border-gray-100 dark:border-slate-700 hover:border-primary hover:shadow-lg transition-all duration-300">
                                        <div class="flex flex-col sm:flex-row gap-6">
                                            {{-- Date Badge --}}
                                            <div class="shrink-0 flex flex-row sm:flex-col items-center justify-center sm:w-24 bg-primary/5 dark:bg-primary/10 rounded-xl p-4 sm:p-2 text-center border border-primary/10">
                                                <span class="text-3xl font-bold text-primary block leading-none">
                                                    {{ \Carbon\Carbon::parse($event['date'])->format('d') }}
                                                </span>
                                                <span class="text-sm font-medium text-primary/80 uppercase tracking-wider mt-0 sm:mt-1 ml-2 sm:ml-0">
                                                    {{ \Carbon\Carbon::parse($event['date'])->format('M') }}
                                                </span>
                                            </div>

                                            {{-- Content --}}
                                            <div class="grow">
                                                <h3 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors mb-2">
                                                    @if(isset($event['url']) && $event['url'] !== '#')
                                                        <a href="{{ $event['url'] ?? '#' }}" target="_blank" class="hover:underline">
                                                            {{ $event['name'] }}
                                                        </a>
                                                        <svg class="w-4 h-4 inline-block text-gray-400 group-hover:text-primary ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                        </svg>
                                                    @else
                                                        {{ $event['name'] }}
                                                    @endif
                                                </h3>
                                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-4">
                                                    {{ $event['description'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-slate-800 mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Tidak ada agenda ditemukan</h3>
                            <p class="text-gray-500 dark:text-gray-400">Coba ubah filter pencarian atau tanggal.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-4 space-y-8">
                {{-- Filters --}}
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm sticky top-28">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Filter Agenda</h3>
                    
                    <div class="space-y-4">
                        {{-- Search --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cari Agenda</label>
                            <div class="relative flex gap-2">
                                <div class="relative grow">
                                    <input type="text" wire:model="search" wire:keydown.enter="$refresh" placeholder="Nama agenda..."
                                        class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all dark:text-white">
                                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <button wire:click="$refresh" type="button" class="px-4 py-2.5 bg-primary text-white font-medium rounded-xl hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20">
                                    Cari
                                </button>
                            </div>
                        </div>

                        {{-- Date Picker --}}
                        <div x-data="{
                            picker: null,
                            init() {
                                this.picker = flatpickr(this.$refs.picker, {
                                    mode: 'range',
                                    dateFormat: 'Y-m-d',
                                    defaultDate: @js($date),
                                    onChange: (selectedDates, dateStr) => {
                                        @this.set('date', dateStr);
                                    }
                                });
                            }
                        }">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Tanggal</label>
                            <div class="relative">
                                <input x-ref="picker" type="text" placeholder="Rentang tanggal..."
                                    class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all dark:text-white cursor-pointer">
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <button type="button" @click="@this.set('date', ''); picker.clear()" x-show="@this.date" class="absolute right-3 top-3 text-gray-400 hover:text-red-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Upcoming Events --}}
                @if($this->upcomingEvents->isNotEmpty())
                    <div class="bg-primary/5 dark:bg-primary/10 rounded-2xl p-6 border border-primary/10">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Segera Datang
                        </h3>
                        <div class="space-y-4">
                            @foreach ($this->upcomingEvents as $upcoming)
                                <div class="flex gap-4 items-start group">
                                    <div class="shrink-0 w-12 text-center bg-white dark:bg-slate-800 rounded-lg p-1 shadow-xs border border-gray-100 dark:border-slate-700">
                                        <span class="block text-xs font-bold text-primary">{{ \Carbon\Carbon::parse($upcoming['date'])->format('M') }}</span>
                                        <span class="block text-lg font-bold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($upcoming['date'])->format('d') }}</span>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-900 dark:text-white line-clamp-2 mb-1 group-hover:text-primary transition-colors">
                                            {{ $upcoming['name'] }}
                                        </h4>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ \Carbon\Carbon::parse($upcoming['date'])->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

@assets
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endassets
