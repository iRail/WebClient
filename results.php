<?php
/*   Copyright 2010 iRail vzw

    Author: Pieter Colpaert (pieter@irail.be - http://bonsansnom.wordpress.com)

    This file is part of iRail.

    iRail is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    iRail is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with iRail.  If not, see <http://www.gnu.org/licenses/>.

    http://project.irail.be - http://irail.be

    Source available at http://github.com/Tuinslak/iRail
*/

// National query page

//##PHASE 1: let's check all variables as given and let's set the cookies where needed##
global $lang, $timesel, $from, $to, $results,$typeOfTransport, $template, $time;
extract($_COOKIE);
extract($_POST);
$lang = $_COOKIE["language"];

// if bad stations, go back -- TODO: should be checked in javascript before submitting!

if(!isset($_POST["from"]) || !isset($_POST["to"]) || $from == $to) {
	header('Location: ..');
}

// save stations in cookies
setcookie("from", $_POST['from'], time()+60*60*24*360);
setcookie("to", $_POST['to'], time()+60*60*24*360);

// create time var
$time = mktime($h,$m,0,$mo+0,$d+0,("20" . $y)+0);

// language settings
if(!isset($lang)) {
	$lang = "EN";
}
if(!isset($_POST["timesel"])){
    $timesel = "depart";
}

$results = 6;
$typeOfTransport = "all";

$template = "iRail";
$from = $_POST['from'];
$to = $_POST['to'];

//##PHASE2: extending the Page class - by returning the right data we can create the right page! ##

include_once "Page.php";
include_once "config.php";
class Results extends Page{

     protected function loadContent(){
	  global $lang, $timesel, $from, $to, $results,$typeOfTransport, $template, $time;
	  global $APIurl, $iRailAgent;
	  
	  $url = $APIurl . "connections/?from=" . $from . "&to=".$to . "&date=" . date("dmy",$time) . "&time=" . date("H:i") . "&format=json&lang=" . parent::getLang();
	  $request_options = array(
	       "referer" => "http://iRail.be/",
	       "timeout" => "30",
	       "useragent" => $iRailAgent
	     );
	  $post = http_post_data($url, "", $request_options) or die("");
	  $json = http_parse_message($post)->body;
	  return json_decode($json,true);
     }

     protected function loadPage(){
	  $page = array();
	  $page["title"] = "iRail.be";
	  $page["strike"] = false;
	  return $page;
     }
};

//##PHASE3: creating a class and generate the page ##

$page = new Results();
$page ->setDetectLanguageAndTemplate(true);
$page -> buildPage("Results");



?>