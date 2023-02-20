<?php

add_shortcode('FORMULAIRE_INSCRIPTION', array('Hd_Insset_Shortcode_Form', 'display'));

class Hd_Insset_Shortcode_Form
{

    static function display($atts)
    {
        return " <form id='hd-form-inscription'>
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

                    <select name='sexe' id='sexe' required='required'>
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
            <button id='ft-submit-button-inscription'>Suivant</button>
        </form>";
    }
}