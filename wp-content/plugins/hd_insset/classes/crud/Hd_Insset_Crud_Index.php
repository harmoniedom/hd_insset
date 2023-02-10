<?php

class Hd_Insset_Crud_Index
{

    // Insert a country in the database
    public function ajouter_pays( string $iso, string $pays, int $note = 0, int $accessible = 0, int $actif = 0) {

        global $wpdb;
        $table_name_Pays = $wpdb->prefix . "hd_insset_pays";

        $succes = $wpdb->insert(
            $table_name_Pays,
            array(
                'iso'=> $iso,
                'pays'=> $pays,
                'note'=> $note,
                'accessible'=> $accessible,
                'actif'=>$actif,
            )
        );

        return $succes;
    

    }

    public function get_list_pays()
    {
        global $wpdb;

        $table_name_Pays = $wpdb->prefix . "hd_insset_pays";

        $sql="select * from $table_name_Pays";
        $result = $wpdb->get_results($sql, "ARRAY_A");
        return $result;
    }

}