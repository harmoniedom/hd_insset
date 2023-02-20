jQuery(document).ready(function () {

//wp_ajax_hd_insset_actif' -> actif
jQuery("#Hd-submitPaysConfig").click(function (e) 
{
    e.stopPropagation();
    e.preventDefault();

   
    const datas = 
    {
      action: "hd_insset_actif",
      security: hd_insset_script.security,
      changer: jQuery("#hd_pays_multiselect").val(),
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

//wp_ajax_hd_insset_note ->notation
jQuery(".select-note").change(function (e) {
  const datas = {
    action: "hd_insset_note",
    security: hd_insset_script.security,
    iso: jQuery(this).data("id"),
    note: jQuery(this).val(),
  };

  jQuery.post(ajaxurl, datas, function (rs) {
    jQuery(".is-dismissible").show("slow");

    setTimeout(() => {
      jQuery(".is-dismissible").hide("slow");
    }, "1000");
    return false;
  });
});

//wp_ajax_hd_insset_accessible
jQuery(document).ready(function () {
  jQuery(".acessible_checkBox").change(function (e) {
    let datas;

    if (this.checked)
      datas = {
        action: "hd_insset_accessible",
        security: hd_insset_script.security,
        iso: jQuery(this).data("id"),
        majeur: 1,
      };
    else
      datas = {
        action: "hd_insset_accessible",
        security: hd_insset_script.security,
        iso: jQuery(this).data("id"),
        majeur: 0,
      };

    jQuery.post(ajaxurl, datas, function (rs) {
      jQuery(".is-dismissible").show("slow");

      setTimeout(() => {
        jQuery(".is-dismissible").hide("slow");
      }, "1000");
      return false;
    });

  });

})

})