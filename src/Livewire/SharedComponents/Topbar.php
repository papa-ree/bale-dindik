<?php

namespace Paparee\BaleDindik\Livewire\SharedComponents;

use Livewire\Component;
use Livewire\Attributes\{Computed, Layout};
use Bale\Emperan\Models\Navigation;

#[Layout('bale-dindik::layouts.app')]
class Topbar extends Component
{
    public function render()
    {
        return view('bale-dindik::livewire.shared-components.topbar');
    }

    #[Computed]
    public function availableNavs()
    {
        return Navigation::with('children')->whereNull('parent_id')->whereActived(true)->orderBy('order')->get();
    }
}