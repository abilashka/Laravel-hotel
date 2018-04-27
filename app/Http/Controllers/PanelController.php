<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use DB;
use Auth;
use ExcelReport;
use Validator;


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
		$records = DB::table('Booking')->where('Uid', '>=', $userid)->get();
		
		$chartjs = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Label x', 'Label y'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384', '#36A2EB'],
                'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                'data' => [69, 59]
            ]
        ])
        ->options([]);

        return view('panel.main', compact('records', 'chartjs'));
	}
	
	public function getreport()
    {
		$userid = Auth::user()->id;
		$title = 'Room Booking Report';
		$queryBuilder = DB::table('Booking')->where('Uid', '>=', $userid)->get();
        $columns = [
			'Check in' => 'Checkin',
			'Check out' => 'Checkout',
			'Adult' => 'Adult',
			'Child' => 'Child',
			'Price' => 'Price',
			'Room Type' => 'Size',
			'Status' => function($result) { // You can do if statement or any action do you want inside this closure
				if($result->Status == 0) return 'Payment Due';
				else if($result->Status == 1) return 'Paid';
				else if($result->Status == 2) return 'Cancelled';
			}
		];
		$meta = [
			'Sort By' => 'Checkin'
		];
		 var_dump($queryBuilder);
		return ExcelReport::of($title, $meta, $queryBuilder, $columns)
		->editColumn('Price', [
			'class' => 'right bolder italic-red'
		])
		->setCss([
			'.bolder' => 'font-weight: 800;',
			'.italic-red' => 'color: red;font-style: italic;'
		])
		->download('report');
    }

    public function adminpanel()
    {
    	$userid = Auth::user()->id;
    	$books = DB::table('Booking')->get();
        return view('panel.admin')->with('books',$books);
    }


	public function contact(Request $request)
    {

		$name     = $request->input('name');
		$email    = $request->input('email');
		$subject  = $request->input('subject');
		$comments = $request->input('comments');
		$verify   = $request->input('verify');
		
		$validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

		if(trim($name) == '') {
			echo '<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! You must enter your name.</div>';
			exit();
		} else if(trim($email) == '') {
			echo '<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! Please enter a valid email address.</div>';
			exit();
		} else if ($validator->fails())  {
			echo '<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! You have enter an invalid e-mail address, try again.</div>';
			exit();
		}

		else if(trim($subject) == '') {
			echo '<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! Please enter a subject.</div>';
			exit();
		} else if(trim($comments) == '') {
			echo '<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! Please enter your message.</div>';
			exit();
		} else if(!isset($verify) || trim($verify) == '') {
			echo '<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! Please enter the verification number.</div>';
			exit();
		} else if(trim($verify) != '4') {
			echo '<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! The verification number you entered is incorrect.</div>';
			exit();
		}

		if(get_magic_quotes_gpc()) {
			$comments = stripslashes($comments);
		}




		$address = "rcr@gtcnr.com";
		$e_subject = 'Support Request By:' . $name . '.';

		$e_body = "You have been contacted by $name with regards to $subject, their additional message is as follows." . PHP_EOL . PHP_EOL;
		$e_content = "\"$comments\"" . PHP_EOL . PHP_EOL;
		$e_reply = "You can contact $name via email, $email";

		$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );

		$headers = "From: $email" . PHP_EOL;
		$headers .= "Reply-To: $email" . PHP_EOL;
		$headers .= "MIME-Version: 1.0" . PHP_EOL;
		$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
		$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

		if(mail($address, $e_subject, $msg, $headers)) {

			// Email has sent successfully, echo a success page.

			echo "<h1>Email Sent Successfully!</h1>";
			echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';	
			echo "<p>Thank you <strong>$name</strong>, your message has been submitted to us.</p>";
			echo '</div>';

		} else {

			echo 'ERROR!';

		}		


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

public function dlbooking(Request $request)
    {
    	$bookID = $request->input('bookID');
    	$count = DB::table('Booking')->where([['id', '=', $bookID],])->count();

        if(trim($bookID) == '') 
        {
			echo '
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Something went wrong! Please refresh the page..</div>';
		}
		
		elseif(!$count)
		{
			echo '<div class="alert alert-danger alert-dismissable">
  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>There is no such booking with the id you specified.</div>';
			
		}
		else
		{
		 	$results = \DB::select( "INSERT into Deletelogs SELECT * FROM Booking WHERE ID=$bookID" );
		 	DB::table('Booking')->where('id', '=', $bookID)->delete();
			echo '<div class="alert alert-success alert-dismissable"> 
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
			<strong>Sucess!</strong> The booking has deleted.
	       </div>';
	    }
    }

    public function search(Request $request)
	{
	  
	  $query = $request->input('search');
	  $data = DB::table('Booking')->where('Checkin', 'LIKE', '%' . $query . '%')->paginate(10);
	  return view('panel.main')->with('records',$data);    
	 }

    public function clrbooking(Request $request)
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
  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>This booking has been paid already.</div>';
			
		}
		else
		{
		 	DB::table('Booking')->where('id', $bookID)->update(['Status' => 1]);
			echo '<div class="alert alert-success alert-dismissable"> 
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
			<strong>Sucess!</strong> The booking has cleared the payment.
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
        return view('panel.editbook', compact('booking'));
    }

    public function userprofile()
    {
        $userid = Auth::user()->id;
    	$user = DB::table('users')->where('id', '=', $userid)->get();
        return view('panel.profile',compact('user'));
    }

    public function updateprofile(Request $request)
    {
    	$userid = Auth::user()->id;
    	$name = $request->input('name');
    	$email = $request->input('email');
    	$phone = $request->input('phone');
    	$qanswer = $request->input('qanswer');
    	$npass = $request->input('npass');
    	$ncpass = $request->input('ncpass');


        if(trim($userid) == '') 
        {
			echo '
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Something went wrong! Please refresh the page..</div>';
		}
		
		elseif($npass != $ncpass)
		{
			echo '<div class="alert alert-danger alert-dismissable">
  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Sorry, The password you entered doesn\'t with confirmation password.</div>';
			
		}
		else
		{
		 	if($npass !== NULL) DB::table('users')->where('id', $userid)->update(array('name' => $name,'email' => $email,'phone' => $phone,'qanswer' => $qanswer,'password' => $npass));
		 	else DB::table('users')->where('id', $userid)->update(array('name' => $name,'email' => $email,'phone' => $phone,'qanswer' => $qanswer));
			echo '<div class="alert alert-success alert-dismissable"> 
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
			<strong>Sucess!</strong> You have been updated with new information you provided.
	       </div>';
	    }
    }
}
