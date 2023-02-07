<?php

class inssetHarmonie_Install {

    public function __construct() {

        add_action( 'admin_init', array( $this, 'setup' ) );
        return;

    }



    public function setup() {

        global $wpdb;

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $charset_collate = $wpdb->get_charset_collate();
        $table_name_newsletter = $wpdb->prefix . 'insset_newsletter';
        $table_name_user = $wpdb->prefix . 'insset_user';
        $table_name_config = $wpdb->prefix . 'insset_config';
       

        $sql_create_newsletter = "CREATE TABLE IF NOT EXISTS $table_name_newsletter (
            `id` mediumint(9) NOT NULL AUTO_INCREMENT,
            `time` datetime DEFAULT NOW() NOT NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate;";

        if (dbDelta( $sql_create_newsletter ) ){

            $sql_create_user = "CREATE TABLE IF NOT EXISTS $table_name_user (
                    `id` INT(11) AUTO_INCREMENT NOT NULL,
                    `valeur` VARCHAR(255) NOT NULL,
                    `cle` VARCHAR(255) NOT NULL,
                    `index` mediumint(9) NOT NULL,  
                    PRIMARY KEY (id),
                    FOREIGN KEY (`index`) REFERENCES ".$table_name_newsletter."(id)
                ) $charset_collate;";

            if (dbDelta( $sql_create_user )){

                $sql_create_config = "CREATE TABLE IF NOT EXISTS $table_name_config(
                    `id` VARCHAR(255) NOT NULL,
                    `valeur` VARCHAR(255),
                    `description` VARCHAR(255),
                    `rank` INT(11),
                     PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB $charset_collate;";
        
                 if (dbDelta($sql_create_config ) ){
                    $wpdb->insert($table_name_config, array('id'=>'DateOuverture', 'valeur' => '1', 'description' => '', 'rank'=> 10));
                    $wpdb->insert($table_name_config, array('id'=>'DateFermeture', 'valeur' => '2', 'description' => '', 'rank'=> 20));
                    $wpdb->insert($table_name_config, array('id'=>'MaximumInscrits', 'valeur' => '3', 'description' => '', 'rank'=> 30));
                }
                
            }
        }
    }

       

       

    // public function tableAlreadyExists( $table_name = '' ) {

    //     global $wpdb;

    //     if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) == $table_name )
    //         return true;

    //     return false;

    // }
}