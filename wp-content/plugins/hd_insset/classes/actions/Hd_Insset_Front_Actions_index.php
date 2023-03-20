<?php
add_action('wp_ajax_hd_inssetcreerprospects', array('Hd_Insset_Front_Actions_Index', 'creer_prospects'));
add_action('wp_ajax_nopriv_hd_inssetcreerprospects', array('Hd_Insset_Front_Actions_Index', 'creer_prospects'));
add_action('wp_ajax_hd_inssetselect_pays', array('Hd_Insset_Front_Actions_Index', 'select_pays'));
add_action('wp_ajax_nopriv_hd_inssetselect_pays', array('Hd_Insset_Front_Actions_Index', 'select_pays'));
add_action('wp_ajax_hd_inssetJson', array('Hd_Insset_Front_Actions_Index', 'GetValue'));
add_action('wp_ajax_nopriv_hd_inssetJson', array('Hd_Insset_Front_Actions_Index', 'GetValue'));

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
    public static function getProspectFinal()
    {
        check_ajax_referer('ajax_nonce_security', 'security');

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
            exit;

            $Hd_Insset_Crud_Index  = new $Hd_Insset_Crud_Index ();

        $ProspectId = $Hd_Insset_Crud_Index ->getFinal($prospectId);

        $responseString = "";

        foreach ($ProspectId as $prospect) :
            $responseString .=  $prospect['nom'] . ';' . $prospect['prenom'] . ';' . $prospect['sexe'];
        endforeach;

        print $responseString;

        exit;
    }

    public static function GetValue(){
        global $wpdb;
        check_ajax_referer('ajax_nonce_security', 'security');
        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1){
            exit;
        };

        $Hd_Insset_Crud_Index = new Hd_Insset_Crud_Index();
        
        $result_voyages_effectuer =  $Hd_Insset_Crud_Index->result("*", $wpdb->prefix . 'hd_insset_pays', "`id_prospects`=\"".$_REQUEST['id']."\"");
    
        $result_utilisateur =  $Hd_Insset_Crud_Index->result("`prenom`,`nom`,`sexe`,`email`", $wpdb->prefix . 'hd_insset_prospects', "`id`=\"".$result_voyages_effectuer[0]['id_prospects']."\"");
        
        if ($result_utilisateur[0]['sexe'] == "Homme"){
            $civilite = "Mr";
          }
          else{
            $civilite = "Mme";
          }
          
        $result_all['utilisateur']['prenom'] = $result_utilisateur[0]['prenom'];
        $result_all['utilisateur']['nom'] = $result_utilisateur[0]['nom'];
        $result_all['utilisateur']['sexe'] = $civilite;
        $result_all['utilisateur']['email'] = $result_utilisateur[0]['email'];

        for($boucle = 0 ; $boucle < sizeof($result_voyages_effectuer); $boucle++){
            $result_voyages[$boucle] =  $Hd_Insset_Crud_Index->result("`pays`,`iso`,`note`", $wpdb->prefix . 'hd_insset_config', "`id`=\"".$result_voyages_effectuer[$boucle]['id_config']."\"");
        }

        $boucle = 0;
        foreach($result_voyages as $p){
            $result_all['pays'][$boucle]['note'] = $p[0]['note'];
            $result_all['pays'][$boucle]['pays'] = $p[0]['pays'];
            $result_all['pays'][$boucle]['iso'] = $p[0]['iso'];
            $boucle++;
        }

        print json_encode($result_all);
        exit;
    }

}