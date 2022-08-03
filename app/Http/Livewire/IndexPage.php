<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class IndexPage extends Component
{
    public $products;
    public $productsForComparsion;
    public $isModalShown;
    public $firstProductForComparsion;
    public $secondProductForComparsion;

    public function mount()
    {
        $this->productsForComparsion = [];
        $this->showModal(false);
        $this->firstProductForComparsion = null;
        $this->secondProductForComparsion = null;
    }

    public function render()
    {
        $firstIndex = $this->getIndexOfProduct($this->firstProductForComparsion ? $this->firstProductForComparsion['id'] : 0);
        $secondIndex = $this->getIndexOfProduct($this->secondProductForComparsion ? $this->secondProductForComparsion['id'] : 0);
        return view('livewire.index-page', compact('firstIndex', 'secondIndex'));
    }

    public function addForComparison($id)
    {
        $this->showModal(false);
        if(in_array($id, $this->productsForComparsion)) {
            return;
        }
        $this->productsForComparsion[] = $id;
        $this->setProductsForComparsion();
    }

    public function deleteFromComparison($id)
    {
        $index = array_search($id, $this->productsForComparsion);
        unset($this->productsForComparsion[$index]);
        $this->productsForComparsion = array_values($this->productsForComparsion);
        $this->setProductsForComparsion();
        $this->showModal(true);
    }

    protected function getIndexOfProduct($id)
    {
        return array_search($id, $this->productsForComparsion);
    }

    protected function setProductsForComparsion()
    {
        $this->firstProductForComparsion = $this->getProduct(0);
        $this->secondProductForComparsion = $this->getProduct(1);
    }

    protected function getProduct($index)
    {
        return array_key_exists($index, $this->productsForComparsion) ? Product::find($this->productsForComparsion[$index]) : null;
    }

    /*public function nextFirstProduct($index)
    {
        $this->firstProductForComparsion = $this->getProduct($index);
        $this->showModal(true);
    }

    public function prevFirstProduct($index)
    {
        $this->firstProductForComparsion = $this->getProduct($index);
        $this->showModal(true);
    }

    public function nextSecondProduct($index)
    {
        $this->secondProductForComparsion = $this->getProduct($index);
        $this->showModal(true);
    }

    public function prevSecondProduct($index)
    {
        $this->secondProductForComparsion = $this->getProduct($index);
        $this->showModal(true);
    }*/

    public function changeFirstProductForComparsion($index)
    {
        $this->firstProductForComparsion = $this->getProduct($index);
        $this->showModal(true);
    }

    public function changeSecondProductForComparsion($index)
    {
        $this->secondProductForComparsion = $this->getProduct($index);
        $this->showModal(true);
    }



    protected function showModal($show)
    {
        $this->isModalShown = $show;
    }
}
