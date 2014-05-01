var data = [
	{ label: "Administrator",  data: 10, color:'#3EBFBE'},
	{ label: "Indentor",  data: 80, color:'#FFB553'},
	{ label: "Store Keeper",  data: 120, color:'#FA4444'}
];
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
    	color: '#ffffff'
    }
	});

	// $.plot('#users_pie', data, {
	//     series: {
	//         bars:{
	//         	show:true
	//         }
	//     }
 //    });
});