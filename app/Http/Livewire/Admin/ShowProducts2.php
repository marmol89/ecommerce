<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts2 extends Component
{
    use WithPagination;

    public $search;
    public $pages;
    public $pageNum;
    public $columns= ['name', 'marca', 'categoria', 'stock', 'vetas', 'estado', 'fecha', 'precio'];

    public function mount()
    {
        $this->pages = [5,10,15,25,50,100];
        $this->pageNum = 10;
    }

    public function updatedPageNum()
    {
        $this->resetPage();
    }

    public function updatedColumns()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::where('name', 'LIKE', "%{$this->search}%")->paginate($this->pageNum ?? 10);

        return view('livewire.admin.show-products2', compact('products'))
            ->layout('layouts.admin');
    }
}
