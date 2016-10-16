	function Confirmacion(cod){
		
		$.confirm({
			'title'		: 'Eliminar?',
			'message'	: 'Usted esta apunto de eliminar esta instiucion. <br />No podra deshacer los cambios! ¿Continuar?',
			'buttons'	: {
				'Si'	: {
					'class'	: 'blue',
					'action': function(){
						$.ajax({
							type: "POST",
							url: "eliminar_institucion.php?cod_institucion="+cod,
							success: function(){
								location.reload();
							}
						})
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
	}
	
	function ConfirmacionE(cod){
		
		$.confirm({
			'title'		: 'Eliminar?',
			'message'	: 'Usted esta apunto de eliminar esta especialidad. <br />No podra deshacer los cambios! ¿Continuar?',
			'buttons'	: {
				'Si'	: {
					'class'	: 'blue',
					'action': function(){
						$.ajax({
							type: "POST",
							url: "eliminar_especialidad.php?cod_especialidad="+cod,
							success: function(){
								location.reload();
							}
						})
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
	}
		
	function ConfirmacionA(cod){
		
		$.confirm({
			'title'		: 'Eliminar?',
			'message'	: 'Usted esta apunto de eliminar esta area. <br />No podra deshacer los cambios! ¿Continuar?',
			'buttons'	: {
				'Si'	: {
					'class'	: 'blue',
					'action': function(){
						$.ajax({
							type: "POST",
							url: "eliminar_area.php?cod_area="+cod,
							success: function(){
								location.reload();
							}
						})
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
	}
	
	function ConfirmacionF(cod){
		
		$.confirm({
			'title'		: 'Eliminar?',
			'message'	: 'Usted esta apunto de eliminar este factor. <br />No podra deshacer los cambios! ¿Continuar?',
			'buttons'	: {
				'Si'	: {
					'class'	: 'blue',
					'action': function(){
						$.ajax({
							type: "POST",
							url: "delete_factor.php?cod_factor="+cod,
							success: function(){
								location.reload();
							}
						})
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
	}
	
	function ConfirmacionDP(cod){
		
		$.confirm({
			'title'		: 'Eliminar?',
			'message'	: 'Usted esta apunto de eliminar este pasante. <br />No podra deshacer los cambios! ¿Continuar?',
			'buttons'	: {
				'Si'	: {
					'class'	: 'blue',
					'action': function(){
						$.ajax({
							type: "POST",
							url: "eliminar_pasante.php?cedula="+cod,
							success: function(){
								window.location.replace("http://desarrolloweb2.pzo.cvg.com/scpasantes/buscar.php");

							}
						})
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
	}
	
	function ConfirmacionEP(cedu,cod){
		
		$.confirm({
			'title'		: 'Eliminar?',
			'message'	: 'Usted esta apunto de eliminar esta pasantia. <br />No podra deshacer los cambios! ¿Continuar?',
			'buttons'	: {
				'Si'	: {
					'class'	: 'blue',
					'action': function(){
						$.ajax({
							type: "POST",
							url: "eliminar_pasantia.php?cedula="+cedu+"&cod="+cod,
							success: function(){
								window.location.replace("http://desarrolloweb2.pzo.cvg.com/scpasantes/perfil_pasante.php?cedula="+cedu);

							}
						})
					}
				},
				'No'	: {
					'class'	: 'gray',
					'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
	}
