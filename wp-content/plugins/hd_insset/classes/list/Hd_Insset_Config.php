<?php

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH .'wp-admin/includes/screen.php');
    require_once(ABSPATH .'wp-admin/includes/class-wp-list-table.php');
}

class Hd_Insset_Config extends WP_List_Table {

    public $_screen;

    public function __construct($program = NULL) {

        $this->_program = $program;

        $tempscreen = get_current_screen();
        $this->_screen = $tempscreen->base;

        parent::__construct( [
            'singular' => __('Item', 'sp'),
            'plural'   => __('Items', 'sp'),
            'ajax'     => false
        ]);

    }

    public function prepare_items() {

        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);

        $data = $this->table_data();
        $currentPage = $this->get_pagenum();

        $perPage = 10;
        $this->set_pagination_args(array(
            'total_items' => count($data),
            'per_page'    => $perPage
        ));

        $data = array_slice($data, (($currentPage-1)*$perPage), $perPage);

        $this->items = $data;

    }

    public function get_columns($columns = array()) {

        // $columns['iso'] = __('iso');
        // $columns['pays'] = __('pays');
        // $columns['note'] = __('note');
        // $columns['accessible'] = __('accessible');
        // $columns['actif'] = __('actif');

        
            global $wpdb;
           // $data = $wpdb->prefix . $this->_tableName;
           

            $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'" . $wpdb->prefix . "hd_insset_config" . "'";
          

            $result = $wpdb->get_results($sql, 'ARRAY_A');
        

            foreach ($result as $value)
            if ($value["COLUMN_NAME"] != "id" && $value["COLUMN_NAME"] != "actif")
                $columns[$value["COLUMN_NAME"]] = __($value["COLUMN_NAME"]);

           
            return $columns;
        
        }
    
  
    public function get_hidden_columns($default = array()) {

        return $default;

    }

    public function get_sortable_columns($sortable = array()) {
    global $wpdb;
   $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME =N'hd_insset_config'";
   
   $result = $wpdb->get_results($sql, 'ARRAY_A');



    foreach ($result as $value)
    $sortable[$value["COLUMN_NAME"]] = array($value["COLUMN_NAME"], true);
    
    // $sortable["iso"] = array('iso', true);
    // $sortable["pays"] = array('pays', true);
    // $sortable["note"] = array('note', true);
    // $sortable["accessible"] = array('accessible', true);
    // $sortable["actif"] = array('actif', true);
    return $sortable;

    }

    public function table_data($per_page=10, $page_number=1, $orderbydefault=false) {

        global $wpdb;

            $sql = "SELECT * FROM `" . $wpdb->prefix . "hd_insset_config" . "`";
            
            
            

        if (!empty($_REQUEST['orderby'])) {
			$sql .= ' ORDER BY `'. esc_sql($_REQUEST['orderby']) .'`';
			$sql .= ! empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;

    }

    public function column_default( $item, $column_name ) {

        
         if (preg_match('/accessible/i', $column_name))
            return self::getAccessible($item['id']);

        if (preg_match('/note/i', $column_name))
            return self::getNote($item['id']);

        return @$item[$column_name];

    }

    private function getNote($id = 0)
    {
    
        if (!$id)
        return;

        return  sprintf(
            '<select name="note" class="select-note" data-id="%s">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>',
            $id,
            __('note')
        );
    }

    private function getAccessible($id = 0, $accessible = 0)
    {

        if (!$id)
        return;

    return  sprintf(
        '<input type="checkbox" class="acessible_checkBox" name="accessible" data-id="%s">',
      
            $id,
            __('accessible')
        );
    }
}