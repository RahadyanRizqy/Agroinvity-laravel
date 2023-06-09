<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Accounts extends Authenticatable
{
    use HasFactory;

    // protected $fillable = [
    //     'fullname', 'email', 'password', 'phone_number', 'account_type_fk', 'account_rel_fk', 'created_at', 'updated_at'
    // ];

    protected $table = 'accounts';

    protected $guarded = [
        'id'
    ];

    public $timestamps = false;

    public function parentAcc() {
        return $this->belongsTo(Accounts::class, 'account_rel_fk');
    }

    public function childAcc() {
        return $this->hasMany(Accounts::class, 'account_rel_fk');
    }

    public function accountType() {
        return $this->belongsTo(AccountTypes::class, 'account_type_fk');
    }

    public function ownExpense() {
        return $this->hasMany(Expenses::class, 'account_fk');
    }

    public function ownProduct() {
        return $this->hasMany(Products::class, 'account_fk');
    }
}
