jQuery(document).ready(function () {

  //Ajax du formulaire d'inscription
    jQuery('#hd-form-inscription').on('submit',function (e) {
      e.stopPropagation();
      e.preventDefault();
  
      let formData = new FormData();
      formData.append("action", "hd_inssetcreerprospects");
      formData.append("security", hd_insset_script.security);
  
      jQuery('#hd-form-inscription').find('input, select').each(function (i) {

          let id = jQuery(this).attr('id');
          if (typeof id !== "undefined") formData.append(id, jQuery(this).val());
        });
  
      jQuery('#hd-loading-container').show();
  
      jQuery.ajax({
        url: hd_insset_script.ajax_url,
        xhrFields: {
          withCredentials: true,
        },
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        type: "post",
        success: function (rs, textStatus, jqXHR) {
          jQuery('#hd-loading-container').hide();
          return false;
        },
      });
    });
 



  // boucle for pour passer de du pays selectionné 1 au pays sélectioné 4
  for (let i = 1; i < 4; i++) {
    jQuery('#hd_insset_pays_selectionnes' + i).change(() => {
      jQuery('#hd_insset_pays' + (i + 1) + "_container").removeClass(
        "disable-select-pays"
      );
      //enable button lorsque le premier pays est selectionné
      if (i == 1)
        jQuery('#hd_insset_pays_selectionnes').removeClass(
          "disable-select-pays"
        );
    });
  }

  //Ajax du formulaire des pays sélectionnés
  jQuery('#hd_insset_pays_selectionnes').submit(function (e) {
    e.stopPropagation();
    e.preventDefault();

    let formData = new FormData();
    formData.append("action", "");
    formData.append("security", hd_insset_script.security);

    jQuery('#hd_insset_pays_selectionnes').find('input, select').each(function (i) {
        let id = jQuery(this).attr("id");
        if (typeof id !== "undefined") formData.append(id, jQuery(this).val());
      });

    jQuery('#hd-loading-container').show();

    jQuery.ajax({
      url: hd_insset_script.ajax_url,
      xhrFields: {
        withCredentials: true,
      },
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      type: "post",
      success: function (rs, textStatus, jqXHR) {
        jQuery('#hd-loading-container').hide();
          return false;
       
        },
      });
    });

  });