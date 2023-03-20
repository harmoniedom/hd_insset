<?php

add_shortcode('FORMULAIRE_SELECTION', array('Hd_Insset_Shortcode_Form_selection', 'display'));

//classe pour faire un formulaire pour sélectionner les pays que l'utilisateur veut
class Hd_Insset_Shortcode_Form_selection
{

    static function display($atts)
    {

        $Hd_Insset_Crud_Index = new Hd_Insset_Crud_Index();

        //récupèrer la valeur du résultat grace au crud pour le mettre dans la variable pays selectionnés
        $ListePays = $Hd_Insset_Crud_Index->getAge();
        $paysListe = "";
        

        foreach ($ListePays as $Liste) :
            $paysListe .= '<option value="' . $Liste['id'] . '">' . $Liste['pays'] . '</option>';
        endforeach;

        //fomulaire en html pour sélectionner les pays
        return "<form id='hd_insset_pays_selectionnes'>
            
        <h3>Liste des pays</h3>
        
        // formulaire pour selectionner pays 1
        <div>
            <label >Selectionné votre pays</label>
            <select name='pays1' id='hd_insset_pays1' required='required'  style='display: block;'>
            <option > Veuillez sélectionner un pays </option>" . $paysListe . "
            </select>
        </div>

        // formulaire pour selectionner pays 2
        <div class='disable-select-pays' id='pays2_container'>
            <label >Selectionné votre pays</label>
            <select name='pays2' id='hd_insset_pays2'  style='display: block;'>
            <option> Veuillez sélectionner un pays </option> " . $paysListe . "
            </select>
        </div>

        // formulaire pour selectionner pays 3
        <div class='disable-select-pays' id='pays3_container'>
            <label>Selectionné votre pays</label>
            <select name='pays3' id='hd_insset_pays3'  style='display: block;'>
            <option >Veuillez sélectionner un pays</option> " . $paysListe . "
            </select>
        </div>

        // formulaire pour selectionner pays 4
        <div class='disable-select-pays' id='pays4_container'>
            <label> Selectionné votre pays</label>
            <select name='pays4' id='hd_insset_pays4'  style='display: block;'>
            <option> Veuillez sélectionner un pays  </option> " . $paysListe . "
           </select>
        </div>

        
            <button class='disable-select-pays' id='hd_insset_pays_selectionnes-submit'>Je valide mes choix</button>
        </form>";
        

    }
}