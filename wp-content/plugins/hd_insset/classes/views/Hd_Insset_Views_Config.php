<?php

class Hd_Insset_Views_Config 
{
    public function display(){

        //$Hd_Insset_Crud_Index = new Hd_Insset_Crud_Index();
        $WP_INSSET_Config = new Hd_Insset_Config();

        $Config = Hd_Insset_Crud_Index::getConfig();

        $tempscreen = get_current_screen();
        $this->_screen = $tempscreen->base;
    
        ?>
            <div class="wrap">

                <h1 class="wp-heading-inline"><?php print get_admin_page_title(); ?></h1>
                <hr class="wp-header-end" />

                <div class="notice notice-info notice-alt is-dismissible hide delete-confirmation">
                    <p><?php _e('Mise à jour effectuée !'); ?></p>
                </div>

                <div class="wrap" id="list-table">
                    <form id="list-table-form" method="post">

                    <tfoot>
                        <tr>
                            <th colspan="2">
                                <button class="button button-primary" id="Hd-submitPaysConfig">
                                    Modifier les pays
                                </button>
                            </th>
                        </tr>
                    </tfoot>

                        <select name="pays" id="hd_pays_multiselect" multiple>
                           <?php foreach ($Config as $Liste): ?>
                                <option value="<?php print $Liste['id'] ?>" <?php if ($Liste['actif'] == 0) print 'selected'; ?>><?php print $Liste['pays'] ?></option>

                                    <?php endforeach; ?>
                                </select>

                        <span class="helper-text">
                            Les pays selectionnés sont indisponibles
                        </span>

                    </form>
                </div>
            <div>
        <?php
        
    }
  
}
    