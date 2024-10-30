<?php

namespace App\Livewire;

use App\Models\Verbete;
use Livewire\Component;

class VerbetesModal extends Component
{


    public $searchVerbetes;
    public $verbetes;

    public function render()
    {
        $verbetesList = Verbete::where('nome', 'like', '%'.$this->searchVerbetes.'%');
        $this->verbetes = $verbetesList->get();

        return view('livewire.verbetes-modal');
    }

}
