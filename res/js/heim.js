function EscapeSearch() {
	$(document).keydown(function(e) {
		if( e.keyCode === 27 && $('.search').show()) {
			$('.search').animate({'top': '-110%'}, 600)
				.find('[type="text"]').val('');
			$('.matches').html('');
			$('.overlay').delay(300).fadeOut(300);
		}
		if (e.keyCode === 13) {
			$.noop();
		}
	});
}



$(function() {
	
	$('.trigger').click(function() {
		var $hash = $(this).data('hash');
		var $ul = $(this).next('ul');
		if ( $ul.size() != 0 ) { _call($hash); }
		else {
			if($hash == 'search') {				
				$('.overlay').fadeIn(300);
				$('.search').animate({'top': '10%'}, 600)
				EscapeSearch();
			} else { 
				$('#result').load('/src/inc/'+$hash+'.php', {data: 'Be loaded '+$hash}); 
			}
		}
	});

	$('body').on('click', 'td', function() {
		var e=this;
		if(window.getSelection){
			var s=window.getSelection();
			if(s.setBaseAndExtent){
			s.setBaseAndExtent(e,0,e,e.innerText.length-1);
		}else{
			var r=document.createRange();
			r.selectNodeContents(e);
			s.removeAllRanges();
			s.addRange(r);}
		}else if(document.getSelection){
			var s=document.getSelection();
			var r=document.createRange();
			r.selectNodeContents(e);
			s.removeAllRanges();
			s.addRange(r);
		}else if(document.selection){
			var r=document.body.createTextRange();
			r.moveToElementText(e);
			r.select();
		}
	});

	$('body').on('click', '.cftp', function() {

		var $prnt = $(this).closest('tr');
		var $val = [];
		var $blank = $('.blank');

		$prnt.find('td').each(function() {
			$val.push($(this).text());
			return $val;
		});
		$val = $val.slice(1, 5);

		if($blank.hasClass('active')) {
			$blank.find('#host').val($val[0]);
			$blank.find('#login').val($val[1]);
			$blank.find('#pwd').val($val[2]);
			$blank.find('#port').val($val[3]);
		} else {
			$blank.toggleClass('active');
			$blank.find('#host').val($val[0]);
			$blank.find('#login').val($val[1]);
			$blank.find('#pwd').val($val[2]);
			$blank.find('#port').val($val[3]);
		}

		console.log($val+" /connect");

		return false;
	});

	$('body').click(function() {
		if($('.blank').hasClass('active')) {
			$('.blank').removeClass('active');
			$('.blank').find('[type="text"]').each(function() {
				$(this).val('');
			});
		}
		$('[data-event="connect"], .blank, .main > li > a').click(function(e) {
			e.stopPropagation();
		});
	});

	$('.overlay').click(function() {
		$('.search').animate({'top': '-110%'}, 600)
			.find('[type="text"]').val('');
		$('.matches').html('');
		$(this).delay(300).fadeOut(300);
	});
	
	var _call = function(parentGroup) {
		var $hash = $('.'+parentGroup).data('hash');
		var $ul = $('.'+parentGroup).next('ul');
		$ul.slideToggle();
		$ul.find('a').click(function() {
			var $event = $(this).data('event');
			switch ($event) {
				case 'show':						
					$('#result').load('/src/inc/'+$hash+'.php');
					break;
				case 'add':
					$('.overlay').fadeIn(300);
					EscapeSearch();
					break;
				case 'connect':
					$('.blank').toggleClass('active');
			}
		});		
		return false;
	}
	
});