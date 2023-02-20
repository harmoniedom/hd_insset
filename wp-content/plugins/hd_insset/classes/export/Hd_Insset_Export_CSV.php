<?php

//CSV = Comma Separating Value

$path= __DIR__;
preg_match('/(.*)wp\-content/i', $path, $dir);
require_once(end($dir) .'wp-load.php');

function trimming(string $val):string {
    return trim($val);

};

global $wpdb;

$table_name_config = $wpdb->prefix . 'hd_insset_config';
$table_name_prospects = $wpdb->prefix . 'hd_insset_prospects';
$table_name_pays = $wpdb->prefix . 'hd_insset_pays';

$sql = "SELECT $table_name_config.iso, $table_name_prospects.* FROM $table_name_pays INNER JOIN $table_name_config on $table_name_pays.iso = $table_name_config.iso INNER JOIN $table_name_prospects on $table_name_pays.id_pays = $table_name_prospects.id";

$prospects = $wpdb->get_results($sql, 'ARRAY_A');

ob_start();

header('Pragma: public');
header('Expires: 0');
header('Cache-Controle: must-revalidate, post-check=0, precheck=0');
header('Cache-Control: private', false);
header('Content-Type: text/csv; charset=UTF-8');

$heads = array(
    'GENRE',
    'NOM',
    'PRENOM',
    'MAIL',
    'AGE',
    'PAYS'
);

//test
foreach ($prospects as $prospect) :

    $prospect = array_map('triming', $prospect);

    $date = new DateTime($prospect['date_naissance']);
    $now = new DateTime();
    $interval = $now->diff($date);
    $age = $interval->y;


    $fields = array(
        (string) $prospect['sexe'],
        (string) mb_strtoupper($prospect['nom'], 'UTF-8'),
        (string) mb_strtoupper($prospect['prenom'], 'UTF-8'),
        (string) strtolower($prospect['email']),
        (string) $age,
        (string) $prospect['iso'],
    );

    print '"' . implode('"; "', $fields). "\"\n";

endforeach;

$filename = sprintf('Hd_Insset_Export_CSV_%s.csv', date('d-m-Y_His'));
header('Content-Disposition: attachment; filename="'. $filename. '";');
header('Content-Transfer-Encoding: binary');
ob_end_flush();