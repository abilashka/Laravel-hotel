@extends('layout.main')


@section('content')

<div class="dashboard-wrapper">
	<div class="row">
    	<div class="col-md-3 col-sm-4 users-sidebar-wrapper">
             <!-- SIDEBAR -->
            <div class="users-sidebar tbssticky">
				<ul class="list-group">
	                <li class="list-group-item active"> <a href="/cpanel"><i class="fa fa-home"></i> Dashboard</a></li>
						
                        <li class="list-group-item"> <a href="profile.php"><i class="fa fa-user"></i> My Profile</a></li>
                        <li class="list-group-item"> <a href="/logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9 col-sm-8">
	        	<h2>Dashboard</h2>
				<br>
                <h4>Reservations</h4>

                <div class="dashboard-block">	
	                <div class="table-responsive">
                    
	                    <table class="table table-striped mt30">
                            <thead>
                                <tr>

                                    <th>Check-in Date</th>
                                    <th>Check-out Date</th>
                                    <th>Guests</th>
                                    <th>Price</th>
                                    <th>Room Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($records as $rec)
                                    <td>{{ $rec->Checkin }}</td>
                                    <td>{{ $rec->Checkout }}</td>
                                    <td>{{ ($rec->Adult+$rec->Child) }}</td>
                                    <td>{{ $rec->Price }}</td>
                                    <td>{{ $rec->Size }}</td>
                                    <td>
                                        @php if($rec->Status == 0) echo '<span class="btn btn-xs btn-info"><i class="fa fa-info-circle"></i> Payment due</span>'; @endphp
                                        @php if($rec->Status == 1) echo '<span class="btn btn-xs btn-success"><i class="fa fa-check"></i> Paid</span><br><br>'; @endphp
                                        @php if($rec->Status == 2) echo '<span class="btn btn-xs btn-danger"><i class="fa fa-warning"></i> Cancelled</span>'; @endphp
                                    </td>
                                    <td>
                                        <form class="reservation-vertical clearfix" role="form" action="/usercp" name="usercpformcnl" id="usercpformcnl" method="POST">
                                            
                                            <div id="message{{$rec->id}}"></div>
                                            <input type="hidden" name="bookID" id="bookID" value="{{$rec->id}}">
                                            <!-- <div class="form-group">
                                                <select class="hidden" name="bookID" id="bookID" disabled="disabled">
                                                    <option selected="selected">{{$rec->id}}</option>
                                                </select>
                                            </div> -->
                                            <button type="submit" class="btn btn-xs btn-black">Cancel Booking</button> 
                                        </form> 
                                        <br>
                                        @php if($rec->Status != 2) echo '<a class="btn btn-xs btn-purple" href="editbooking/'.$rec->id.'">Change Date</a>'; @endphp
                                    </td>
                                    </tr>                                         
                                @endforeach

                            </tbody>
                        </table> 
                    </div>
                </div>  
            </div>
        </div>
    </div>


@endsection