<?php

class inssetHarmonie_crud_index{

    public function ajoutId()
    {
        global $wpdb;
        $wpdb->insert($wpdb->prefix . 'insset_newsletter', ['id'=>0]);
        $lastid =$wpdb->insert_id;
        
        return $lastid;
       
    }

    public function ajoutData ($refId, $key_of_value, $key_value)
    {
        global $wpdb;
        $table_name_user = $wpdb->prefix . 'insset_user';

        $wpdb->insert(
            $table_name_user,
            array(
                'id' => 0,
                'cle' => $key_of_value,
                'valeur' => $key_value,
                'index' => $refId,
            )
        
        );

        return true;
    }

    public function remove($var){
        
        if(!$var)
            return;
        
        global $wpdb;



        if($wpdb->delete($wpdb->prefix . 'insset_newsletter',['id'=>$var]));
            if($wpdb->delete($wpdb->prefix . 'insset_newsletter',['id'=>$var]));
                return 'Suppression effectuée';
        
        return 'Erreur!';
    }
   

    static public function getConfigs(){

        {
            global $wpdb;
            $table_name_config = $wpdb->prefix . 'insset_config';
    
            $sql = "SELECT * FROM $table_name_config";
    
            return $wpdb->get_results($sql, 'ARRAY_A');
        }
    }

    public function update($id, $valeur){
        
        
        global $wpdb;

        if($wpdb->update($wpdb->prefix . 'insset_config', array('valeur' => $valeur), ['id' => $id])){
            
                return 'Ajout effectuée';
        }
        
        return 'Erreur!';
    }
}