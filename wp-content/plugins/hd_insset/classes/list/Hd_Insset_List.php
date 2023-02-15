<?php

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH .'wp-admin/includes/screen.php');
    require_once(ABSPATH .'wp-admin/includes/class-wp-list-table.php');
}

class Hd_Insset_List extends WP_List_Table {

    public $_tablename = 'hd_insset_pays';
    public $_program;
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

        $columns['iso'] = __('iso');
        $columns['pays'] = __('pays');
        $columns['note'] = __('note');
        $columns['accessible'] = __('majeurs');
        $columns['actif'] = __('actif');

        
            global $wpdb;
            $data = $wpdb->prefix . $this->_tableName;

          $sql = "SELECT DISTINCT valeur FROM `$data` WHERE valeur <> '';";
        
            $result = $wpdb->get_results($sql, 'ARRAY_A');
        
            foreach ($result as $col) {
                $columns[$col['valeur']] = __($col['valeur']);
            }
            $columns['delete'] = __('delete');
            return $columns;
        
        }

    public function get_hidden_columns($default = array()) {

        return $default;

    }

    public function get_sortable_columns($sortable = array()) {
    global $wpdb;

    $sql = "SELECT DISTINCT `valeur` FROM " . $wpdb->prefix . 'hd_insset_pays' . " WHERE `valeur` != ''";

    $result = $wpdb->get_results($sql, 'ARRAY_A');

    foreach ($result as $value)
        $sortable[$value["Valeur"]] = array($value["valeur"], true);

    $sortable["iso"] = array('iso', true);
    $sortable["pays"] = array('pays', true);
    $sortable["note"] = array('note', true);
    $sortable["accessible"] = array('accessible', true);
    $sortable["actif"] = array('actif', true);
    return $sortable;

    }

    public function table_data($per_page=10, $page_number=1, $orderbydefault=false) {

        global $wpdb;

            $sql = "SELECT * FROM " . $wpdb->prefix . $this->_tableName;
            
            

        if (!empty($_REQUEST['orderby'])) {
			$sql .= ' ORDER BY `'. esc_sql($_REQUEST['orderby']) .'`';
			$sql .= ! empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;

    }

    public function column_default( $item, $column_name ) {

        //supprimer
        if (preg_match('/delete/i',$column_name))
            return self::getDelete($item['iso']);

        
        if(preg_match('/accessible/i',$column_name))
            return sprintf( '<input type="checkbox" name="accessible" id="%s" %s>', $item['iso'], $item['accessible'] == 1 ? 'checked' : '' );

        if(preg_match('/note/i',$column_name))
            return sprintf( '<select name="note" id="%s" class="note">%s</select>', $item['iso'], $this->getNote($item['note']) );

        return @$item[$column_name];

    }

    private function getNote($note){
        $note = (int)$notation;
        $note = $note > 5 ? 5 : $note;
        $note = $note < 1 ? 1 : $note;
        $note = $note == 0 ? 1 : $note;

        $html = '';
        for($i = 1; $i <= 5; $i++){
            $html .= sprintf( '<option value="%d" %s>%d</option>', $i, $note== $i ? 'selected' : '', $i );
        }

        return $html;
    }

    private function getAccessible($id = 0, $accessible = 0)
    {
        if (!$id)
            return;

        if ($accessible)
            printf("<input data-id=$id type='checkbox' name='accessible' checked class='accessible_checkBox'>");
        else
            printf("<input data-id=$id type='checkbox' name='accessible' class='accessible_checkBox'>");
    }

    private function getDelete($id=0) {

        if (!$id)
            return;

        return  sprintf(
            '<button data-id="%d" class="button button-secondary deleteButton"> %s </button>',
            $id,
            __(''));
    }

}