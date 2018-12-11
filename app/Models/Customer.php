<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
