<?php

class inssetHarmonie_Front {

    public function __construct() {

       

        add_action('wp_enqueue_scripts', array($this, 'addjs'), 0);
        add_action('init',array($this, 'jedeclaredesroutes'), 0);
        add_action('wp_loaded',array($this, 'prendreencomptelebordel'), 0);
        add_filter('query_vars', array($this, 'ajoutvariable'), 0);
        return;

    }
    public function addjs() 
    {
        wp_register_script('insset', plugins_url(inssetHarmonie_PLUGIN_NAME .'/assets/js/InssetHarmonie_Front.js'), array('jquery-new'), inssetHarmonie_VERSION, true); 
        wp_enqueue_script('insset');
        wp_localize_script('insset', 'inssetscript', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'security' => wp_create_nonce('ajax_nonce_security')
        
        ));
        return;
    

    }
    static public function jedeclaredesroutes(){

        add_rewrite_rule(
            INSSET_URL . '/id/([^/]*)/?$',
            'index.php?pagename=' . INSSET_URL . '&mavariabletest=$matches[1]',
            'top'
        );
    }
    static public function ajoutvariable($query_vars){
        $query_vars[]= 'mavariabletest';
        return $query_vars;


    }
    static public function prendreencomptelebordel(){
        global $wp_rewrite;
        return $wp_rewrite->flush_rules();


    }
}