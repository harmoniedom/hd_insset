jQuery("#Hd-submitPaysConfig").click(function (e) 
{
    e.stopPropagation();
    e.preventDefault();

    const datas = 
    {
      action: "Hd_Insset_disponible",
      security: hdadminscript.security,
      idsListToChange: jQuery("#pays_multiselect").val(),
    };

    jQuery.post(ajaxurl, datas, function (rs) 
    {
      jQuery(".is-dismissible").show("slow");

      setTimeout(() => {
        jQuery(".is-dismissible").hide("slow");
      }, "2000");
      return false;
    });

})
