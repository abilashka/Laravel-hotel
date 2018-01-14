<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use DB;
use Auth;


class PanelController extends Controller
{

	protected $redirectTo = '/';


	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$userid = Auth::user()->id;
    	$users = DB::table('Booking')->where('Uid', '>=', $userid)->get();
        return view('panel.main')->with('records',$users);
    }

    public function cclbooking(Request $request)
    {
    	$bookID = $request->input('bookID');
    	$count = DB::table('Booking')->where([['Status', '=', '2'],['id', '=', $bookID],])->count();

        if(trim($bookID) == '') 
        {
			echo '
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Something went wrong! Please refresh the page..</div>';
		}
		
		elseif($count)
		{
			echo '<div class="alert alert-danger alert-dismissable">
  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>This booking has cancelled already.</div>';
			
		}
		else
		{
		 	DB::table('Booking')->where('id', $bookID)->update(['Status' => 2]);
		 	DB::table('cancelations')->insert(['RefID' => $bookID]);
			echo '<div class="alert alert-success alert-dismissable"> 
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
			<strong>Sucess!</strong> The booking has been cancelled.
	       </div>';
	    }
    }

    public function upbooking(Request $request, $booking)
    {
    	$count = DB::table('Booking')->where([['Status', '=', '2'],['id', '=', $booking],])->count();

        if(trim($booking) == '') 
        {
			echo '
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Something went wrong! Please refresh the page..</div>';
		}
		
		elseif($count)
		{
			echo '<div class="alert alert-danger alert-dismissable">
  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>This booking is cancelled and cannot make any changes to the booking.</div>';
			
		}
		else
		{
			$checkin = $request->input('checkin');
			$checkout = $request->input('checkout');
			$adults = $request->input('adults');
			$children = $request->input('children');

		 	DB::table('Booking')->where('id', $booking)->update(array('Checkin' => $checkin,'Checkout' => $checkout,'Adult' => $adults,'Child' => $children));
			echo '<div class="alert alert-success alert-dismissable"> 
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
			<strong>Sucess!</strong> The booking has been Updated.
	       </div>';
	    }
    }

    public function editbook(Booking $booking)
    {
    	// $count = DB::table('Booking')->where('id', $bookID)->count();
    	// $booking = DB::table('Booking')->where('id', $bookingid)->get();

     //    if(!$count) return abort(404);
        //return var_dump($booking);
        return view('panel.editbook', compact('booking'));
    	//return $bookingid;
    }
}