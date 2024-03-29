<?php

add_shortcode('FORMULAIRE_INSCRIPTION', array('Hd_Insset_Shortcode_Form_inscription', 'display'));

//classe pour faire un formulaire d'inscription
class Hd_Insset_Shortcode_Form_inscription
{

    static function display($atts)
    {

        $Hd_Insset_Crud_Index = new Hd_Insset_Crud_Index();
        
        //récupèrer la valeur du résultat grace au crud pour le mettre dans la variable Liste Pays
        $id_prospects = '1';
        $ListePays = $Hd_Insset_Crud_Index->getConfig();//création de la table config


         // utilisateur a choisit ou pas des pays avant
         if (sizeof($ListePays) != 0) 
         {
            $paysDonnee = "[['pays'],";

            foreach ($ListePays as $Liste) :
                $paysDonnee .= "['" . $Liste['pays'] . "'],";
            endforeach;

            $paysDonnee = substr($paysDonnee, 0, -1);
            $paysDonnee .= "]"; 
            
            $mapHTML = "
            <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
            <script type='text/javascript'>
                google.charts.load('current', {
                'packages':['geochart'],
                });
                google.charts.setOnLoadCallback(drawRegionsMap);
        
                function drawRegionsMap() {
                var data = google.visualization.arrayToDataTable(" . $paysDonnee . ");
        
                var options = {};
        
                var chart = new google.visualization.GeoChart(document.getElementById('hd-pays-map'));
        
                chart.draw(data, options);
                }
            </script>
                
            <h1>Vos pays choisit : </h1>
            <div class='map-container'>
                <div id='hd-pays-map' style='width: 900px; height: 500px;'></div>
                //<button id='reinitialisation-boutton'>Réinitialiser mes choix </button>
            </div>
        ";
    }

        //fomulaire en html pour s'inscrire
        return  $mapHTML . " <form id='hd-form-inscription'>
            <fieldset>
                <legend>Vos informations</legend>
                
                <div>
                    <label for='nom'>Entrer votre nom:</label>
                    <input type='text' id='nom' name='nom' required='required'>
                </div>

                <div>
                    <label for='prenom'>Entrer votre prenom:</label>
                    <input type='text' id='prenom' name='prenom' required='required'>
                </div>

                <div>
                    <label for='sexe'>Entrer votre sexe:</label>

                    <select name='sexe' id='sexe' required='required' style='display: block;'>
                        <option value='Homme'>Homme</option>
                        <option value='Femme'>Femme</option>
                    </select>

                </div>

                <div>
                    <label for='email'>Entrer votre email:</label>
                    <input type='email' id='email' name='email' required='required'>
                </div>

                <div>
                    <label for='date_naissance'>Entrer votre date de naissance:</label>
                    <input type='date' id='date_naissance' name='date_naissance' required='required'>
                </div>

            </fieldset>
            <button id='hd-submit-button-inscription'>Suivant</button>
        </form>";
    }
}