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

	$('.matches').on('click', 'tbody td', function() {
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
				case 'group':
					return false;
					break;
			}
		});		
		return false;
	}
	
});