@extends('layout.main')

@section('content')


<div class="container mt100">
  <div class="row">
    <section id="reservation-form" class="mt250 clearfix">
      <div class="col-md-9 col-sm-8">
        <h2>My Profile</h2>
          <div class="dashboard-block">
            <div class="tabs profile-tabs">
              <ul class="nav nav-tabs">
                  <li class="active"> <a data-toggle="tab" href="#personalinfo" aria-controls="personalinfo" role="tab">Personal Info</a></li>
                    <li> <a data-toggle="tab" href="#changepassword" aria-controls="changepassword" role="tab">Change Password</a></li>
              </ul>
                <form class="reservation-vertical clearfix" role="form" action="/usercp/profile" name="updateform" id="updateform" method="POST">
                <div id="message"></div>
                <div class="tab-content">
                  <div id="personalinfo" class="tab-pane fade active in">
                    <div class="row">
                      <div class="col-md-8">
                        <div class="row">
                          <div class="col-md-6">
                            <label>Name*</label>
                            <input type="text" value = "{{ $user[0]->name }}" id = "name" class="form-control" placeholder="Enter Your First Name" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                          	<label>Email*</label>
                            <input type="text" class="form-control" value = "{{ $user[0]->email }}" id = "email" placeholder="mail@example.com" required>
                          </div>
                          <div class="col-md-6">
                          	<label>Phone</label>
                            <input type="text" class="form-control" value = "{{ $user[0]->phone }}" id = "phone" placeholder="000-00-0000">
                          </div>
                        </div>
                                      
                        <h3>Security Question</h3>
          							<div class="lighter"><p>Please choose a security question so we can better identify you.</p></div>
                          <label>Question</label>
                          <select name="SecurityQuestions" class="form-control selectpicker">
                              <option>What is your maiden name?</option>
                              <option>What is your pets name?</option>
                              <option>What is your first school name?</option>
                              <option>What is your place of birth name?</option>
                              <option>Who is your favourite actor?</option>
                         	</select>
                          <label>Answer</label>
                          <input type="password" value = "{{ $user[0]->qanswer }}" id = "qanswer" placeholder="Enter Your Security Answer" class="form-control">

                                  </div>
                              </div>
                          </div>

                          <!-- PROFIE CHANGE PASSWORD -->
                          <div id="changepassword" class="tab-pane fade">
                          	<div class="row">
                              <div class="col-md-8">
                                <div class="row">
                                  <div class="col-md-6">
                              		  <label>New password</label>
                                    <input type="password" class="form-control" id = "npass" placeholder="Enter New Password">
                                  </div>
                                  <div class="col-md-6">
                              		  <label>Confirm new password</label>
                                    <input type="password" class="form-control" id = "ncpass" placeholder="Confirm New Password">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                <a href = "/usercp/profile"><button type="submit" class="btn btn-info">Update details</button></a>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div> 
</div>

@endsection