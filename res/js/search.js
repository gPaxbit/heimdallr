$(function() {

	$('#searchForm [type="text"]').select(function() {
		return false;
	});

	$('#searchForm .send').click(function() {
		var $form = $(this).closest('form'),
			$data = $form.serialize(),
			$match = $form.next('.matches');

		$.ajax({
			type: 'POST',
			url: '/lib/search.php',
			data: $data,
				success: function(data) {
					if(data == '') {
						$match.html('<span>No matches</span>');
					} else {
						$match.html(data);
					}
				}	
			});
		return false;
	});

	$('#searchForm').keydown(function(e) {
		if( e.keyCode === 13 ) {
			return false;
		}
	});

	/*$('#searchForm [type="text"]').keyup(function(e) {
		var $form = $(this).closest('form'),
			$data = $form.serialize(),
			$match = $form.next('.matches');

		setTimeout (function() {
			$.ajax({
			type: 'POST',
			url: '/lib/search.php',
			data: $data,
				success: function(data) {
					if(data == '') {
						$match.html('<span>No matches</span>');
					} else {
						$match.html(data);
					}
				}	
			});
		}, 500);
		return false;
	});
*/
});