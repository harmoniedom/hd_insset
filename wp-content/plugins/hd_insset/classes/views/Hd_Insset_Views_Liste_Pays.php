<?php

class Hd_Insset_Views_Liste_Pays{
    public function display(){

        $Hd_Insset_Crud_Index = new Hd_Insset_Crud_Index();
        $WP_INSSET_List = $Hd_Insset_Crud_Index->get_list_pays();
    

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
                        <select name="pays" id="pays_multiselect" multiple>
                            
                           <?php foreach ($WP_INSSET_List as $List): ?>

                                <option name="<?php print $List['iso'] ?>" id="<?php print $List['iso'] ?>" <?php if($List['actif'])print 'selected'   ?>><?php print $List['pays'] ?> </option>
                            <?php endforeach ?>
                        </select>
                        <span class="helper-text">
                                    Les pays selectionnés serront indisponible 
                        </span>
                    </form>
                </div>
            <div>
        <?php
        
    }
  
    }
    