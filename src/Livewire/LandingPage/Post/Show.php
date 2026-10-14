<?php

namespace Bale\BaleDindik\Livewire\LandingPage\Post;

use Bale\Umpak\Livewire\UmpakComponent;
use Livewire\Attributes\{Layout};

#[Layout('bale-dindik::layouts.app')]
class Show extends UmpakComponent
{
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $post = $this->post($this->slug);

        if (!$post) {
            abort(404, 'Berita tidak ditemukan');
        }

        return view('bale-dindik::livewire.landing-page.post.show', [
            'post' => $post,
        ])->layout('bale-dindik::layouts.app', [
            'title' => $post->title,
            'seoModel' => $post,
        ]);
    }
}
