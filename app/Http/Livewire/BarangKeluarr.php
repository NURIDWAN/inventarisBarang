<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Inventory;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\Auth;

class BarangKeluarr extends Component
{

    public $inventory_id, $quantity;
    public $inventories, $data;

    public function render()
    {
        $this->inventories = Inventory::all();
        $this->data = BarangKeluar::all();
        return view('livewire.barang-keluar')->extends('layouts.app')->section('content');
    }

    public function store()
    {
        $this->validate([
            'inventory_id' => 'required',
            'quantity' => 'required|numeric',
        ]);

        $inventory = Inventory::findOrFail($this->inventory_id);
        $inventory->quantity -= $this->quantity;
        $inventory->save();

        $user_id = Auth::id();

        $barangMasuk = new BarangKeluar();
        $barangMasuk->inventory_id = $this->inventory_id;
        $barangMasuk->user_id = $user_id;
        $barangMasuk->quantity = $this->quantity;
        $barangMasuk->save();

        $this->reset(['inventory_id', 'quantity']);
    }
}
