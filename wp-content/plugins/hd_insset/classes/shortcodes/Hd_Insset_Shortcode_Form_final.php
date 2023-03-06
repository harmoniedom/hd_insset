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
            nom = " .$ListePays[1][0]["nom"]. ",<br>
            prenom = " .$ListePays[1][0]["prenom"].",<br>
            sexe= " .$ListePays[1][0]["sexe"].",<br>
            email= " .$ListePays[1][0]["email"].",<br>
            date_naissance = " .$ListePays[1][0]["date_naissance"].",<br>
            

            <ul class='hd_pays_list_container'>
            " . $paysHTML. "
            </ul>
            <button id='hd-form-final'>Oui, je suis d'accord</button>
            <div id='handlebarsModalBox'></div>
            ";
    }
}