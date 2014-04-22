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

	initDropdown();
	
	$('#checkAll').click(function () {    
	    $('input.checkall:checkbox').prop('checked', this.checked);    
	});
});

function initTooltips()
{
	$('.tooltip-top').tooltip({'placement':'top'});
	$('.tooltip-bottom').tooltip({'placement':'bottom'});
	$('.tooltip-left').tooltip({'placement':'left'});
	$('.tooltip-right').tooltip({'placement':'right'});
}

function initDropdown() {
	var $selects = $('select.dropdown');
	$selects.easyDropDown({
		cutOff: 10,
		wrapperClass: 'easydropdown',
		onChange: function(selected){
			// do something
		}
	});
}

function destroyDropdown() {
	$('.dropdown').easyDropDown('destroy');
	$('.dropdown').removeAttr("id");
}