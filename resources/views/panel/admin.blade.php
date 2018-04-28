@extends('layout.main')

@section('content')



<div class="dashboard-wrapper">
  <div class="row">
    <div class="col-md-3 col-sm-4 users-sidebar-wrapper">
      @include('panel.layout.sidebar')
    </div>
    <div class="col-md-9 col-sm-8">
    <h2>Dashboard</h2>
      <br><h4>Reservations</h4>
        <div class="dashboard-block">
          <div id="message"></div>
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
                @foreach($books as $booking)
               
                  <tr>
                    <td>{{ $booking->Checkin }}</td>
                    <td>{{ $booking->Checkout }}</td>
                    <td>{{ ($booking->Child + $booking->Adult) }}</td>
                    <td><span class="price">{{ number_format($booking->Price) }} &pound;</span></td>
                    <td>{{ $booking->Size }}</td>
                    <td>
                      @php if($booking->Status == 0) echo '<span class="btn btn-xs btn-info"><i class="fa fa-info-circle"></i> Payment due</span>'; @endphp
                      @php if($booking->Status == 1) echo '<span class="btn btn-xs btn-success"><i class="fa fa-check"></i> Paid</span><br><br>'; @endphp
                      @php if($booking->Status == 2) echo '<span class="btn btn-xs btn-danger"><i class="fa fa-warning"></i> Cancelled</span>'; @endphp
                    </td>
                    <td>
                      <form class="reservation-vertical clearfix" role="form" action="/usercp/admin/clear" name="usercpform" id="usercpform" method="POST">
                            <div class="form-group">
                          <input type="hidden" name="bookID" id="bookID" value="{{$booking->id}}">
                        </div>
                        <button type="submit" class="btn btn-xs btn-default">Clear Payment!</button> 
                      </form>
                      <form class="reservation-vertical clearfix" role="form" action="/usercp/admin/cancel" name="usercpform" id="usercpform" method="POST">
                        <br>
                        <input type="hidden" name="bookID" id="bookID" value="{{$booking->id}}">
                        <button type="submit" class="btn btn-xs btn-black">Cancel Booking</button> 
                      </form>
                      <form class="reservation-vertical clearfix" role="form" action="/usercp/admin/delete" name="usercpform" id="usercpform" method="POST">
                        <br>
                        <input type="hidden" name="bookID" id="bookID" value="{{$booking->id}}">
                        <button type="submit" class="btn btn-xs btn-black">Delete Booking</button> 
                      </form>
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