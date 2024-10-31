var jQuery = jQuery.noConflict();
jQuery(document).ready(function () {


// if no records found in optimize_status_log then display default chart  
//otherwise display count based chart                         
jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
	dataType: 'json',
        data: {
            'action': 'optimize_check_DB',
          
        },

        cache: false,
        success: function (response) {    
var value =JSON.parse(response);           

            if ( value == 0 ) {     
		default_duplicate_chart();
            }
            else {  
	count_based_chart();
}  
} 
});

		
		});

function choose_chartType(value) 
{                                     
if(value == 'count_based')
{
count_based_chart();
}
else if(value == 'size_based')
{
size_based_chart();
}
else
{
default_duplicate_chart();
}
}

function piechart()
{
	jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
            'action': 'optimize_piechart',
            'postdata': 'piechartdata',
        },
        dataType: 'json',
        cache: false,
        success: function (data) {   
            var browser = JSON.parse(data);   
	//alert(data);
            if (browser.length == 0) {   
                jQuery('#pieStats').html("<h2 style='color: red;text-align: center;padding-top: 100px;' >No Records found</h2>");
            } 
else
{

    // Create the chart
    jQuery('#pieStats').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Optimize Plugin'
        },
        subtitle: {
            text: 'Deleted Records Statistics'
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}'
        },
        series: [{
	   
            name: 'Overall Statistics',
            colorByPoint: true,
            data: browser
      }] 
    });
}
}
});

}


function default_duplicate_chart()
{      
                           
jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
	dataType: 'json',
        data: {
            'action': 'optimize_default_chart',
          
        },

        cache: false,
        success: function (response) {    


            if (response.length == 0) {     
		jQuery('#drillStats').html("<h2 style='color: red;text-align: center;margin-top: 140px;' >" + 'No Records found'+ "</h2>");
            }
            else {  
jQuery(function () {                           
 
 
    // Create the chart
    jQuery('#drillStats').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Optimize Plugin - Deleted Records Info'
        },
        subtitle: {
            text: 'Click the slices to view the deleted records in datewise'
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}'
        },
        series: [{
            name: "Overall Statistics",
            colorByPoint: true,
            data: response.pieDefaultValues
        }],
        drilldown: {
            series: response.drillDefaultValues
        }
    });
});
}
}   
});
}


function count_based_chart()
{    
jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
	dataType: 'json',
        data: {
            'action': 'countBased_chart',
          
        },

        cache: false,
        success: function (response) {    


            if (response.length == 0) {     
		jQuery('#drillStats').html("<h2 style='color: red;text-align: center;margin-top: 140px;' >" + 'No Records found'+ "</h2>");
            }
            else {  
jQuery(function () {                           
 
 
    // Create the chart
    jQuery('#drillStats').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Optimize Plugin - Deleted Records Info'
        },
        subtitle: {
            text: 'Click the slices to view the deleted records in datewise'
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}'
        },
        series: [{
            name: "Overall Statistics",
            colorByPoint: true,
            data: response.PieArray
        }],
        drilldown: {
            series: response.drillDownArray
        }
    });
});
}
}   
});
}
   

function size_based_chart()
{    
                           
jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
	dataType: 'json',
        data: {
            'action': 'sizeBased_chart',
          
        },

        cache: false,
        success: function (response) {   


            if (response.length == 0) {     
		jQuery('#drillStats').html("<h2 style='color: red;text-align: center;margin-top: 140px;' >" + 'No Records found'+ "</h2>");
            }
            else {  
jQuery(function () {                           
 
 
    // Create the chart
    jQuery('#drillStats').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Optimize Plugin - Deleted Records Info'
        },
        subtitle: {
            text: 'Click the slices to view the deleted records in datewise'
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}'
        },
        series: [{
            name: "Overall Statistics",
            colorByPoint: true,
            data: response.PieArray
        }],
        drilldown: {
            series: response.drillDownArray
        }
    });
});
}
}   
});
}
           
        
