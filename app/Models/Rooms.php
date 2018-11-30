<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $table = 'Room';

    public function typeRoom()
    {
        return $this->hasOne(room_type::class, 'id', 'type_id');
    }

    public function reservations()
    {
        return $this->hasMany(reservation::class, 'room_id', 'id');
    }

}
