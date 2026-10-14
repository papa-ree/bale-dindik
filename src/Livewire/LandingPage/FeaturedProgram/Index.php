<?php

namespace Bale\BaleDindik\Livewire\LandingPage\FeaturedProgram;

use Bale\Umpak\Livewire\UmpakComponent;
use Livewire\Attributes\Computed;

class Index extends UmpakComponent
{
    public string $slug = 'featured-program-section';

    public function mount(?string $slug = null): void
    {
        if ($slug) {
            $this->slug = $slug;
        }
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.featured-program.index', [
            'section' => $this->section($this->slug),
        ]);
    }

    #[Computed]
    public function availablePrograms()
    {
        $section = $this->section($this->slug);

        $items = $section?->items ?? [];
        $postLimit = (int) $section?->meta('custom.post_limit', 4);

        return collect($items)
            ->map(function ($item) {
                return collect($item)->map(function ($value) {
                    return is_array($value) ? ($value[0] ?? null) : $value;
                })->toArray();
            })
            ->take($postLimit)
            ->values();
    }
}
