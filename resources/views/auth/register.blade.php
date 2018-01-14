@extends('layout.main')

@section('content')
<div class="container mt100">
  <div class="row">
  <!-- Reservation form -->
    <section id="reservation-form" class="mt250 clearfix">
      <div class="col-sm-12 col-md-4">
        <form class="reservation-vertical clearfix" role="form" method="post" action="{{ route('register') }}">
          {{ csrf_field() }}
          <h2 class="lined-heading"><span>User Registeration</span></h2>

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
            <label for="FirstName" accesskey="E">Name</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
          </div>
          
          <div class="form-group">
            <label for="username" accesskey="P">E-mail</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
          </div>
          
          <div class="form-group">
            <label for="passwd" accesskey="P">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>
          </div>

          <div class="form-group">
            <label for="passwd" accesskey="P">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
          </div>
          
          <button type="submit" class="btn btn-primary btn-block">Register!</button>
        </form>
      </div>
    </section>
  </div>
</div>
@endsection