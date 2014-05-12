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

var q;
var plotter = {
	plotHover:false,
	plotData:null,
	settings:{
		data:{},
		url:'',
		container:'',
		loading:false,
		extraInfo:false,
		debug:false,
		options:{
			series:{
                grow:{
                    active:true,
                    duration:500
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
		$.extend(true,this.settings,opts);

		if(this.settings.debug == true){
			this.settings.options.series.splines.show = false;
			this.settings.options.series.lines.show = true;
			this.settings.options.series.grow.activate = false;
		}

		this.settings.container.html('');
		this.setupHover();
		this.fetchData();
		if(this.settings.extraInfo == true){
			$(this.settings.container).bind('plotclick',function(a,b,c){
				self.updateTooltip(a,c);
			});
		}
		return this;
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
		}).done(function (data) {
			self.plot(data);
			self.plotData = data;
		})
	},
	plot:function(data){
		if(data.status == 'success'){
			$.plot(this.settings.container,data.plotData,self.settings.options);
			console.log('success');
			if(self.settings.loading){
				console.log('fadeOut');
				self.settings.loading.fadeOut(100);
			}
		}
		else{
			if(self.settings.loading)
				self.settings.loading.fadeOut(100);
			self.settings.loading.parent().append('<div style="display:none" class="plot-error well text-warning"><i class="fa fa-warning"></i><p>Sorry. There is nothing here yet.</p></div>').find('.plot-error').fadeIn('fast');
		}
	},
	invert:function (rgb,opacity) {
	    rgb = [].slice.call(arguments).join(",").replace(/rgb\(|\)|rgba\(|\)|\s/gi, '').split(',');
		for (var i = 0; i < rgb.length; i++)
			rgb[i] = (i === 3 ? 1 : 255) - rgb[i];
		if(rgb.length > 3)
			return 'rgba('+rgb.join(", ")+')';
		if(opacity)
			return 'rgba(' + rgb.join(", ") + ',' + opacity + ')';
		else
			return 'rgb(' + rgb.join(", ") + ')';
	},
	setupHover:function () {
		self = this;

		$("<div id='tooltip'></div>").css({
	        position: "absolute",
	        display: "none",
	        width:function(){ // TODO screen size azirin update ta ila.
	        	return self.settings.container.width() / 4
	        }
	    }).appendTo("body");
	},
	updateTooltip: function(event, item){
		if(item){
			var color = item.series.color;
			$('#tooltip').css({ top: item.pageY+5, left: item.pageX+5});
			var self = this;
			var pointTotal = item.datapoint[1].toFixed(0);
			if(self.settings.extraInfo){

				var html = '<div class="panel panel-success">';
				var unixDate = item.datapoint[0];

				var d = new Date(unixDate);
				// console.log(item.datapoint[0]);
				console.log(self.plotData.extra[unixDate]);

				html+='<div class="panel-heading"><strong>Total : '+pointTotal+'</strong> <strong class="pull-right">Date : '+self.plotData.extra[unixDate].date+'</strong></div>';
				
				if(pointTotal > 0){

					html+='<div class="panel-body">';
					html+='<table class="table">';

					var currentData = self.plotData.extra[unixDate];
					var items = currentData.items;
					for(var i=0;i<items.length;i++){
						html+='<tr>';
						html+='<td>'+items[i].name+'</td>';
						html+='<td>'+items[i].value+'</td>';
						html+='</tr>';
					}

					html+='</table>';
				}
				html+='</div></div>';

				$("#tooltip")
					.html(html)
		            .fadeIn(200);
			}else{
				$("#tooltip").css({'fontWeight':'bold',borderRadius:5,padding:'4px 8px',backgroundColor:color,color:self.invert(color)}).html(pointTotal).fadeIn();
			}
		}else{
			$('#tooltip').fadeOut();
		}
	}
};