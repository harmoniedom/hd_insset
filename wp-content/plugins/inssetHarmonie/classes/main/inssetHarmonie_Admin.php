<?php

class inssetHarmonie_Admin {

    public function __construct() {

        add_action('admin_menu', array($this, 'menu'), -1);
        return;

    }

    public function menu() {

        add_menu_page(
            __('INSSET'),
            __('INSSET'),
            'administrator',
            'inssetHarmonie_Admin',
            array($this, 'inssetHarmonie_Admin'),
            'images/marker.png',
            1000
        );

        add_submenu_page(
            'inssetHarmonie_Admin',
            __('INSSET / Config'),
            __('Configuration'),
            'administrator',
            'inssetHarmonie_Admin',
            array($this, 'inssetHarmonie_Admin')
        );

        add_submenu_page(
            'inssetHarmonie_Admin',
            __('INSSET / liste'),
            __('liste'),
            'administrator',
            'inssetHarmonie_liste',
            array($this, 'inssetHarmonie_liste')
        );
        add_action('admin_enqueue_scripts', array($this, 'assets'), 999);

    }

    public function assets(){

        wp_enqueue_style ('admin-front', plugins_url(inssetHarmonie_PLUGIN_NAME .'/assets/css/admin.css'));
    
        //Ajouter les scripts necessaires
            wp_register_script('inssetB', plugins_url(inssetHarmonie_PLUGIN_NAME .'/assets/js/inssetHarmonie_admin.js', inssetHarmonie_VERSION, true));
            wp_enqueue_script('inssetB');
            
        //Point sécurité
            wp_localize_script('inssetB', 'inssetscript', array(
                'security' => wp_create_nonce('ajax_nonce_security')
            
        ));
            return;
    
    }
    
    
    public function inssetHarmonie_Admin() {

        $inssetHarmonie_Views_config = new inssetHarmonie_Views_config();
        return $inssetHarmonie_Views_config->display();
      // return;

    }

    public function inssetHarmonie_liste() {

        $inssetHarmonie_Views_liste = new inssetHarmonie_Views_liste();
        return $inssetHarmonie_Views_liste->display();
    

    }

}