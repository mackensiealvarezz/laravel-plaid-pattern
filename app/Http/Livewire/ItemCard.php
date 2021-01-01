<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Plaid\Plaid;
use Livewire\Component;

class ItemCard extends Component
{
    public Item $item;

    // Show accounts
    public $showAccounts = false;

    public function mount()
    {
        $this->item->load(['accounts', 'accounts.transactions']);
    }

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
