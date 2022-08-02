<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class IndexPage extends Component
{
    public $products;
    public $productsForComparsion;
    public $productDeletedFromComparsion; // понимаю, костыль

    public function mount()
    {
        $this->productsForComparsion = [];
        $this->productDeletedFromComparsion = false;
    }

    public function render()
    {
        return view('livewire.index-page');
    }

    public function addForComparison($id)
    {
        $this->productDeletedFromComparsion = false;
        if(count($this->productsForComparsion) === 2) {
            return;
        }
        foreach ($this->productsForComparsion as $product) {
            if($product['id'] === $id) {
                return;
            }
        }
        $this->productsForComparsion[] = Product::find($id);
    }

    public function deleteFromComparison($index)
    {
        unset($this->productsForComparsion[$index]);
        $this->productDeletedFromComparsion = true;
    }
}
