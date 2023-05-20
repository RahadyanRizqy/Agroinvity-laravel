<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname', 'email', 'password', 'phone_number', 'account_type_fk', 'account_rel_fk', 'created_at', 'updated_at'
    ];
}
