<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTypes extends Model
{
    use HasFactory;

    public function expenseGet() {
        return $this->hasMany(Expenses::class, 'expense_type_fk');
    }
}
