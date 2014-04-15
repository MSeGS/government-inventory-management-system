$(document).ready(function(){
	$('.datepicker').pickadate({
		selectYears: true,
		selectMonths: true
	});

	//table row link
	$('tr.link').on('click', function(){
		window.location = $(this).attr('href');
	});

	initTooltips();

	var $selects = $('select.dropdown');
						
	$selects.easyDropDown({
		cutOff: 10,
		wrapperClass: 'easydropdown',
		onChange: function(selected){
			// do something
		}
	});
});

function initTooltips()
{
	$('.tooltip-top').tooltip({'placement':'top'});
	$('.tooltip-bottom').tooltip({'placement':'bottom'});
	$('.tooltip-left').tooltip({'placement':'left'});
	$('.tooltip-right').tooltip({'placement':'right'});
}

$('#checkAll').click(function () {    
     $('input:checkbox').prop('checked', this.checked);    
 });