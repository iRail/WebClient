<?php
/**
 *  Copyright 2010,2011 iRail vzw
    Author:  Pieter Colpaert (pieter@irail.be - http://bonsansnom.wordpress.com)

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

	source available at http://github.com/iRail

 */

include_once("Page.php");
include_once("config.php");

class Main extends Page {

    function loadContent(){
	  global $APIurl, $iRailAgent;
	  
	  $url = $APIurl . "stations/?&format=json&lang=" . parent::getLang();
	  $request_options = array(
	       "referer" => "http://iRail.be/",
	       "timeout" => "30",
	       "useragent" => $iRailAgent
	     );
	  $post = http_post_data($url, "", $request_options) or die("");
	  $json = http_parse_message($post)->body;
	  $json = json_decode($json,true);
	  $stationarray = array();
	  $i = 0;
	  foreach($json["station"] as $tag => $value){
	       $stationarray[$i] = "\"".$value["name"]."\"";
	       $i++;
	  }
	  return $stationarray;
    }

    function loadPage(){
	$page = array();
        $page["stationarray"] = "";
        $page["date"] = date("D d/m/Y H:i");
        if(isset($_COOKIE["from"]))
            $page["from"] = $_COOKIE["from"];
        else
            $page["from"] = "";

        if(isset($_COOKIE["to"]))
            $page["to"] = $_COOKIE["to"];
        else
            $page["to"] = "";
	$page["title"]= "iRail.be";
	
	return $page;
    }
}

//__MAIN__

$page = new Main();
$page -> setDetectLanguageAndTemplate(true);
$page -> buildPage("Main");
?>
