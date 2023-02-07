jQuery( document ).ready(function() 
{


jQuery('.deleteButton').on('click', function(e)
{
   var _this = jQuery(this);

   e.stopPropagation();
   e.preventDefault();

    let data = {
        'action':'removenewletter',
        'security':inssetscript.security,
        'isdelete' : jQuery(this).data('id'),
    }

           
        jQuery.post(ajaxurl,data,function (rs){
            _this.closest('tr').fadeOut('slow');
            jQuery('delete-confirmation').removeClass('hide');
           return 'suppression';
        })
    
});


jQuery('#insset_param_update button').on('click', function(e)

{

    e.stopPropagation();
    e.preventDefault();

    let formData = new FormData();
    formData.append('action', 'harmonieconfig');
    formData.append('security',  inssetscript.security);

    jQuery('#insset_param_update input').each (function(){

        let id = jQuery(this).attr('id');
        let value = jQuery(this).val();
        formData.append(id, value);

    });

   // jQuery("#insset_param_update").show();
    jQuery.ajax(
    {
        url: ajaxurl,
        xhrFields: 
        {
            withCredentials: true
        },
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        type: 'post',

        success: 
            function(rs) 
            {
                jQuery('.update-message').removeClass('hide');
                return false;
            }
        })
     
     });

   

});
