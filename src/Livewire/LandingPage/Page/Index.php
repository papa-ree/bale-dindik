<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\Page;

use Livewire\Component;
use Livewire\Attributes\{Layout};
use Bale\Emperan\Models\Page;

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public $page;

    public function mount(string $page)
    {
        $this->page = Page::whereSlug($page)->first();

        // Jika halaman tidak ditemukan, redirect atau tampilkan 404
        if (!$this->page) {
            abort(404, 'Halaman tidak ditemukan');
        }
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.page.index', [
            'page' => $this->page
        ])->layoutData([
                    'title' => $this->page->meta_title ?: $this->page->title,
                    'description' => $this->page->meta_description,
                    'keywords' => $this->page->meta_keywords,
                ]);
    }
}
