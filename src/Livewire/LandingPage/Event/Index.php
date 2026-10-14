<?php

namespace Bale\BaleDindik\Livewire\LandingPage\Event;

use Bale\Umpak\Livewire\UmpakComponent;
use Illuminate\Support\Facades\Blade;
use Livewire\Attributes\{Computed};

class Index extends UmpakComponent
{
    public string $slug = 'event-announcement-section';

    public function mount(?string $slug = null): void
    {
        if ($slug) {
            $this->slug = $slug;
        }
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.event.index', [
            'section' => $this->section($this->slug),
        ]);
    }

    #[Computed]
    public function meta()
    {
        $meta = $this->section($this->slug)?->meta ?? [];

        if (!empty($meta['buttons'])) {
            $meta['buttons'] = collect($meta['buttons'])->map(function ($button) {
                if (!empty($button['icon'])) {
                    try {
                        $iconName = $button['icon'];
                        $button['icon_svg'] = Blade::render(
                            "<x-lucide-$iconName class='w-5 h-5' />"
                        );
                    } catch (\Exception $e) {
                        $button['icon_svg'] = null;
                    }
                }
                return $button;
            })->toArray();
        }

        return $meta;
    }

    #[Computed]
    public function availableEvents()
    {
        $postLimit = (int) ($this->meta['custom']['event_limit'] ?? 4);

        return $this->upcomingAgendas($postLimit)
            ->map(fn ($agenda) => [
                'title' => $agenda->title,
                'description' => $agenda->description,
                'date' => $agenda->startDate->toDateString(),
            ])
            ->values();
    }
}
