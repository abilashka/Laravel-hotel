<div class="users-sidebar tbssticky">
	<ul class="list-group">
        <li class="list-group-item active"> <a href="/usercp"><i class="fa fa-home"></i> Dashboard</a></li>
			@if(Auth::user()->admin) <li class="list-group-item active"> <a href="/usercp/admin"><i class="fa fa-dashboard"></i> Admin CP</a></li> @endif
            <li class="list-group-item"> <a href="/usercp/profile"><i class="fa fa-user"></i> My Profile</a></li>
            <li class="list-group-item"> <a href="/logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
        </ul>
    
</div>

<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <form enctype="multipart/form-data" action="/usercp/up" method="POST">
                <label>Update Profile Image</label>
                <input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-default">
            </form>
        </div>
    </div>