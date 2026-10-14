<?php

namespace Bale\BaleDindik\Livewire\LandingPage\Post;

use Bale\Umpak\Livewire\UmpakComponent;
use Livewire\Attributes\{Computed, Layout, Url};

#[Layout('bale-dindik::layouts.app')]
class PostList extends UmpakComponent
{
    public int $amount = 9;

    #[Url]
    public string $search = '';

    #[Url]
    public string $date = '';

    public function updated($property): void
    {
        // Reset amount when search or date filter changes
        if (in_array($property, ['search', 'date'])) {
            $this->amount = 9;
        }
    }

    public function loadMore(): void
    {
        $this->amount += 9;
    }

    public function clearFilters(): void
    {
        $this->search = '';
        $this->date = '';
        $this->amount = 9;
    }

    #[Computed]
    public function posts()
    {
        return $this->searchPosts($this->amount, $this->search, $this->date);
    }

    #[Computed]
    public function hasMore(): bool
    {
        return $this->countSearchPosts($this->search, $this->date) > $this->amount;
    }

    public function render()
    {
        return view('bale-dindik::livewire.landing-page.post.post-list');
    }
}
