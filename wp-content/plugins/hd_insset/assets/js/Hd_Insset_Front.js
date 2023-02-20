jQuery(document).ready(function () {

    jQuery("#hd-form-inscription").submit(function (e) {
      e.stopPropagation();
      e.preventDefault();
  
      let formData = new FormData();
      formData.append("action", "hd_inssetcreerprospects");
      formData.append("security", hd_insset_script.security);
  
      jQuery("#hd-form-inscription")
        .find("input, select")
        .each(function (i) {
          let id = jQuery(this).attr("id");
          if (typeof id !== "undefined") formData.append(id, jQuery(this).val());
        });
  
      jQuery("#hd-loading-container").show();
  
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
          jQuery("#hd-loading-container").hide();
          return false;
        },
      });
    });
  });