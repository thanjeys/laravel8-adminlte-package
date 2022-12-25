<?php

namespace App\Models;

use App\Models\User;
use App\Models\Freelancer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $fillable = ['customer_num', 'customer_name', 'loan_amount'];

    function bank()
    {
        return $this->hasOne(Bank::class, 'id', 'bank');
    }
    function freelancer()
    {
        return $this->hasOne(Freelancer::class, 'id', 'flr_name');
    }

    function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
