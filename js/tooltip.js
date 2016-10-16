$(document).ready(function() {
	var showTooltip = function(event) {
	   $('div.tooltip').remove();
	   $('<div class="tooltip">Eliminar</div>')
	     .appendTo('body');
	   changeTooltipPosition(event);
	};
	var changeTooltipPosition = function(event) {
		var tooltipX = event.pageX - 8;
		var tooltipY = event.pageY + 8;
		$('div.tooltip').css({top: tooltipY, left: tooltipX});
	};
	var hideTooltip = function() {
		$('div.tooltip').remove();
	};
	$(".teliminar").bind({
		mousemove : changeTooltipPosition,
		mouseenter : showTooltip,
		mouseleave: hideTooltip
	});

	var showTooltip2 = function(event) {	
	   $('div.tooltip').remove();
	   $('<div class="tooltip">Editar</div>')
	     .appendTo('body');
	   changeTooltipPosition(event);
	};

	$(".teditar").bind({
		mousemove : changeTooltipPosition,
		mouseenter : showTooltip2,
		mouseleave: hideTooltip
	});
	
	var showTooltip2 = function(event) {	
	   $('div.tooltip').remove();
	   $('<div class="tooltip">Ver Ficha</div>')
	     .appendTo('body');
	   changeTooltipPosition(event);
	};

	$(".ficha").bind({
		mousemove : changeTooltipPosition,
		mouseenter : showTooltip2,
		mouseleave: hideTooltip
	});
	
	var showTooltip2 = function(event) {	
	   $('div.tooltip').remove();
	   $('<div class="tooltip">Ver Detalle</div>')
	     .appendTo('body');
	   changeTooltipPosition(event);
	};

	$(".detalle").bind({
		mousemove : changeTooltipPosition,
		mouseenter : showTooltip2,
		mouseleave: hideTooltip
	});
	
	var showTooltip2 = function(event) {	
	   $('div.tooltip').remove();
	   $('<div class="tooltip">Entidad en uso, no puede ser eliminada</div>')
	     .appendTo('body');
	   changeTooltipPosition(event);
	};

	$(".no_disponible").bind({
		mousemove : changeTooltipPosition,
		mouseenter : showTooltip2,
		mouseleave: hideTooltip
	});	
	
	var showTooltip3 = function(event) {	
	   $('div.tooltip').remove();
	   $('<div class="tooltip">No puede eliminar este pasante <br> ya que tiene pasantias registradas</div>')
	     .appendTo('body');
	   changeTooltipPosition(event);
	};

	$(".tiene_pasantia").bind({
		mousemove : changeTooltipPosition,
		mouseenter : showTooltip3,
		mouseleave: hideTooltip
	});

});