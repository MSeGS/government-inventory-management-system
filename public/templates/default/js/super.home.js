var data = [
	{ label: "Administrator",  data: 10, color:'#3EBFBE'},
	{ label: "Indentor",  data: 80, color:'#FFB553'},
	{ label: "Store Keeper",  data: 120, color:'#FA4444'}
];

var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
$(function(){
	//data zawng zawng lak khawm maybe?
	$.plot('#users_pie', data, {
    series: {
        pie: {
            innerRadius: 0.5,
            show: true,
            label: {
            	show: false
            }
        },
        color:['#3EBFBE','#FFB553','#FA4444']
    },
    legend: {
    	show: true,
    	backgroundOpacity: 0,
    	color: '#ffffff',
        labelFormatter:function(label,series){
                return label+'('+series.data[0][1]+')';
            }
    }
	});

    d = new Date();
    // ajaxChart('#overall_chart','/ajax-super/year/string',d.getFullYear(),true);
    ajaxChart('#month_chart','/ajax-super/month/'+d.getFullYear(),d.getFullYear(),true);
    
    $("<div id='tooltip'></div>").css({
        position: "absolute",
        display: "none",
        border: "1px solid #fdd",
        padding: "2px 8px",
        "background-color": "#fee",
        opacity: 0.80
    }).appendTo("body");

    $("#month_chart, #overall_chart").bind("plothover", function (event, pos, item) {
        if (item) {
            var y = item.datapoint[1].toFixed(0);
            $("#tooltip").html(y)
                .css({backgroundColor:item.series.color, borderColor:'rgb('+invert(item.series.color) + ')', color:'rgb('+invert(item.series.color) + ')',top: item.pageY+5, left: item.pageX+5})
                .fadeIn(200);
        } else {
            // $("#tooltip").hide();
        }
    });
});

function invert(rgb) {
    rgb = [].slice.call(arguments).join(",").replace(/rgb\(|\)|rgba\(|\)|\s/gi, '').split(',');
    for (var i = 0; i < rgb.length; i++) rgb[i] = (i === 3 ? 1 : 255) - rgb[i];
    return rgb.join(", ");
}

function ajaxChart(container,source,value,isMonths){
    $(container).parent().find('.loading').show();
    $(container).html('');
    $(container).closest('.chart-wrap').find('.chart-button').text(value);
    
    var options = {
            series:{
                grow:{
                    active:true
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
                font:{
                    color:"#FFFFFF"
                }
            },
            yaxis: {
                font:{
                    color:"#FFFFFF"
                }
            }
        };
    var data=[];

    if(isMonths == true){
        options.xaxis.tickFormatter = function(val,axis){
                    return months[val-1];
                };
    }

    $.ajax({
        'url':source,
        'type':'get',
        'dataType':'json'
    }).complete(function(data){
        $(container).parent().find('.loading').hide();
        $.plot(container,data.responseJSON,options); 
    });
    return false;
}
