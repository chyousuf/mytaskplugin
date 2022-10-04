var x=0;
jQuery( document ).ready(function() {

    //power_stripe
    var max_fields = 4;
    var new_sheet_field_append = jQuery("#new_sheet_field");
    var add_more_sheet_fields = jQuery("#add_more_sheet_fields");
  
    jQuery(add_more_sheet_fields).click(function (e) {

     if (x < max_fields) {
         x++;
                 jQuery(new_sheet_field_append).append('<div id="my_task_sheet_field-'+x+'"><br><input  size="100" name="my_task_sheet_field_plugin_options[sheet_field][]" required="required" type="text" value=""></input><a   onclick="onclickdeletesheet('+x+')" class="delete-btn-class" ><input type="hidden" id="values" value="'+x+'"/><span class="dashicons dashicons-trash"></span></a><br></div>'); //add input Sheet
             } else {
                 alert('You Reached the limits')
             }
         });

         

});

function onclickdeletesheet(id){

    id = '#my_task_sheet_field-'+id;
    jQuery(id).remove();
    x--;
};

