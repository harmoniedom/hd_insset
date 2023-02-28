<?php
add_action('wp_ajax_hd_insset_accessible', array('Hd_Insset_Admin_Actions_Index', 'majeur'));
add_action('wp_ajax_hd_insset_note', array('Hd_Insset_Admin_Actions_Index', 'notation'));
add_action('wp_ajax_hd_insset_actif', array('Hd_Insset_Admin_Actions_Index', 'actif'));

class Hd_Insset_Admin_Actions_Index
{
    public static function majeur()
    {
        check_ajax_referer('ajax_nonce_security', 'security');

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
            exit;

        foreach ($_REQUEST as $key => $value)
            $$key = (string) trim($value);

        $Hd_Insset_Crud_Index = new Hd_Insset_Crud_Index();
        $response = $Hd_Insset_Crud_Index->Update_Accessible($id, $majeur);

        print $response;

        exit;
    }

    public static function notation()
    {
        check_ajax_referer('ajax_nonce_security', 'security');

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
            exit;

        foreach ($_REQUEST as $key => $value)
            $$key = (string) trim($value);

        $Hd_Insset_Crud_Index= new Hd_Insset_Crud_Index();
        $response = $Hd_Insset_Crud_Index->Update_Note($id, $note);

        print $response;

        exit;
    }

    public static function actif()
    {
        check_ajax_referer('ajax_nonce_security', 'security');

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
            exit;

        foreach ($_REQUEST as $key => $value)
            $$key = $value;

        $Hd_Insset_Crud_Index= new Hd_Insset_Crud_Index();
        $response = $Hd_Insset_Crud_Index->Update_Actif($changer);

        print $response;

        exit;
    }
}