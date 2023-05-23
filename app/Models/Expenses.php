<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'name', 'quantity', 'price_per_qty', 'account_fk', 'expense_type_fk', 'created_at', 'updated_at',
    // ];
    protected $guarded = [
        'id'
    ];

    public function expenseType() {
        return $this->belongsTo(ExpenseTypes::class, 'expense_type_fk');
    }

    public function expenseOf() {
        return $this->belongsTo(Accounts::class, 'account_fk');
    }
}