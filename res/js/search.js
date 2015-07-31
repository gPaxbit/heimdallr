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
						$match.html('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus odio nesciunt harum neque deserunt deleniti nemo, explicabo id accusamus voluptatum dolor, porro eligendi possimus culpa pariatur. Omnis dolores, ad nam enim illo debitis commodi dolor a. Reprehenderit eveniet consectetur dolor quibusdam in nobis sapiente tenetur doloribus sequi molestiae consequatur, qui necessitatibus voluptate. Architecto recusandae magnam veritatis necessitatibus, repellat cumque vitae quas inventore libero officiis! Dolore adipisci, doloribus repellendus. Sit dolor maiores expedita nulla provident asperiores, mollitia voluptatum modi, fugit dolorem obcaecati facilis saepe delectus. Ipsum officiis impedit aut eius qui dignissimos pariatur in optio perferendis consectetur, expedita reprehenderit quidem accusantium dicta, sunt animi porro dolor alias velit quod corrupti esse cupiditate nobis delectus. Debitis laborum quis nobis aperiam illo. Laudantium minima sunt adipisci culpa temporibus placeat, quisquam sint sapiente repellendus vitae harum, eum. Omnis nisi, iure est nesciunt aliquam dolores, laborum deserunt possimus, quibusdam velit quis in dolor. Doloribus officiis saepe iusto quod doloremque explicabo asperiores atque eos?');
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
});