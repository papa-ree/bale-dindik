<?php

namespace Bale\BaleDindik\Livewire\LandingPage\Page;

use Bale\Umpak\Livewire\UmpakComponent;
use Livewire\Attributes\{Layout};

#[Layout('bale-dindik::layouts.app')]
class Index extends UmpakComponent
{
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $page = $this->page($this->slug);

        if (!$page) {
            abort(404, 'Halaman tidak ditemukan');
        }

        return view('bale-dindik::livewire.landing-page.page.index', [
            'page' => $page,
        ])->layout('bale-dindik::layouts.app', [
            'title' => $page->title,
            'seoModel' => $page,
        ]);
    }
}
