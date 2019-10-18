jQuery(document).ready(function($){
	var $seleccionado = "precio";
	var $despues =[];
	var $data = $(".portfolio,.team").clone();
	var $despues = $data.find('.item-thumbs');
if (jQuery().quicksand) {
	///obtener que radiobutton esta seleccionado
$("input[name=optradio]").change(function (){	 
		$seleccionado = $(this).val();
if($seleccionado == 'precio'){
	$despues.sort(function (a, b){
	return (a.dataset.precio - b.dataset.precio)
})}
if($seleccionado == 'rendimiento'){
	$despues.sort(function (a, b){
	return (b.dataset.rendimiento - a.dataset.rendimiento)
})}
if($seleccionado == 'pasajeros'){
	$despues.sort(function (a, b){
	return (b.dataset.pasajeros - a.dataset.pasajeros)
})}
	// fin de los ordenamientos
		$(".portfolio,.team").quicksand($despues, {
			duration: 600,
			adjustHeight: 'auto'
		}, function () {
		$("a[data-pretty^='prettyPhoto']").prettyPhoto();
			});		
		$(this).addClass("active"); 			
		return false;
		});
//NOTE: Only filter on the main portfolio page, not on the subcategory pages
$('.filter li').click(function(e) {	
		$(".filter li").removeClass("active");	
		// Use the last category class as the category to filter by.
		var filterClass=$(this).attr('class').split(' ').slice(-1)[0];
		//console.log(filterClass);//llega el campo por el que se va a filtrar
		if (filterClass == 'all') {
			var $filteredData = $data.find('.item-thumbs');
		} else {
			var $filteredData = $data.find('.item-thumbs[data-type=' + filterClass + ']');
		}
//cuando ya se selecciono el primer filtro se aplica el ordenamiento
if($seleccionado == 'precio'){
	$filteredData.sort(function (a, b){
	return (a.dataset.precio - b.dataset.precio)
})}
if($seleccionado == 'rendimiento'){
	$filteredData.sort(function (a, b){
	return (b.dataset.rendimiento - a.dataset.rendimiento)
})}
if($seleccionado == 'pasajeros'){
	$filteredData.sort(function (a, b){
	return (b.dataset.pasajeros - a.dataset.pasajeros)
})}
	$despues = $filteredData;
// fin de los ordenamientos
		$(".portfolio,.team").quicksand($filteredData, {
			duration: 600,
			adjustHeight: 'auto'
		}, function () {
		$("a[data-pretty^='prettyPhoto']").prettyPhoto();
			});			
		$(this).addClass("active"); 			
		return false;
	});
}//if quicksand
});