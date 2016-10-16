$(document).ready(function() {

		var checking_html = '<img src="img/loading.gif"/>';
		var min_chars = 3;
		var min_chars2 = 4;
		var error_minimo = '<span style="color:red;">Debe ingresar al menos '+min_chars+' letras';
		
		$('#nombre_area').keyup(function(){
			if($('#nombre_area').val().length < min_chars){
				$('#avaliability').html(error_minimo);
				$('#nombre_area').removeClass('good');
				$('#nombre_area').addClass('warning');
			}else{
				$('#avaliability').html(checking_html);
				check_availability();
			}
		});

		$('.formss input[type=text]').not('#nombre_area').blur(function(){
			if(!this.value.replace(/^\s+|\s+$/g, "")){
				$(this).removeClass('good');
				$(this).addClass('warning');
			}
		});
		
		
		$('.formss input[type=text]').not('#nombre_area').keyup(function(){
			if($(this).val().length < min_chars2){
				$(this).removeClass('good');
				$(this).addClass('warning');
			}else{
				$(this).removeClass('warning');
				$(this).addClass('good');
			}			
		});
		
  });

//function to check username availability
function check_availability(){
		//get the instituto
		var area = $('#nombre_area').val().toUpperCase().trim();
		//use ajax to run the check
		$.post("checkArea.php", { area: area },
			function(result){
				//if the result is 1
				if(result == 1){
					//show that the instituto is available
					$('#avaliability').html('<span style="color:red;">Esa institucion ya esta registrada');
					$('#nombre_area').removeClass('good');
					$('#nombre_area').addClass('warning');
				}else{
					//show that the instituto is NOT available
					$('#avaliability').html('<span style="color:#73d216;">Esa institucion no esta registrada</span>');
					$('#nombre_area').removeClass('warning');
					$('#nombre_area').addClass('good');
				}	
		});

}
