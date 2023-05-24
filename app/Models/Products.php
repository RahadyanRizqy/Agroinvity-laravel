<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'name', 'price_per_qty', 'total_qty', 'created_at', 'update_at', 'total_qty', 'sold_products', 'stock_products', 'account_fk'
    // ];


    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

    public function productOf() {
        return $this->belongsTo(Accounts::class, 'account_fk');
    }
}
