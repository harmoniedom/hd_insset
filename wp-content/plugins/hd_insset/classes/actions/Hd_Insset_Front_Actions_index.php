<?php
add_action('wp_ajax_hd_inssetcreerprospects', array('Hd_Insset_Front_Actions_Index', 'creer_prospects'));
add_action('wp_ajax_nopriv_hd_inssetcreerprospects', array('Hd_Insset_Front_Actions_Index', 'creer_prospects'));
add_action('wp_ajax_hd_inssetselect_pays', array('Hd_Insset_Front_Actions_Index', 'select_pays'));
add_action('wp_ajax_nopriv_hd_inssetselect_pays', array('Hd_Insset_Front_Actions_Index', 'select_pays'));

class Hd_Insset_Front_Actions_index
{
    public static function creer_prospects()
    {
        check_ajax_referer('ajax_nonce_security', 'security');

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
            exit;

        $Hd_Insset_Crud_Index = new Hd_Insset_Crud_Index();

        foreach ($_REQUEST as $key => $value)
            $$key = (string) trim($value);

        print $Hd_Insset_Crud_Index->Creation_Prospects($nom, $prenom, $sexe, $email, $date_naissance);

        exit;
    }

    public static function select_pays()
    {
        check_ajax_referer('ajax_nonce_security', 'security');

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
            exit;

        var_dump($_REQUEST);

        $Hd_Insset_Crud_Index = new Hd_Insset_Crud_Index();

        foreach ($_REQUEST as $key => $value)
        {
            if (!in_array($key, array('action', 'security')))
            {
                if($value != "Veuillez sélectionner un pays")
                {
                    $Hd_Insset_Crud_Index= new Hd_Insset_Crud_Index();
                    $Hd_Insset_Crud_Index->insert($value);
            
                }
            }
        }
            

        exit;
    }


}