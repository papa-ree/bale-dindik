<?php

namespace Paparee\BaleDindik\Livewire;

use Livewire\Component;
use Livewire\Attributes\{Layout};

#[Layout('bale-dindik::layouts.app')]
class Index extends Component
{
    public function render()
    {
        return view('bale-dindik::livewire.index');
    }
}