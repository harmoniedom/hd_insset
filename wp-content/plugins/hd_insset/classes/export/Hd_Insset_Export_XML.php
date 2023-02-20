<?php

//CSV = Comma Separating Value

$path= __DIR__;
preg_match('/(.*)wp\-content/i', $path, $dir);
require_once(end($dir) .'wp-load.php');


global $wpdb;

$table_name_config = $wpdb->prefix . 'hd_insset_config';

$sql = "SELECT * FROM $table_name_config";

$ListePays = $wpdb->get_results($sql, 'ARRAY_A');

ob_start();

header('Pragma: public');
header('Expires: 0');
header('Cache-Controle: must-revalidate, post-check=0, precheck=0');
header('Cache-Control: private', false);
header('Content-Type: application/xml; charset=UTF-8');

$xml = new SimpleXMLElement('<ListePays/>');

foreach ($ListePays as $pays) :
    $event = $xml->addChild("pays");

    foreach ($pays as $key => $value)
        $$key = $value;


    $event->addChild("pays", $pays . " " . $iso);
    $event->addChild("note", $note);

    if ($accessible)
        $event->addChild("accessible", "oui");
    else
        $event->addChild("accessible", "non");


    if ($actif)
        $event->addChild("actif", "actif");
    else
        $event->addChild("actif", "inactif");


endforeach;

print $xml->asXML();


$filename = sprintf('Hd_Insset_Export_XML_%s.xml', date('d-m-Y_His'));
header('Content-Disposition: attachment; filename="' . $filename . '";');
header('Content-Transfer-Encoding: binary');

ob_end_flush();