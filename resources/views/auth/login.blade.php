@extends('layout.main')

@section('content')
<div class="container mt100">
  <div class="row">
  <!-- Reservation form -->
    <section id="reservation-form" class="mt250 clearfix">
      <div class="col-sm-12 col-md-4">
        <form class="reservation-vertical clearfix" role="form" method="POST" action="{{ route('login') }}">
           {{ csrf_field() }}
          <h2 class="lined-heading"><span>Login</span></h2>

          @if ($errors)
          <div id="message">
            <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
            </ul>
          </div>
          @endif

          <!-- Error message display -->
          <div class="form-group">
            <label for="email" accesskey="E">E-mail</label>
            <input name="email" type="text" id="email" value="" class="form-control" placeholder="Please enter your E-mail/Username"/>
          </div>
          
          <div class="form-group">
            <label for="password" accesskey="P">Password</label>
            <input name="password" type="password" id="password" value="" class="form-control" placeholder="Please enter your Password"/>
          </div>



          <button type="submit" class="btn btn-primary btn-block">Log In!</button>
          <p><a href="{{ url('password/reset') }}">Forgot password?</a></p>
          <div class="row margin-bottom-10">
            <p class="or-social">Or Use Social Login</p>
            <div class="col-md-6 col-sm-6 col-xs-6">
              <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-lg  btn-danger btn-block google">Google+</a>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>
</div>

@endsection