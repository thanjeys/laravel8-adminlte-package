<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'monthly_cycle'
    ];

    function users() {
        return $this->belongsToMany(User::class);
    }

}

