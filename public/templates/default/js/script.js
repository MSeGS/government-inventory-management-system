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

	$('.theme-list li a').click(function(e){
		e.preventDefault();
		var theme = $(this).data('name');
		if(theme != 'default')
			$('#theme').attr('href','/templates/default/lib/bootstrap/themes/' + theme + '.min.css');
		else
			$('#theme').removeAttr('href');
		$.get('/set-theme/'+theme);
		$(this).closest('.dropup').find('.theme-name').text(theme);
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