<?php

class Hd_Insset_Admin 
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'menu'), -1);
        return;
    }

    public function menu() {

        add_menu_page(
            'Hd_Insset',
            'Hd_Insset',
            'administrator',
            'Hd_Insset_Param',
            array($this, 'Hd_Insset_Param'),
            1000
        );

        add_submenu_page(
            'Hd_Insset_Param',
            __('Hd_Insset / Config'),
            __('Config'),
            'administrator',
            'Hd_Insset_Config',
            array($this, 'Hd_Insset_Config')
        );

        add_submenu_page(
            'Hd_Insset_Param',
            __('Hd_Insset / Liste Pays'),
            __('List Pays'),
            'administrator',
            'Hd_Insset_Liste_Pays',
            array($this, 'Hd_Insset_Liste_Pays')
        );

        add_submenu_page(
            'Hd_Insset_Param',
            __('Hd_Insset / Liste Prospects'),
            __('Liste Prospects'),
            'administrator',
            'Hd_Insset_Liste_Prospects',
            array($this, 'Hd_Insset_Liste_Prospects')
        );
       

    add_action('admin_enqueue_scripts', array($this, 'assets'), 999);   
    }

    
    public function Hd_Insset_Param() 
    {
        return;
    }

    public function Hd_Insset_Liste_Pays() 
    {

        $Hd_Insset_Views_Liste_Pays = new Hd_Insset_Views_Liste_Pays();
        return $Hd_Insset_Views_Liste_Pays->display(); //création de la page Liste Pays sur wordpress

    }

    public function Hd_Insset_Config()
    {
        $Hd_Insset_Views_Config = new Hd_Insset_Views_Config();
        return $Hd_Insset_Views_Config->display();//création de la page Config sur wordpress
    }

    public function Hd_Insset_Liste_Prospects()
    {
        $Hd_Insset_Views_Liste_Prospects = new Hd_Insset_Views_Liste_Prospects();
        return $Hd_Insset_Views_Liste_Prospects->display();//création de la page Liste Prospect sur wordpress
    }

    public function assets(){

        wp_enqueue_style ('admin-front', plugins_url(Hd_Insset_PLUGIN_NAME .'/assets/css/Hd_Insset_Admin.css'));
    
        //Ajouter les scripts necessaires
        wp_register_script('hd_inssetA', plugins_url(Hd_Insset_PLUGIN_NAME .'/assets/js/Hd_Insset_Admin.js', Hd_Insset_VERSION, true));
        wp_enqueue_script('hd_inssetA');
            
        //Point sécurité
        wp_localize_script('hd_inssetA', 'hd_insset_script', array(
        'security' => wp_create_nonce('ajax_nonce_security')
            
        ));
            return;
    
    }


     
}