jQuery(document).ready(function($) {
    $("select[multiple='multiple']").each(function() {
        var select = $(this),
            values = {};
        $('option', select).each(function(i, option) {
            values[option.value] = option.selected;
        }).click(function(event) {
        	var truth = 0;
        	for (var value in values){
        		if (values[value]){
        			truth++;
        		}
        	}
            values[this.value] = !values[this.value];

            $('option', select).each(function(i, option) {
                option.selected = values[option.value];
                if (option.value == "Other") {
                    if (values.Other) {
                        $("[data-field_name='other:']")
	                        .removeClass('acf-conditional_logic-hide')
	                        .addClass('acf-conditional_logic-show')
	                        .find("input").prop('disabled', false);
                    } else if (values.Other === false) {
                        $("[data-field_name='other:']")
	                        .removeClass('acf-conditional_logic-show')
	                        .addClass('acf-conditional_logic-hide')
	                        .find("input").prop('disabled', false);
                    }
                }
            });
        });
    });
});