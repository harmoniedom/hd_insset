<?php

class Hd_Insset_Helper
{

    public function conversion_pays($id_conversion_pays) // récupération de l'id du pays de la page de données et afficher le nom du pays qui correspond
    {
        if(!$id_conversion_pays)
        {
            return;
        }

        global $wpdb;
        
        $table_name_config = $wpdb->prefix . 'hd_insset_config';

        $conversion_pays = "SELECT `$table_name_config`.`pays` FROM  `$table_name_config` WHERE `$table_name_config`.`id` = $id_conversion_pays";

        $result = $wpdb->get_results($conversion_pays, "ARRAY_A");

        return $result[0]['pays'];



    }


}
