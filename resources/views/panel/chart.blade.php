@extends('layout.main')

@section('content')



<div class="dashboard-wrapper">
  <div class="row">
    <div class="col-md-3 col-sm-4 users-sidebar-wrapper">
      @include('panel.layout.sidebar')
    </div>
  



    <div>{!! $chart->container() !!}</div>

 <script src="path/to/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
 {!! $chart->script() !!}
@endsection







    </div>
  </div>
   



@endsection