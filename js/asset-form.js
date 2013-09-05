/**
 * This script controls behavior of the
 * form that creates and updates assets.
 */

// Deletes a row in the table 
// of custom attributes.

$(function(){
    delete_row = function(event) {
       // ignore all but left mouse button
       if (event.which == 1)
       {
            $(this).parent().parent().remove();
       }
    };

    // Adds a new custom attribute
    $('#asset-form-add-button').mouseup(function(){

       // ignore all but left mouse button
       if (event.which != 1)
       {
           return;
       }

       rows = $('#asset-form-attr-rows');
       num = $('#asset-form-attr-rows tr').length;

       name_key = 'AssetCustomAttribute['+num+'][key]';
       name_val = 'AssetCustomAttribute['+num+'][val]';

       rows.append('<tr>'+
            '<td>' +
                '<input type="text" name="'+name_key+'" />' +
            '</td>' + 
            '<td>' +
                '<input type="text" name="'+name_val+'" />' +
            '</td>' +
            '<td>' +
                '<a class="delete-attr button button-danger">x</a>'+
            '</td></tr>');

       $('.delete-attr').on('mouseup', delete_row);
    });

    $('.delete-attr').mouseup(delete_row);

});
