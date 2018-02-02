<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rooms;
use DB;
use Auth;

class RoomsController extends Controller
{
   public function index()
    {
        return view('rooms.index');
    }

    public function show(Rooms $room)
    {
        return view('rooms.show', compact('room') );
    }

    public function createbking(Request $request)
    {
    	$userid = Auth::user()->id;
    	$checkin    = $request->input('checkin');
		$checkout    = $request->input('checkout');
		$room    = $request->input('room');
		$adults    = $request->input('adults');
		$children    = $request->input('children');
		$price  = $request->input('price');

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
		 	DB::table('Booking')->insert(
			    ['Uid' => $userid, 'Checkin' => $checkin, 'Checkout' => $checkout, 'Adult' => $adults, 'Child' => $children, 'Price' => $price, 'Size' => $room]
			);
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <strong>Sucess!</strong>You have reserved a room, Enjoy your stay and have fun!
       		</div>';

	    }
    }
}
