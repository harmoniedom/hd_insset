<?php

add_shortcode('FORMULAIRE', array('insset_Shortcode_Form', 'display'));


class insset_Shortcode_Form {

    public function __construct() {

      
        add_action('wp_enqueue_scripts', array($this, 'addjs'), 0);

        return;
    }

  

    static function display($atts) {

        $InssetHarmonie_Helper_Index = new InssetHarmonie_Helper_Index();

        if (!$InssetHarmonie_Helper_Index->isOpen())
            return "<p>Formulaire fermé</p>";

        $atts= '<form id="harmonie">
                    <fieldset>
                        <legend><?php _e("Your coords") ?></legend>
                        <div>
                            <label for="firstname">Firstname</label>
                            <input type="text" id="firstname" name="firstname">
                            <label for="lastname">Lastname</label>
                            <input type="text" id="lastname" name="lastname">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email">
                            <label for="CodePostal">CodePostal</label>
                            <input type="text" id="CodePostal" name="CodePostal">
                        </div>
                    </fieldset>
                    <button id="btn">Submit</button>
                 </form>';

        return $atts;

        
    }

}