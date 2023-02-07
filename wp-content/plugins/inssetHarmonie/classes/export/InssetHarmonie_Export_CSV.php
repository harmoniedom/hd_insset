<?php

//CSV = Comma Separating Value

$path= __DIR__;
preg_match('/(.*)wp\-content/i', $path, $dir);
require_once(end($dir) .'wp-load.php');

function trimming(string $val):string {
    return trim($val);

};

global $wpdb;

$sql = "SELECT A.*, 
(SELECT B.`valeur` FROM " .$wpdb->prefix . 'insset_user' .  " B WHERE B.`index`=A.`id` AND B.`cle`='firstname' LIMIT 1) AS 'firstname', 
(SELECT B.`valeur` FROM " .$wpdb->prefix . 'insset_user' .  " B WHERE B.`index`=A.`id` AND B.`cle`='email' LIMIT 1) AS 'email',
(SELECT B.`valeur` FROM " .$wpdb->prefix . 'insset_user' .  " B WHERE B.`index`=A.`id` AND B.`cle`='lastname' LIMIT 1) AS 'lastname',
(SELECT B.`valeur` FROM " .$wpdb->prefix . 'insset_user' .  " B WHERE B.`index`=A.`id` AND B.`cle`='CodePostal' LIMIT 1) AS 'CodePostal'
FROM " .$wpdb->prefix . 'insset_newsletter'." A";



$insset_users = $wpdb->get_results($sql, 'ARRAY_A');

ob_start();

header('Pragma: public');
header('Expires: 0');
header('Cache-Controle: must-revalidate, post-check=0, precheck=0');
header('Cache-Control: private', false);
header('Content-Type: text/csv; charset=UTF-8');

$heads= array(
    'firstname',
    'email',
    'lastname',
    'CodePostal'
);

print '"' . implode('"; "', $heads). "\"\n";

foreach ($insset_users as $insset_user):
    $insset_user = array_map('trimming', $insset_user);

    $fields = array(
        (string) mb_strtoupper ($insset_user['firstname'],'UTF-8'),
        (string) mb_strtoupper ($insset_user['email'],'UTF-8'),
        (string) mb_strtoupper($insset_user['lastname'],'UTF-8'),
        (string) mb_strtoupper ($insset_user['CodePostal'],'UTF-8')

    );

    print '"' . implode('"; "', $fields). "\"\n";

endforeach;

$filename = sprintf('inssetHarmonie_Export_CSV_%s.csv', date('d-m-Y_His'));
header('Content-Disposition: attachment; filename="'. $filename. '";');
header('Content-Transfer-Encoding: binary');
ob_end_flush();