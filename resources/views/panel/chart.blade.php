@extends('layout.main')

@section('content')



<div class="dashboard-wrapper">
  <div class="row">
    <div class="col-md-3 col-sm-4 users-sidebar-wrapper">
      @include('panel.layout.sidebar')
    </div>
  



    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Chart Demo</div>

                <div class="panel-body">
                    {!! $chart->html() !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
@endsection







    </div>
  </div>
   



@endsection