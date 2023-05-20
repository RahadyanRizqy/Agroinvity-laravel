<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'quantity', 'price_per_qty', 'account_fk', 'expense_type_fk', 'created_at', 'updated_at',
    ];
}