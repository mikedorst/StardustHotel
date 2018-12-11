<?php

namespace App\Http\Controllers\Home;

use App\Models\Rooms;
use App\Models\room_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Rooms::where('status', 'A')->count();
        $roomTypes = room_type::get();
				
        return view('welcome', compact('rooms', 'roomTypes'));
    }

}
