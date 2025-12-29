<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\Event;

use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Paparee\BaleEmperan\Models\Section;

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public array $section = [];

    public function mount()
    {
        $section = Section::whereSlug('event-announcement-section')->first();

        $this->section = $section?->content ?? [];
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.event.index');
    }

    #[Computed]
    public function availableEvents()
    {
        $items = $this->section['items'] ?? [];

        return collect($items)
            ->filter(fn($item) => $item['date'] >= now()->toDateString())
            ->sortBy('date') // Nearest first
            ->take(6)
            ->values();
    }
}