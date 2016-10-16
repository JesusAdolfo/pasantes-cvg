$(document).ready(function(){
	$('.autosuggest').keyup(function() {

		var search_term = $(this).val().toUpperCase();
		$.post('ajax/searchE.php', {search_term:search_term}, function(data){

			$('.result').html(data);
			$('.result li').click(function(){
				var result_value = $(this).text();
				$('.autosuggest').val(result_value);
				$('.result').html('');
			});

		});
	});
});