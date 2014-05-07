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
			$('#theme').attr('href','/templates/default/lib/bootstrap/' + theme + '.min.css');
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


var plotter = {
	settings:{
		data:{},
		url:'',
		container:'',
		loading:false,
		options:{
			series:{
                grow:{
                    active:false
                },
                lines:{
                    show:false
                },
                splines: {
                    show:true,
                    fill:true
                },
                points: {
                    show: true
                }
            },
            grid: {
                hoverable: true,
                clickable: true
            },
            xaxis:{
            	mode:"time",
                font:{
                    color:"#FFFFFF"
                }
            },
            yaxis: {
                font:{
                    color:"#FFFFFF"
                }
            }
		}
	},
	init: function(opts){
		$.extend(this.settings,opts);
		this.settings.container.html('');
		this.setupHover();
		this.fetchData();
	},
	fetchData: function(){
		self = this;
		if(self.settings.loading)
			self.settings.loading.fadeIn(100);

		$.ajax({
			url:this.settings.url,
			type:'post',
			data:this.settings.data,
			dataType:'JSON'
		}).done(function (plotData) {
			self.plot(plotData);
		})
	},
	plot:function(plotData){
		$.plot(this.settings.container,plotData,self.settings.options);

		if(self.settings.loading)
			self.settings.loading.fadeOut(100);
	},
	invert:function (rgb) {
	    rgb = [].slice.call(arguments).join(",").replace(/rgb\(|\)|rgba\(|\)|\s/gi, '').split(',');
		for (var i = 0; i < rgb.length; i++) rgb[i] = (i === 3 ? 1 : 255) - rgb[i];
		return rgb.join(", ");
	},
	setupHover:function () {
		self = this;

		$("<div id='tooltip'></div>").css({
	        position: "absolute",
	        display: "none",
	        border: "1px solid #fdd",
	        padding: "2px 8px",
	        "background-color": "#fee",
	        opacity: 0.80
	    }).appendTo("body");

		$(self.settings.container).bind("plothover", function (event, pos, item) {
	        if (item) {
	            var y = item.datapoint[1].toFixed(0);
	            $("#tooltip").html(y)
	                .css({backgroundColor:item.series.color, borderColor:'rgb('+self.invert(item.series.color) + ')', color:'rgb('+self.invert(item.series.color) + ')',top: item.pageY+5, left: item.pageX+5})
	                .fadeIn(200);
	        } else {
	            // $("#tooltip").hide();
	        }
	    });
	}


};