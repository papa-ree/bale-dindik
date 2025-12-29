<?php

namespace Paparee\BaleDindik\Livewire\LandingPage\Post;

use Livewire\Component;
use Livewire\Attributes\{Layout};
use Bale\Emperan\Models\Post;

#[Layout('bale-dindik::layouts.app')]
class Show extends Component
{
    public $post;

    public function mount(string $post)
    {
        $this->post = Post::whereSlug($post)
            ->wherePublished(true)
            ->first();

        if (!$this->post) {
            abort(404, 'Berita tidak ditemukan');
        }

        if (method_exists($this->post, 'visit')) {
            $this->post->visit()->increment();
        }
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.post.show', [
            'post' => $this->post
        ]);
    }
}
