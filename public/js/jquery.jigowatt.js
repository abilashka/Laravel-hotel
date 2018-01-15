jQuery(document).ready(function(){

	$('#reservationform').submit(function(){

		var action = $(this).attr('action');

		$("#message").slideUp(750,function() {
		$('#message').hide();

 		$('#submit')
			.after('<img src="images/ajax-loader.gif" class="loader" />')
			.attr('disabled','disabled');

		$.post(action, {
			price: $('#price').val(),
			room: $('#room').val(),
			checkin: $('#checkin').val(),			
			checkout: $('#checkout').val(),
			adults: $('#adults').val(),
			children: $('#children').val(),
		},
			function(data){
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');
				$('#reservationform img.loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit').removeAttr('disabled');
				if(data.match('success') != null) $('#reservationform .form-group, #reservationform .btn').slideUp('slow');

			}
		);

		});

		return false;

	});
	
	$('#updateform').submit(function(){

		var action = $(this).attr('action');

		$("#message").slideUp(750,function() {
		$('#message').hide();

 		$('#submit')
			.after('<img src="images/ajax-loader.gif" class="loader" />')
			.attr('disabled','disabled');

		$.post(action, {
			email: $('#email').val(),
			name: $('#name').val(),
			phone: $('#phone').val(),
			qanswer: $('#qanswer').val(),
			npass: $('#npass').val(),
			ncpass: $('#ncpass').val(),
		},
			function(data){
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');
				$('#updateform img.loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit').removeAttr('disabled');
				

			}
		);

		});

		return false;

	});



	$('#usercpform').submit(function(){

		var action = $(this).attr('action');

		$("#message").slideUp(750,function() {
		$('#message').hide();

 		$('#submit')
			.after('<img src="images/ajax-loader.gif" class="loader" />')
			.attr('disabled','disabled');

		$.post(action, {
			bookID: $('#bookID').val(),
		},
			function(data){
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');
				$('#usercpform img.loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit').removeAttr('disabled');
				

			}
		);

		});

		return false;

	});
	
	$('#usercpformcnl').submit(function(){

		var action = $(this).attr('action');
		var val = $('#bookID').val();

		$("#message"+val).slideUp(750,function() {
		$('#message'+val).hide();

 		$('#submit')
			.after('<img src="images/ajax-loader.gif" class="loader" />')
			.attr('disabled','disabled');

		$.post(action, {
			bookID: $('#bookID').val(),
		},
			function(data){
				document.getElementById('message'+val).innerHTML = data;
				$('#message'+val).slideDown('slow');
				$('#usercpformcnl img.loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit').removeAttr('disabled');


			}
		);

		});

		return false;

	});


	
	$('#contactform').submit(function(){

		var action = $(this).attr('action');

		$("#message").slideUp(750,function() {
		$('#message').hide();

 		$('#submit')
			.after('<img src="assets/ajax-loader.gif" class="loader" />')
			.attr('disabled','disabled');

		$.post(action, {
			name: $('#name').val(),
			email: $('#email').val(),
			subject: $('#subject').val(),
			comments: $('#comments').val(),
			verify: $('#verify').val()
		},
			function(data){
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');
				$('#contactform img.loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit').removeAttr('disabled');
				if(data.match('success') != null) $('#contactform .form-group, #contactform .btn').slideUp('slow');

			}
		);

		});

		return false;

	});

});