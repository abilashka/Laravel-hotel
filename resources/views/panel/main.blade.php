@extends('layout.main')


@section('content')
@php
$data = [];
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;

$lang = 'en';
$units = 'metric';
$owm = new OpenWeatherMap();
$owm->setApiKey("99b7b87ee4abc5fa5dc7b55280272018");
$weather = $owm->getWeather('Huddersfield', $units, $lang);



$url = 'https://ipinfo.io'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$characters = json_decode($data); // decode the JSON feed

$chartdata = array(0, 0, 0);

@endphp



<div class="dashboard-wrapper">
	<div class="row">
    	<div class="col-md-3 col-sm-4 users-sidebar-wrapper">
            @include('panel.layout.sidebar')

            <div class="panel panel-default text-center">
          <div class="panel-heading">
            <div class="panel-title"><i class="fa fa-star"></i> <strong>Hotel City Weather</strong></div>
          </div>
          <div class="panel-body">
            <address>
            <abbr title="Precipation">Precipation</abbr> <a href="#">{{ $weather->precipitation->getDescription()}} ({{ $weather->precipitation}}) </a><br>
            <abbr title="Temperature">Temperature</abbr> <a href="#">{{ $weather->temperature->getFormatted() }} </a><br>
            <abbr title="Pressure">Pressure</abbr> <a href="#">{{ $weather->pressure }} </a><br>
            <abbr title="Humidity">Humidity</abbr> <a href="#">{{ $weather->humidity }} </a><br>
            <abbr title="Sunrise">Sunrise</abbr> <a href="#">{{ $weather->sun->rise->format('r') }} </a><br>

            
            </address>
          </div>
        </div>
        
        <div class="panel panel-default text-center">
          <div class="panel-heading">
            <div class="panel-title"><i class="fa fa-star"></i> <strong>User Information</strong></div>
          </div>
          <div class="panel-body">
            <address>
            <abbr title="City">City</abbr> <a href="#">{{ $characters->city }} </a><br>
            <abbr title="Country">Country</abbr> <a href="#">{{ $characters->country }} </a><br>
            <abbr title="Pressure">Ip Address</abbr> <a href="#">{{ $characters->ip }} </a><br>
            <abbr title="Humidity">Postal Code</abbr> <a href="#">{{ $characters->postal }} </a><br>
            <abbr title="Sunrise">Service Provider</abbr> <a href="#">{{ $characters->org }} </a><br>

            
            </address>
          </div>
        </div>
        
        </div>

        
            <div class="col-md-9 col-sm-8">
	        	<h2>Dashboard</h2>
				<br>
                <h4>Reservations</h4>

                <div class="dashboard-block">	
                    {!! Form::open(array('url' => 'usercp/search', 'class'=>'form navbar-form navbar-right searchform')) !!}
                    {!! Form::text('search', null, array('required', 'class'=>'form-control', 'placeholder'=>'Search with checkin date range')) !!}
                    {!! Form::submit('Search',array('class'=>'btn btn-default')) !!}
                    {!! Form::close() !!}
                    
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
                                        @php $chartdata[$rec->Status]++;  @endphp
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
                        <div id="piechart" style="width: 900px; height: 500px;"></div>
                    </div>
                </div>  
            </div>
        </div>
    </div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Booking', 'Amounts'],
          ['Payment Pending',     {{json_encode($chartdata[0])}}],
          ['Paid',       {{json_encode($chartdata[1])}}],
          ['Cancelled',   {{json_encode($chartdata[2])}}]
        ]);

        var options = {
          title: 'Booking Report'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
@endsection