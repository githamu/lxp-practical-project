<?php

namespace App\Shop\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','customer_id','evaluation','review'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}