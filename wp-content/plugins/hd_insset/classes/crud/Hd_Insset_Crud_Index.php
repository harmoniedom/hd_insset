<?php

class Hd_Insset_Crud_Index
{

    // // Insert a country in the database
    // public function ajouter_pays( string $iso, string $pays, int $note = 0, int $accessible = 0, int $actif = 0) {

    //     global $wpdb;
    //     $table_name_config = $wpdb->prefix . "hd_insset_config";

    //     $succes = $wpdb->insert(
    //         $table_name_config,
    //         array(
    //             'iso'=> $iso,
    //             'pays'=> $pays,
    //             'note'=> $note,
    //             'accessible'=> $accessible,
    //             'actif'=>$actif,
    //         )
    //     );

    //     return $succes;

    // }
    static function getConfig()
    {
        global $wpdb;
        $table_name_config = $wpdb->prefix . 'hd_insset_config';

        $sql = "SELECT * FROM $table_name_config";

        return $wpdb->get_results($sql, 'ARRAY_A');
    }

    public function Creation_Prospects($nom, $prenom, $sexe, $email, $date_naissance)
    {
        global $wpdb;

        $table_name_prospects = $wpdb->prefix . 'hd_insset_prospects';

        if ($wpdb->insert( $table_name_prospects,
            array(
                'nom' => $nom,
                'prenom' => $prenom,
                'sexe' => $sexe,
                'email' => $email,
                'date_naissance' => $date_naissance,
            )
        ))
            return "Inserer ok";
        else
            return "Erreur";
    }


    static function Upadate_Actif($changer)
    {
        global $wpdb;
        $table_name_config = $wpdb->prefix . 'hd_insset_config';

        $Pays_no_actifSql = "SELECT * FROM $table_name_config WHERE `actif`=0";
        $Pays_no_actif = $wpdb->get_results($Pays_no_actifSql, 'ARRAY_A');

        if ($Pays_no_actif)
            foreach ($Pays_no_actif as $value)
                $wpdb->update($table_name_config, array('actif' => 1), array('id' => $value['id']));

        foreach ($changer as $id)
            $wpdb->update($table_name_config, array('actif' => 0), array('id' => $id));

        return "update ok";
    }

    public function Upadate_Accessible($id, $value)
    {
        global $wpdb;

        $table_name_config = $wpdb->prefix . 'hd_insset_config';

        if ($wpdb->update($table_name_config, array('majeur' => $value), array('id' => $id)))
            return "update ok";
        else
            return 'Erreur';
    }

    public function Upadate_Note($id, $value)
    {
        global $wpdb;

        $table_name_config = $wpdb->prefix . 'hd_insset_config';

        if ($wpdb->update($table_name_config, array('note' => $value), array('id' => $id)))
            return "update ok";
        else
            return 'Erreur';
    }

}