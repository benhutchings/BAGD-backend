$(document).ready(function() {
	$("select[multiple='multiple']").each(function(){
	    var select = $(this),
	    	values = {};
	    $('option', select).each(function(i, option){
	        values[option.value] = option.selected;
	    }).click(function(event){
	        values[this.value] = !values[this.value];
	        $('option',select).each(function(i, option){
	            option.selected = values[option.value];

	            if(option.value == "Other"){
	            	if (values.Other){
	            		console.log("yes");
		        		$("[data-field_name='other:']").removeClass('acf-conditional_logic-hide').addClass('acf-conditional_logic-show');
				    }else if (values.Other === false){
				    	console.log("no");
				    	$("[data-field_name='other:']").removeClass('acf-conditional_logic-show').addClass('acf-conditional_logic-hide');
				    }
	            }
	        });
	    });
	});
});