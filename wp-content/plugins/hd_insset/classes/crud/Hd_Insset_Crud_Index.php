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

    //appel de fonction dans Hd_Insset_Views_Config.php
    static function getConfig()
    {
        global $wpdb;

        $table_name_config = $wpdb->prefix . 'hd_insset_config';

        //ajouter résultat dans la base de donnée
        $sql = "SELECT * FROM $table_name_config";

        return $wpdb->get_results($sql, 'ARRAY_A');
    }

   //appel de fonction Hd_Insset_Front_Actions_index.php
    public function Creation_Prospects($nom, $prenom, $sexe, $email, $date_naissance)
    {
        global $wpdb;

        $table_name_prospects = $wpdb->prefix . 'hd_insset_prospects';

        //insertion nom,prenom,sexe,email,naissance
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
    }

    //appel de fonction dans Hd_Insset_Shortcode_Form_selection.php
    static function getAge()
    {

        // il n'y as pas de système d'authentification donc on récupère toujours le premier prospect ( une nouvelle inscription dans le formulaire remplace la première ligne )
        global $wpdb;
        $table_name_prospects = $wpdb->prefix . 'hd_insset_prospects';

        $sqlAge = "SELECT * FROM $table_name_prospects WHERE `id`=1";
        $prospect = $wpdb->get_results($sqlAge, 'ARRAY_A');


        // // $Naissance = $prospect['0']['date_naissance'];
        // // $aujourdhui = date("Y-m-d");
        // // $dateDiff = date_diff(date_create($Naissance), date_create($aujourdhui));
        //  $age = $dateDiff->format('%y');

        // if ($age >= 18) {
        //     // le prospect est majeur
        //     $table_name_config = $wpdb->prefix .'hd_insset_config';

        //     $sql = "SELECT * FROM $table_name_config WHERE `actif`=1";

        //     return $wpdb->get_results($sql, 'ARRAY_A');

        // } else {

        //     // le prospect est mineur
        //     $table_name_config = $wpdb->prefix .'hd_insset_config';

        //     $sql = "SELECT * FROM $table_name_config WHERE `actif`=1 AND `accessible`=0";

        //     return $wpdb->get_results($sql, 'ARRAY_A');
        // }
    }

     //appel de fonction dans Hd_Insset_Admin_Actions_Index.php
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

    //appel de fonction dans Hd_Insset_Admin_Actions_Index.php
    public function Upadate_Accessible($id, $value)
    {
        global $wpdb;

        $table_name_config = $wpdb->prefix . 'hd_insset_config';

        //ajout de la valeur
        if ($wpdb->update($table_name_config, array('majeur' => $value), array('id' => $id)))
            return "update ok";
    }

    //appel de fonction dans Hd_Insset_Admin_Actions_Index.php
    public function Upadate_Note($id, $value)
    {
        global $wpdb;

        $table_name_config = $wpdb->prefix . 'hd_insset_config';

        //ajout de la valeur
        if ($wpdb->update($table_name_config, array('note' => $value), array('id' => $id)))
            return "update ok";
    }

}