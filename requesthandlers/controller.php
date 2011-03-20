<?php
/* Copyright (C) 2011 by iRail vzw/asbl 
 *
 * This will catch all requests through the hidden url-rewrite service (see .htaccess). It will generate a Model and a View through the Page class.
 *
 * @author Pieter Colpaert
 * @license AGPL
 */
//set the include path to the root
ini_set('include_path', '../');
//Step 0: Include all necessary files
include_once("requesthandlers/Page.class.php");
include_once("datamodel/DataLayer.class.php");

//Step 1: Implement the abstract Page class
//This class will automatically include necessary stuff such like error handling

class Controller extends Page{
   /**
    * Function is used for API Requests
    * @return array will return an associative array of page specific variables.
    */
     protected function loadContent(){
	  $data = new DataLayer($this->getLang());
	  //Step 2: Get the get vars, change them to the right format & boom
	  extract($_GET);
	  if($page == "boardresult"){
	       return $data->getLiveboard($station,$arrdep,$time);
	  }else if($page == "routeresult"){
	       return $data->getConnections($from, $to, $arrdep, $time, $date);
	  }else if($page != "error"){
	       //let's not do a request if there is an error page
	       //in other cases, just output the stationslist - needed on most pages
	       return $data->getStations();
	  }
	  
	  
     }
}

//Step 3: load the process
$instance = new Controller();
$instance->buildPage($_GET["page"]);

?>