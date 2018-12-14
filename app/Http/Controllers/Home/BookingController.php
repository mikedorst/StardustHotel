<?php

namespace App\Http\Controllers\Home;

use App\Models\Rooms;
use App\Models\reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class BookingController extends Controller
{
    public function index()
    {
        return view('bookings');
    }
	
	public function addBooking(Request $request)
	{
		// Alle datums ophalen tussen 2 data
		$firstDate = Carbon::parse($request->dateArrive);
		$secondDate = Carbon::parse($request->dateLeave);
		$allDates = $this->generateDateRange($firstDate, $secondDate);
		
		$available_room = Rooms::where('type_id', $request->room_type)->where('status', 'A')->where('space', $request->persons)->first();
		
		$r = new Reservation();
		
		$r->room_id = $available_room->id;
		$r->price = $request->price;
		$r->reserved_by = Auth()->user()->id;
		$r->reserved_at = $firstDate;
		$r->reserved_till = $secondDate;
		$r->reservation_dates = json_encode($allDates);
		$r->save();
		
		Rooms::where('id', $available_room->id)->update([
			'status' => 'B',
		]);
		
		return "success";
	}
	
	private function generateDateRange(Carbon $start_date, Carbon $end_date)
	{

		$dates = [];

		for($date = $start_date; $date->lte($end_date); $date->addDay()) {

			$dates[] = $date->format('Y-m-d');

		}

		return $dates;

	}

}
