<?php

if (!class_exists('WP_List_Table')) 
{
    require_once(ABSPATH . 'wp-admin/includes/screen.php');
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Hd_Insset_Liste_Prospects extends WP_List_Table 
{

    public $_screen;

    public function __construct()
    {
        $tempscreen = get_current_screen();
        $this->_screen = $tempscreen->base;

        parent::__construct([
            'singular' => __('Item', 'sp'),
            'plural'   => __('Items', 'sp'),
            'ajax'     => false
        ]);
    }

    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);

        $data = $this->table_data();
        $currentPage = $this->get_pagenum();

        $perPage = 10;
        $this->set_pagination_args(array(
           // 'total_items' => count($data),
            'per_page'    => $perPage
        ));


        $this->items = $data;
    }

    public function get_columns($columns = array())// affichage des deux colonnes lors du regroupement
    {
        $columns['prospects'] = __('Utilisateur'); 
        $columns['pays'] = __('Nombre de pays selectionné');

        return $columns;
    }

    public function get_hidden_columns($default = array())
    {
        return $default;
    }


    public function get_sortable_columns($sortable = array())
    {
        return $sortable;
    }

    public function table_data($per_page = 10, $page_number = 1, $orderbydefault = false)
    {
        global $wpdb;

        $sql = "SELECT COUNT( * ) as 'numero_pays', wp_hd_insset_prospects.* FROM wp_hd_insset_pays INNER JOIN wp_hd_insset_prospects on wp_hd_insset_pays.id_prospects = wp_hd_insset_prospects.id GROUP BY wp_hd_insset_prospects.id ";
        
        if (!empty($_REQUEST['orderby'])) 
        {
            $sql .= ' ORDER BY `' . esc_sql($_REQUEST['orderby']) . '`';
            $sql .= !empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;
    }

    public function column_default($item, $column_name) //affichage dans la barre de recherche
    {
        if (preg_match('/prospects/i', $column_name))
            return self::getProspects($item['sexe'], $item['nom'], $item['prenom']);

        if (preg_match('/pays/i', $column_name))
            return self::getPays($item['numero_pays']);

        return @$item[$column_name];
    }

    private function getPays($numero_pays = 0) // retourne le numéro du pays qui correspond
    {
        if (!$numero_pays)
            return;

        print("$numero_pays");
    }

    private function getProspects($sexe = "", $nom = "", $prenom = "") // affichage du nom prenom sexe du prospects
    {
        if (!$sexe && !$nom && !$prenom)
            return;

        if ($sexe == "Homme")
            printf("Mr $nom $prenom");
        else
            printf("Mme $nom $prenom");
    }
}

