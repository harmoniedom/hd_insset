<?php

class Hd_Insset_Crud_Index
{

    // Insert a country in the database
    public function ajouter_pays( string $iso, string $pays, int $note = 0, int $accessible = 0 ) {

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

}