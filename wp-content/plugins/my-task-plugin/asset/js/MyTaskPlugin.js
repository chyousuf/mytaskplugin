jQuery(document).ready(function () {

    var number_of_fields = jQuery("#number_of_fields").val();
    if (number_of_fields != '' && number_of_fields != null) {
        var x = number_of_fields;
    }
    var max_fields = 5;
    var new_sheet_field_append = jQuery("#new_sheet_field");
    var add_more_sheet_fields = jQuery("#add_more_sheet_fields");

    jQuery(add_more_sheet_fields).click(function (e) {

        if (x < max_fields) {
            x++;
            jQuery(new_sheet_field_append).before('<div id="my_task_sheet_field-' + x + '"><br><input  size="100" name="my_task_sheet_field_plugin_options[sheet_field][]" required="required" type="text" value=""></input><a  class="delete-btn-class" ><input type="hidden" id="values" value="' + x + '"/><span class="dashicons dashicons-trash"></span></a><br></div>'); //add input Sheet
        } else {
            alert('You Reached the limits')
        }
    });

    jQuery(document).on('click', '.delete-btn-class', function () {
        var del_id = '#' + jQuery(this).parent().attr('id');
        jQuery(del_id).remove();
        x--;

    });

});



