<?php

//CSV = Comma Separating Value

$path= __DIR__;
preg_match('/(.*)wp\-content/i', $path, $dir);
require_once(end($dir) .'wp-load.php');


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
header('Content-Type: application/xml; charset=UTF-8');

$xml = new SimpleXMLElement('<insset_users/>');

foreach ($insset_users as $insset_user) {

    $i = $xml->addChild('insset_user');

    foreach ($insset_user as $key => $value)
        $i->addChild($key, $value);
        
}

print $xml->asXML();

$filename = sprintf('Insset_Export_XML_%s.xml', date('d-m-Y_His'));
header('Content-Disposition: attachment; filename="'. $filename. '";');
header('Content-Transfer-Encoding: binary');
ob_end_flush();
