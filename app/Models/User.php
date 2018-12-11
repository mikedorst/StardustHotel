<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

	protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'remember_token',
    ];

    protected $hidden = [
        'password',
    ];
	
	public function customer()
    {
        return $this->hasOne(Customer::class, 'user_id', 'id');
    }
	
	public function role()
    {
        return $this->belongsTo(Role::class, 'id', 'user_id');
    }
}
