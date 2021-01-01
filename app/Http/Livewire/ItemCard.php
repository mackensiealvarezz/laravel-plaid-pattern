<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Plaid\Plaid;
use Livewire\Component;

class ItemCard extends Component
{
    public Item $item;

    public function getInstitutionProperty()
    {
        return (new Plaid)->getInstitutionById($this->item->plaid_institution_id);
    }


    public function render()
    {
        return view('livewire.item-card', [
            'institution' => $this->getInstitutionProperty()
        ]);
    }
}
