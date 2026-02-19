<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\FeaturedProgram;

use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Bale\Emperan\Models\Section;

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public string $slug = 'featured-program-section';
    public array $section = [];
    public $actived;

    public function mount(?string $slug = null)
    {
        if ($slug) {
            $this->slug = $slug;
        }

        $section = Section::whereSlug($this->slug)->first();

        $this->section = $section?->content ?? [];
        $this->actived = $section?->actived;
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.featured-program.index');
    }

    #[Computed]
    public function meta()
    {
        return $this->section['meta'] ?? [];
    }

    #[Computed]
    public function items()
    {
        return $this->section['items'] ?? [];
    }

    #[Computed]
    public function availablePrograms()
    {
        $postLimit = (int) ($this->meta['custom']['post_limit'] ?? 4);

        return collect($this->items)
            ->map(function ($item) {
                // Normalize array-wrapped values to scalar
                return collect($item)->map(function ($value) {
                    return is_array($value) ? ($value[0] ?? null) : $value;
                })->toArray();
            })
            ->take($postLimit)
            ->values();
    }
}