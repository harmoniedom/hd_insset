<?php

class inssetHarmonie_Views_config {

    public function display() {

     
        $Configs =inssetHarmonie_crud_index::getConfigs();
	
		?>
		
			<div class="wrap" id="insset_param_update">
                <h1 class="wp-heading-inline"><?php print get_admin_page_title(); ?></h1>
                    <div class="notice notice-info notice-alt is-dismissible hide update-message">
                        <p><?php _e('Successfully updated!'); ?></p>
                    </div>
                <table class="wp-list-table widefat fixed striped">
                    <tfoot>
                        <tr>
                            <th colspan="2">
                                <button class="button button-primary left update">
                                    <i class="fas fa-check"></i>
                                    <?php _e('Update'); ?>
                                </button>
                            </th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($Configs as $Config): ?>
                                <tr>
                                    <th class="smallwidth" style="text-transform: capitalize;">
                                        <?php print $Config['id'] ?>
                                    </th>
                                    <td>
                                        <?php if (preg_match('/date/i', $Config['id'])): ?>
                                            <input type="datetime-local" id="<?php print $Config['id'] ?>" value="<?php print preg_replace('/\s/', 'T', $Config['valeur']) ?>" />
                                        <?php else: ?>
                                            <input id="<?php print $Config['id'] ?>" type="text" value="<?php print $Config['valeur'] ?>" />
                                        <?php endif; ?>
                                        <span class="helper-text">
                                            <?php print $Config['description'] ?>
                                        </span>
                                    </td>
                                </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
		
		<?php
	
	}

}
