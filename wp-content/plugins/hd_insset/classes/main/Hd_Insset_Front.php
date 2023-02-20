<?php

class Hd_Insset_Front {
  
        public function __construct()
        {
            add_action('wp_enqueue_scripts', array($this, 'addjs'), 0);
    
            return;
        }
    
        public function addjs()
        {
            wp_register_script('hd_inssetF', plugins_url(Hd_Insset_PLUGIN_NAME . '/assets/js/Hd_Insset_Front.js'), array('jquery-new'), Hd_Insset_VERSION, true);
            wp_enqueue_script('hd_inssetF');
            wp_localize_script(
                'hd_inssetF',
                'hd_insset_script',
                array(
                    'ajax_url' => admin_url('admin-ajax.php'),
                    'security' => wp_create_nonce('ajax_nonce_security')
                )
            );
    
            return;
        }
    }