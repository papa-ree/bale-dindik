<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\Event;

use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Bale\Emperan\Models\Section;

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public string $slug = 'event-announcement-section';
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
        return view('bale-dindik::livewire.landing-page.event.index');
    }

    #[Computed]
    public function meta()
    {
        $meta = $this->section['meta'] ?? [];

        if (!empty($meta['buttons'])) {
            $meta['buttons'] = collect($meta['buttons'])->map(function ($button) {
                if (!empty($button['icon'])) {
                    try {
                        $iconName = $button['icon'];
                        $button['icon_svg'] = \Illuminate\Support\Facades\Blade::render(
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
    public function items()
    {
        return $this->section['items'] ?? [];
    }

    #[Computed]
    public function availableEvents()
    {
        $postLimit = (int) ($this->meta['custom']['post_limit'] ?? 6);

        return collect($this->items)
            ->filter(fn($item) => ($item['date'] ?? '') >= now()->toDateString())
            ->sortBy('date')
            ->take($postLimit)
            ->values();
    }
}