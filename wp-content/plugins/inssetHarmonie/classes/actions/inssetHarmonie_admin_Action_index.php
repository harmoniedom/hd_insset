<?php

add_action('wp_ajax_removenewletter', array('inssetHarmonie_admin_Action_index', 'delete'));

add_action('wp_ajax_harmonieconfig', array('inssetHarmonie_admin_Action_index', 'update'));

class inssetHarmonie_admin_Action_index 
{

    public static function delete() 
    {
       check_ajax_referer('ajax_nonce_security', 'security');

        if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1)
        exit;

        $inssetHarmonie_crud_index = new inssetHarmonie_crud_index();
        $sql = $inssetHarmonie_crud_index->remove(($_REQUEST['idDelete']));
                
        print ($sql);
       
    
        exit;

    }

    public static function update(){

            check_ajax_referer('ajax_nonce_security', 'security');
            $inssetHarmonie_crud_index = new inssetHarmonie_crud_index();
    
            if ((!isset($_REQUEST)) || sizeof(@$_REQUEST) < 1){
                exit;
            }
    
            foreach($_REQUEST as $key => $valeur){
                if(!in_array($key, ['security','action'])){
                    $$key = (string) trim($valeur);
                    $inssetHarmonie_crud_index->update($key, $valeur);
                }
            }
    
    
            exit;
        }
    
    }
    
