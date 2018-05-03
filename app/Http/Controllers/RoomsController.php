<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rooms;
use DB;
use Auth;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class RoomsController extends Eloquent
{
   public function index()
    {
        return view('rooms.index');
    }

    public function show($room)
    {
		$room = (int)$room;
		$room = DB::table('rooms')->where('id', '=', $room)->get();
		$room = json_decode(json_encode($room), FALSE);
        return view('rooms.show')->with('room',$room[0]);
    }

    public function createbking(Request $request)
    {
    	$userid = (int)Auth::user()->id;
    	$checkin    = $request->input('checkin');
		$checkout    = $request->input('checkout');
		$room    = $request->input('room');
		$adults    = (int)$request->input('adults');
		$children    = (int)$request->input('children');
		$price  = (int)$request->input('price');

		if(Auth::guest())
		{
			echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! You must be logged in to book a room.</div>';
			
		} 
        else if(trim($room) == '') 
        {
			echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! Please enter a your room.</div>';
			
		} 
		else if(trim($checkin) == '') 
		{
			echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! Please enter your check-in date.</div>';

		} 
		else if(trim($checkout) == '') 
		{
			echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! Please enter your check-out date.</div>';

		}

		else if(trim($children) == '' && trim($adult) == '') 
		{
			echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! Please enter number of persons.</div>';

		}

		else if(trim($room) == '') 
		{
			echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! Please Select your room.</div>';
			

		}
		else
		{
			$inc = DB::table('Booking')->get()->last();
		 	DB::table('Booking')->insert(
			    ['id' => $inc['id']+1, 'Uid' => $userid, 'Checkin' => $checkin, 'Checkout' => $checkout, 'Adult' => $adults, 'Child' => $children, 'Price' => $price, 'Size' => $room, 'Status' => 0]
			);
			
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <strong>Sucess!</strong>You have reserved a room, Enjoy your stay and have fun!
       		</div>';

	    }
    }
}
