<div class="users-sidebar tbssticky">
	<ul class="list-group">
        <li class="list-group-item active"> <a href="/cpanel"><i class="fa fa-home"></i> Dashboard</a></li>
			@if(Auth::user()->admin) <li class="list-group-item active"> <a href="admin"><i class="fa fa-dashboard"></i> Admin CP</a></li> @endif
            <li class="list-group-item"> <a href="profile.php"><i class="fa fa-user"></i> My Profile</a></li>
            <li class="list-group-item"> <a href="/logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
        </ul>
    </div>
</div>