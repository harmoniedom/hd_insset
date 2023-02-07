<?php

add_action('wp_ajax_inssetnewletter', array('inssetHarmonie_Front_Action_index', 'newjob'));
add_action('wp_ajax_nopriv_inssetnewletter', array('inssetHarmonie_Front_Action_index', 'newjob'));

class inssetHarmonie_Front_Action_index 
{

    public static function newjob() 
    {
        check_ajax_referer('ajax_nonce_security', 'security');

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
        exit;


        foreach ($_REQUEST as $key => $value)
            $$key = (string) trim($value);

        $inssetHarmonie_crud_index = new inssetHarmonie_crud_index();
        $lastid = $inssetHarmonie_crud_index->ajoutId();

    
        foreach ($_REQUEST as $key => $value)
            if (!in_array($key, ['action','security']))
                 $inssetHarmonie_crud_index->ajoutData($lastid, $key, $value);
            
                
        print "ok";
       
     

        exit;

    }
}