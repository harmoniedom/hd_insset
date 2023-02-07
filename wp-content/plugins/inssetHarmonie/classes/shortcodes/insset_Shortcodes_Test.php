<?php

add_shortcode('INSSET_TEST', array('insset_Shortcode_Test', 'test'));


class insset_Shortcode_Test {

    static public function test() {

        return serialize(get_query_var('mavariabletest'));
        
        
    }

}