@extends ('layout.main')


@section('content')

<section class="standard-slider room-slider">
  <div class="col-sm-12 col-md-8">
    <div id="owl-standard" class="owl-carousel">
      <div class="item"> <a href="/images/rooms/slider/room-slider-02.jpg" data-rel="prettyPhoto[gallery1]"><img src="/images/rooms/slider/room-slider-02.jpg" alt="Image 2" class="img-responsive"></a> </div>
      <div class="item"> <a href="/images/rooms/slider/room-slider-03.jpg" data-rel="prettyPhoto[gallery1]"><img src="/images/rooms/slider/room-slider-03.jpg" alt="Image 2" class="img-responsive"></a> </div>
    </div>
  </div>
</section>

<section id="reservation-form" class="mt50 clearfix">
  <div class="col-sm-12 col-md-4">
    <form class="reservation-vertical clearfix" role="form" method="post" action="/rooms" name="reservationform" id="reservationform">
      <h2 class="lined-heading"><span>Reservation</span></h2>
      <div class="price">
        <h4>{{ $room->Fcode }}</h4>
        &pound; {{ $room->Price }},-<span> a night</span>
      </div>
      <div id="message"></div>
      <!-- Error message display -->
      <div class="form-group">
        <select class="hidden" name="room" id="room" disabled="disabled">
          <option selected="selected">{{ $room->Fcode }}</option>
        </select>
      </div>
      <div class="form-group">
        <select class="hidden" name="price" id="price" disabled="disabled">
          <option selected="selected">{{ $room->Price }}</option>
        </select>
      </div>
      <div class="form-group">
        <label for="checkin">Check-in</label>
        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-In is from 11:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
        <i class="fa fa-calendar infield"></i>
        <input name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="Check-in"/>
      </div>
      <div class="form-group">
        <label for="checkout">Check-out</label>
        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-out is from 12:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
        <i class="fa fa-calendar infield"></i>
        <input name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="Check-out"/>
      </div>
      <div class="form-group">
        <div class="guests-select">
          <label>Guests</label>
          <i class="fa fa-user infield"></i>
          <div class="total form-control" id="test">1</div>
          <div class="guests">
            <div class="form-group adults">
              <label for="adults">Adults</label>
              <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="+18 years"> <i class="fa fa-info-circle fa-lg"> </i> </div>
              <select name="adults" id="adults" class="form-control">
                <option value="1">1 adult</option>
                <option value="2">2 adults</option>
                <option value="3">3 adults</option>
              </select>
            </div>
            <div class="form-group children">
              <label for="children">Children</label>
              <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="0 till 18 years"> <i class="fa fa-info-circle fa-lg"> </i> </div>
              <select name="children" id="children" class="form-control">
                <option value="0">0 children</option>
                <option value="1">1 child</option>
                <option value="2">2 children</option>
                <option value="3">3 children</option>
              </select>
            </div>
            <button type="button" class="btn btn-default button-save btn-block">Save</button>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Book Now</button>
    </form>
  </div>
</section>

<!-- Room Content -->
<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-7 mt50">
        <h2 class="lined-heading"><span>Room Details</span></h2>
        <table class="table table-striped mt30">
          <tbody>
            <tr>
              <td><i class="fa fa-check-circle"></i> Spacious Bed</td>
              <td><i class="fa fa-check-circle"></i> Free Internet</td>
              <td><i class="fa fa-check-circle"></i> Free Newspaper</td>
            </tr>
            <tr>
              <td><i class="fa fa-check-circle"></i> 60 square meter</td>
              <td><i class="fa fa-check-circle"></i> Beach view</td>
              <td><i class="fa fa-check-circle"></i> 2 persons</td>
            </tr>
            <tr>
              <td><i class="fa fa-check-circle"></i> Double Bed</td>
              <td><i class="fa fa-check-circle"></i> Free Internet</td>
              <td><i class="fa fa-check-circle"></i> Breakfast included</td>
            </tr>
            <tr>
              <td><i class="fa fa-check-circle"></i> Private Balcony</td>
              <td><i class="fa fa-check-circle"></i> Flat Screen TV</td>
              <td><i class="fa fa-check-circle"></i> Jacuzzi</td>
            </tr>
          </tbody>
        </table>

      </div>
      
    </div>
  </div>
</section>

@endsection