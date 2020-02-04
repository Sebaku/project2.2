<?php
/**
 * Created by PhpStorm.
 * User: irenanowak
 * Date: 02/02/2020
 * Time: 16:25
 */

// Get date & station number or die
if(!isset($_GET['date']) && (!isset($_GET['stn']))) {
    die('Invalid request');
}

$date = $_GET['date'];
$stn = $_GET['stn'];

// Open .txt data file
$filename = "data/" . $date . "/" . $stn . ".txt";
$file = fopen($filename, "r");
$file = fread($file, filesize($filename));

// Slice string in $file (34 characters total)
$temp = substr($file, 0, 3);
$temp = (($temp-500)/10)*1.8+32; // Temperature in Fahrenheit
$dewp = substr($file, 3, 3);
$stp = substr($file, 6, 4);
$slp = substr($file, 10, 4);
$visib = substr($file, 14, 3);
$wdsp = substr($file, 17, 3);
$prcp = substr($file, 20, 3);
$sndp = substr($file, 23, 3);
$frshtt = substr($file, 26, 2);
$cldc = substr($file, 28, 3);
$wnddir = substr($file, 31, 3);

// Create XML file
$xml = new SimpleXMLElement("<weatherdata/>");
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