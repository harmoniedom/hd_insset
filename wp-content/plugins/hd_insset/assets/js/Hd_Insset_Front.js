jQuery(document).ready(function () 
{
        
  //Ajax du formulaire d'inscription
    jQuery('#hd-form-inscription').on('submit',function (e) 
    {
      e.stopPropagation();
      e.preventDefault();
  
      let formData = new FormData();
      formData.append("action", "hd_inssetcreerprospects");
      formData.append("security", hd_insset_script.security);
  
       jQuery('#hd-form-inscription').find('input, select').each(function (i) 
       {

          let id = jQuery(this).attr('id');
          if (typeof id !== "undefined") formData.append(id, jQuery(this).val());
       });
  
      jQuery('#hd-loading-container').show();
  
      jQuery.ajax({
        url: hd_insset_script.ajax_url,
        xhrFields: 
        {
          withCredentials: true,
        },
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        type: "post",
        success: function (rs, textStatus, jqXHR) 
        {

           //aller à la page suivante 
        window.sessionStorage.setItem("Authorisation", "step1,step2");
        window.location.replace("http://localhost/wordpress/2023/02/28/choix-de-voyage/");
          return false;
        },
    });
  })

  // boucle for pour passer de du pays selectionné 1 au pays sélectioné 4
  for (let i = 1; i < 4; i++) {
    jQuery('#hd_insset_pays' + i).change(() => {
      jQuery('#hd_insset_pays' + (i + 1) + "_container").removeClass(
        "disable-select-pays"
      );
      //bouton pays 1/2/3/4
      if (i == 1)
        jQuery('#hd_insset_pays_selectionnes-submit').removeClass(
          "disable-select-pays"
        );
    });
  }

  //Ajax du formulaire des pays sélectionnés
  jQuery('#hd_insset_pays_selectionnes').submit(function (e) {
    e.stopPropagation();
    e.preventDefault();

    let formData = new FormData();
    formData.append("action", "hd_inssetselect_pays");
    formData.append("security", hd_insset_script.security);

    jQuery('#hd_insset_pays_selectionnes').find('input, select').each(function (i) {
        let id = jQuery(this).attr("id");
        if (typeof id !== "undefined") formData.append(id, jQuery(this).val());
      });
    

    jQuery('#hd-loading-container').show();

 

    jQuery.ajax(
      {
        url: hd_insset_script.ajax_url,
        xhrFields: 
      {
        withCredentials: true,
      },
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      type: "post",
      success: function (rs, textStatus, jqXHR) {
        
          window.sessionStorage.setItem("Authorisation", "step1,step2,step3");
          window.location.replace("http://localhost/wordpress/2023/03/01/final/");
           
           return false;
    },
  });
  });

// //Ajax du formulaire final
const url = window.location.pathname;

 if (url.startsWith("/wordpress/2023/03/01/final/"))
 {
  var userid = 1;
  console.log(userid);

  let formData = new FormData();
    formData.append("action", "hd_inssetJson");
    formData.append("security", hd_insset_script.security);
    formData.append("id",userid)

    jQuery.ajax(
      {
        url: hd_insset_script.ajax_url,
        xhrFields: 
      {
        withCredentials: true,
      },
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      type: "post",
      success: function (rs) 
      {
        formData.append("json",rs);

        let hbs = jQuery('#Script_Modal').attr('src');

        jQuery.ajax(
          {
            dataType: "html",
            url: hbs,

            success: function(source)
            {
              var modal = Handlebars.compile(source);
              jQuery("#handlebarsModalBox").html(modal(JSON.parse(rs)));
           

              jQuery('#hd-form-final').on('click', function(e){
                document.getElementById('handlebarsModalBox').style.display = "block";
            });

            jQuery('#handlebars_submit').on('click', function(e){
              window.sessionStorage.setItem('json', rs);
              window.location.replace("http://localhost/wordpress/2023/02/16/hd_insset/");
          });
            } 
      })     
    },
  });
 }
});
