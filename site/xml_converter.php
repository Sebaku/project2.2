<?php
/**
 * Created by PhpStorm.
 * User: irenanowak
 * Date: 02/02/2020
 * Time: 16:25
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

if(!isset($_GET['date']) && (!isset($_GET['stn']))) {
    die('Invalid request');
}

$date = $_GET['date'];
$stn = $_GET['stn'];

$filename = "data/" . $date . "/" . $stn . ".txt";
$file = fopen($filename, "r");
$file = fread($file, filesize($filename));

$temp = substr($file, 0, 3);
$dewp = substr($file, 3, 3);
$stp = substr($file, 6, 3);
$slp = substr($file, 9, 3);
$visib = substr($file, 12, 3);
$wdsp = substr($file, 15, 4);
$prcp = substr($file, 19, 2);
$sndp = substr($file, 21, 2);
$frshtt = substr($file, 23, 2);
$cldc = substr($file, 25, 3);
$wnddir = substr($file, 28, 3);

$xml = new SimpleXMLElement("<weatherdata></weatherdata>");
$measurement = $xml->addChild("measurement");
$measurement->addChild("stn", $stn);
$measurement->addChild("date", $date);
$measurement->addChild("temp", $temp);
$measurement->addChild("dewp", $dewp);
$measurement->addChild("stp", $stp);
$measurement->addChild("slp", $slp);
$measurement->addChild("visib", $visib);
$measurement->addChild("wdsp",$wdsp);
$measurement->addChild("prcp", $prcp);
$measurement->addChild("sndp", $sndp);
$measurement->addChild("frshtt", $frshtt);
$measurement->addChild("cldc", $cldc);
$measurement->addChild("wnddir", $wnddir);

Header('Content-type: text/xml');
header("Content-disposition: attachment; filename=\"weatherdata_" . $stn . ".xml\"");
$dom = dom_import_simplexml($xml)->ownerDocument;
$dom->formatOutput = true;
echo $dom->saveXML();

?>