<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable = ['inventory_id','user_id', 'quantity'];

    
    public function iventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
