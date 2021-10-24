<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('count', 'price')->withTimestamps();
    }

    public function getFullAmount() {
        $amount = 0;
        if ($this->products->count()) {
            foreach ($this->products as $product) {
                $amount += ($product->pivot->count * $product->pivot->price);
            }
        }
        return number_format($amount, '2', '.' , ' ');
    }

}
