$(document).ready(function() {
	$('form').submit(function(event) {
		event.preventDefault();
		var username = $('#username').val();
		$.ajax({
			url: 'get_stats.php',
			type: 'GET',
			data: {username: username},
			success: function(data) {
				$('#stats-container').html(data);
			},
			error: function() {
				$('#stats-container').html('<p>There was an error retrieving the account information.</p>');
			}
		});
	});
});
