$(function() {

	$('.trigger').click(function() {
		$hash = $(this).data('hash');
		return $hash;
	});

	$('body').on('click', '.edit', function() {
		var $prnt = $(this).closest('tr'), $val = [], $blank = $('#edit');
		$prnt.find('td').each(function() {$val.push($(this).text()); return $val;});
		$blank.toggleClass('active');
		if($(this).data('target') == 'ftp') {
			$blank.find('#row').val($val[0]);
			$blank.find('#name-ftp').val($val[0]);
			$blank.find('#host-ftp').val($val[1]);
			$blank.find('#login-ftp').val($val[2]);
			$blank.find('#pwd-ftp').val($val[3]);
			$blank.find('#port-ftp').val($val[4]);
		}
		else if($(this).data('target') == 'pwd') {
			$blank.find('#row').val($val[0]);
			$blank.find('#name-pwd').val($val[0]);
			$blank.find('#login-pwd').val($val[1]);
			$blank.find('#pwd-pwd').val($val[2]);
		}
		//console.log($val+" /edit");
		return false;
	});

	$('body').on('click', '.edit-group', function() {
		var $head = $(this).closest('.header');
		var $name = $head.find('span').html();
		$head.find('span').html('<form id="rnm-gform"><input type="hidden" name="rnm-group_h" id="rnm-group_h" value="'+$name+'"><input type="text" placeholder="name" name="rnm-group" id="rnm-group" value="'+$name+'"><input type="submit" value="Rename"><a href="#" class="rnm-group_c">Cancel</a></form>');
		$head.find('a.icon').hide();
		return false;
	});
	
	$('body').on('click', '.rnm-group_c', function() {
		var $name = $(this).siblings('[type="hidden"]').val();
		var $head = $(this).closest('.header');
		$head.find('span').html($name);
		$head.find('a.icon').show();
	});

	$('body').on('submit', '#rnm-gform', function() {
		var $data = $(this).serialize();
		//console.log($data);
		$.ajax({
			type: 'POST',
			url: '/lib/event/rename.php',
			data: "event=edit_group&source="+$hash+"&"+$data,
				success: function(res) {
					$('.wait').fadeIn();
					setTimeout(function() {
						$('.wait').fadeOut();
						$('.notify').animate({'top': '10px'}, 300).html('Rename!');
						$('#result').load('/src/inc/'+res+'.php');
					}, 1600);
					setTimeout(function() {
						$('.notify').animate({'top': '-210px'}, 300);
					}, 4100);
				}	
			});
		return false;
	});

	$('body').click(function() {
		if($('.sideRight').hasClass('active')) {
			$('.sideRight').removeClass('active');
		}
		$('.main > li > a').click(function(e) {
			e.stopPropagation();
		});
	});

	$('body').on('click', '.cancel', function() {
		$('.sideRight').removeClass('active');
	});

	$('body').on('click', '#edit', function(e) {
		e.stopPropagation();
	});

	$('body').on('submit', '#edit', function(){
		var $data = $('#edit').serialize();
		//console.log($data);
		$.ajax({
			type: 'POST',
			url: '/lib/event/rename.php',
			data: "event=edit&"+$data,
				success: function(res) {
					$('#edit').find('[type="text"]').val('');
					$('.sideRight').removeClass('active');
					$('.wait').fadeIn();
					setTimeout(function() {
						$('.wait').fadeOut();
						$('.notify').animate({'top': '10px'}, 300).html('Update!');
						$('#result').load('/src/inc/'+res+'.php');
					}, 1600);
					setTimeout(function() {
						$('.notify').animate({'top': '-210px'}, 300);
					}, 4100);
				}	
			});
		return false;
	});

	$('body').on('click', 'a.remove', function(){
		var $data = [];
		$(this).closest('td').siblings('td').each(function() {
			$data.push($(this).text());
			return $data;
		});
		var $target = $(this).data('target');
		if($target == 'ftp') {
			$send = "name="+$data[0]+"&host="+$data[1]+"&login="+$data[2];
		}
		if($target == 'pwd') {
			$send = "name="+$data[0]+"&login="+$data[1]+"&pwd="+$data[2];
		}
		//console.log($send);
		if(confirm('Are you sure?')) {
			$.ajax({
				type: 'POST',
				url: '/lib/event/delete.php',
				data: "event=delete&source="+$target+"&"+$send,
					success: function(res) {
						$('.sideRight').removeClass('active');
						$('.wait').fadeIn();
						setTimeout(function() {
							$('.wait').fadeOut();
							$('.notify').animate({'top': '10px'}, 300).html('Deleted');
							$('#result').load('/src/inc/'+res+'.php');
						}, 1600);
						setTimeout(function() {
							$('.notify').animate({'top': '-210px'}, 300);
						}, 4100);
					}	
				});
		} else {
			$.noop();
		}
		return false;
	});

});