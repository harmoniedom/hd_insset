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
            'Hd_Insset_Param',
            array($this, 'Hd_Insset_Param'),
            1000
        );

        add_submenu_page(
            'Hd_Insset_param',
            __('VOYAGE/ Config'),
            __('Configuration'),
            'administrator',
            'Hd_Insset_Config',
            array($this, 'Hd_Insset_Config')
        );

        add_submenu_page(
            'Hd_Insset_Param',
            __('VOYAGE / Liste Pays'),
            __('Liste Pays'),
            'administrator',
            'Hd_Insset_Views_Liste_Pays',
            array($this, 'Hd_Insset_Views_Liste_Pays')
        );

        add_submenu_page(
            'Hd_Insset_Param',
            __('VOYAGE / Liste Prospects'),
            __('Liste Prospects'),
            'administrator',
            'Hd_Insset_Views_Liste_Prospects',
            array($this, 'Hd_Insset_Views_Liste_Prospects')
        );

       
    }
    
    
    
    public function Hd_Insset_Param() 
    {
        return;
    }

    public function Hd_Insset_Views_Liste_Pays() 
    {

        $Hd_Insset_Views_Liste_Pays = new Hd_Insset_Views_Liste_Pays();
        return $Hd_Insset_Views_Liste_Pays->display();

    }

    public function Hd_Insset_Config()
    {
        $Hd_Insset_Views_Config = new Hd_Insset_Views_Config();
        return $Hd_Insset_Views_Config->display();
    }

    public function Hd_Insset_Views_Liste_Prospects()
    {
        // $Hd_Insset_Views_Liste_Prospects = new Hd_Insset_Views_Liste_Prospects();
        // return $Hd_Insset_Views_Liste_Prospects->display();
    }

}