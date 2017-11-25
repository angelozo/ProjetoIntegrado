$(document).ready(function() {
	$(".button-collapse").sideNav();
	$('select').material_select();
	$('.cpf').mask('000.000.000-00', {reverse: true});
	$('.phone_with_ddd').mask('(00) 0000-0000');
})