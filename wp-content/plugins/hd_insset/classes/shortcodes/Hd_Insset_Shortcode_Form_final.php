<?php

add_shortcode('FORMULAIRE_FINAL', array('Hd_Insset_Shortcode_Form_final', 'display'));

class Hd_Insset_Shortcode_Form_final
{

    static function display()
    {
        
        $Hd_Insset_Crud_Index = new Hd_Insset_Crud_Index();
        
        //récupèrer la valeur du résultat grace au crud pour le mettre dans la variable Liste Pays
        $ListePays = $Hd_Insset_Crud_Index->getFinal(1);
        // var_dump($ListePays[0]);

        $paysHTML = "";
        
        foreach ($ListePays[0] as $Liste=>$key) :

            $helper = new Hd_Insset_Helper();
            $paysHTML .= "<li> " . $helper->conversion_pays($key['id_config']) . "</li>";
            // $Paysinfo .= $key['id_config'] ;
            // var_dump($helper->conversion_pays($key['id_config']));
        endforeach;

        return "

        <script src=\"https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js\"></script>
        <script id=\"Script_Modal\" type=\"text/x-handlebars-template\" src=\"".plugins_url(Hd_Insset_PLUGIN_NAME."/assets/Handlebars/Handlebars.hbs")."\"></script>

            nom = " .$ListePays[1][0]["nom"]. ",<br>
            prenom = " .$ListePays[1][0]["prenom"].",<br>
            sexe= " .$ListePays[1][0]["sexe"].",<br>
            email= " .$ListePays[1][0]["email"].",<br>
            date_naissance = " .$ListePays[1][0]["date_naissance"].",<br>
            

            <ul class='hd_pays_list_container'>
            " . $paysHTML. "
            </ul>
            <input type=\"button\" id=\"hd-form-final\" value=\"Oui,je suis d'accord\"></input>
            <div id='handlebarsModalBox'></div>

            ";
    }
}