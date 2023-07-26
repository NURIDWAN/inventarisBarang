<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
