<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\Application;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Bale\Emperan\Models\Section;

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public string $slug = 'application-section';
    public array $section = [];
    public $actived;

    public function mount(?string $slug = null)
    {
        if ($slug) {
            $this->slug = $slug;
        }

        $sectionModel = Section::whereSlug($this->slug)->first();

        $this->section = $sectionModel?->content ?? [];
        $this->actived = $sectionModel?->actived ?? false;
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.application.index');
    }

    #[Computed]
    public function meta()
    {
        return $this->section['meta'] ?? [];
    }

    #[Computed]
    public function availableApps()
    {
        $items = $this->section['items'] ?? [];

        return collect($items)->map(function ($item) {
            if (!empty($item['icon'])) {
                $iconName = $item['icon'];
                try {
                    $item['icon_svg'] = Blade::render(
                        "<x-lucide-$iconName class='w-6 h-6' />"
                    );
                } catch (\Exception $e) {
                    $item['icon_svg'] = null;
                }
            }
            return $item;
        })->values();
    }

    #[Computed]
    public function availableCategories()
    {
        $categories = ['All'];

        foreach ($this->section['items'] ?? [] as $item) {
            if (!empty($item['category']) && !in_array($item['category'], $categories)) {
                $categories[] = $item['category'];
            }
        }

        return $categories;
    }
}