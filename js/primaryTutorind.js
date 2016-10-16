$(document).ready(function(){
	$('.suge').keyup(function() {
		var search_term = $(this).val();
		$.post('ajax/searchTutorInd.php', {search_term:search_term}, function(data){
			
			$('.result').html(data);
			$('.result li').click(function(){
				var result_value = $(this).text();
				$('.suge').val(result_value);
				$('.result').html('');
			});

		});
	});
});