<?php

namespace App\Http\Controllers\Home;

use App\Models\Rooms;
use App\Models\room_type;
use App\Models\reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
		$rooms = Rooms::get();
		$roomTypes = room_type::get();

        return view('room', compact('rooms', 'roomTypes'));
    }

    public function filter(Request $request){

        $availableRooms = Rooms::with('typeRoom', 'reservations')->where('type_id', $request->type)->where('status', 'A')->where('space', $request->persons)->get();
		return $availableRooms;
    }

    public function individual($id){
        
		$room = Rooms::where('type_id', $id)->with('typeRoom', 'reservations')->where('status', 'A')->get();
		$room_type = room_type::where('id', $id)->first();
		
		$Reservation = Reservation::get();
		
		/*$allDates = Array();
		
		foreach($Reservation as $r){
			$arr = (array)$r->reservation_dates;
			$x = implode(',', $arr);
			$x = str_replace(']', '', $x);
			$x = str_replace('[', '', $x);
			$allDates[] = $x;
		}*/
        return view('individualRoom', compact('room', 'room_type', 'Reservation'));
    }

    public function search(Request $request){

        $start = $request->startDate;
        $endDate = $request->endDate;
        $rooms = Rooms::with('typeRoom', 'reservations')->where('status', 'A')->where('space', $request->persons)->get();
		$roomTypes = room_type::get();

        return view('room', compact('rooms', 'roomTypes', 'endDate'))->with('propMessage','Search');
    }

}
