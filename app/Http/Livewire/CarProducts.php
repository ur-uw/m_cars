<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use DB;
use Livewire\Component;

class CarProducts extends Component
{
    public Manufacturer $manufacturer;
    public Category  $category;
    public array $product_ids;
    public $term;
    public function mount(string $manufacturer_name, string $type)
    {
        $this->manufacturer = Manufacturer::firstWhere('name', $manufacturer_name);
        $this->category = Category::firstWhere('name', $type);
        $this->product_ids = collect(
            DB::select("
                    SELECT
                products.id
            FROM
                products
                INNER JOIN categories ON products.category_id = categories.id
                INNER JOIN manufacturers ON products.manufacturer_id = manufacturers.id
            WHERE
                categories.parent_id = {$this->category->id}
                AND
                manufacturers.id = {$this->manufacturer->id};

        ")
        )->pluck('id')->toArray();
    }

    public function render()
    {
        return view('livewire.car-products', [
            'products' => Product::with('manufacturer')->whereIn('id', $this->product_ids)
                ->search($this->term)
                ->get(),
        ])
            ->extends('layouts.app');
    }
}
