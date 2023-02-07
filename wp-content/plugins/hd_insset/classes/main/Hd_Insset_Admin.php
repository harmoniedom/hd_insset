<?php

class Hd_Insset_Admin {

    public function __construct() {

        add_action('admin_menu', array($this, 'menu'), -1);
        return;

    }

    public function menu() {

        add_menu_page(
            __('VOYAGE'),
            __('VOYAGE'),
            'administrator',
            'Hd_Insset_Admin',
            array($this, 'Hd_Insset_Admin'),
            'images/marker.png',
            1000
        );

        add_submenu_page(
            'Hd_Insset_Admin',
            __('VOYAGE/ Config'),
            __('Configuration'),
            'administrator',
            'iHd_Insset_Admin',
            array($this, 'Hd_Insset_Admin')
        );

        add_submenu_page(
            'Hd_Insset_Admin',
            __('VOYAGE / Liste'),
            __('Liste'),
            'administrator',
            'Hd_Insset_Views_Liste_Pays',
            array($this, 'Hd_Insset_Views_Liste_Pays')
        );
    }
    
    
    public function Hd_Insset_Admin() {

        $Hd_Insset_Views_Config = new Hd_Insset_Views_Config();
        return $Hd_Insset_Views_Config->display();
      

    }

    public function Hd_Insset_Views_Liste_Pays() {

        $Hd_Insset_Views_Liste_Pays = new Hd_Insset_Views_Liste_Pays();
        return $Hd_Insset_Views_Liste_Pays->display();
    

    }

}