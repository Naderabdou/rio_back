<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Search extends Component
{
    #[Validate('required|string|min:1|max:255')]
    public $search;
    public $isSearch = false;
    public $results = [];


    public function updatedSearch()
    {
    $this->search = ltrim($this->search , ' ');

        if (mb_strlen($this->search, 'UTF-8') >= 1) {
            $this->results = Product::where('name_ar', 'like', '%' . $this->search . '%')
                ->orWhere('name_en', 'like', '%' . $this->search . '%')
                ->take(5)->get();

            $this->isSearch = true;
        } else {
            $this->isSearch = false;
            $this->results = [];
        }
    }




    public function render()
    {

        $results =  $this->results;

        return view('livewire.search', [
            'results' => $results
        ]);
    }
}
