<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use PharIo\Manifest\Url;

class Products extends Component
{
    use WithPagination;
    #[Url]
    public $selected_categories = [];
    #[Url]
    public $selected_brands = [];
    #[Url]


    public $sort = 'all';
    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);
        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }
        if (!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }
        // if ($this->featured) {
        //     $productQuery->where('is_featured', 1);
        // }
        // if ($this->on_sale) {
        //     $productQuery->where('on_sale',  1);
        // }
        // if ($this->price_range) {

        //     $productQuery->whereBetween('price', [0, $this->price_range]);
        // }
        if ($this->sort == 'all') {
            $productQuery->latest();
        }
        // if ($this->sort == 'price') {
        //     $productQuery->orderBy('price');
        // }

        return view(
            'livewire.products',
            [
                'products' => $productQuery->get(),
                'brands' => Brand::latest()->get(),
                'categories' => Category::withCount(['products' => function ($query) {
                    $query->where('is_active', 1);
                }])->orderBy('sort')->get(),
            ]
        );
    }
}
