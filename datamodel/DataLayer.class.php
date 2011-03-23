<?php
/* Copyright (C) 2011 by iRail vzw/asbl
 *
 * This is the DataLayer. It's a class that will perform APICalls only once per HTTP request.
 *
 * Usage:
 * Call the right get functions
 * 
 * If you want to use this class you need to override it into a new class, preferably from the page where you're going to start
 *
 * @author Pieter Colpaert
 * @license aGPL
 *
 * // TODO: Check for errors!
 */
include_once("datamodel/APICall.class.php");
class DataLayer {
     private $lang;
     private $stations;

     public function __construct($lang){
	  $this->lang = $lang;
     }
     
/**
 * Returns a list of all stations according to the lang variable and what the API returns. Normally it will have these variables:
 * array[i] -> name
            -> locationX
            -> locationY
            -> standardname
 */
     public function getStations(){
          //check if the stationslist hasn't been loaded yet
	  if(!isset($this->stations)){
	       $args = array("lang" =>$this->lang);
	       try{
		    $this->stations = APICall::execute("stations", $args);
	       }catch(Exception $e){
		    throw $e;
	       }
	  }
	  return $this->stations;
     }

     public function getConnections($from, $to, $direction, $time, $date){
//preconditions: from is a stationname, to is a stationname, direction is arrive or depart, time is Hi, date is dmy.
	  $args = array(
	       "lang" => $this->lang,
	       "from" => $from,
	       "to" => $to,
	       "timeSel" => $direction,
	       "time" => $time,
	       "date" => $date
	       );
	  try{
	       return APICall::execute("connections", $args);
	  }catch(Exception $e){
	       throw $e;
	  }
     }

     public function getLiveboard($station, $direction, $time, $destination = ""){
	  $args = array(
	       "lang" => $this->lang,
	       "station" => $station,
	       "arrdep" => $direction,
	       "time" => $time
	       );
	  try{
	       $liveboard= APICall::execute("liveboard", $args);
	       if($destination != ""){
		    //only get the destinations out of it
		    $liveboard = $this->findInLiveboard($liveboard,$destination);
	       }
	       return $liveboard;
	  }catch(Exception $e){
	       throw $e;
	  }
     }

     private function findInLiveboard($lb,$dest){
	  $newarray = array();
	  foreach($lb["departures"]["departure"] as $dep){
	       if(strtolower($dep["station"]) == strtolower($dest)){
		    $newarray[sizeof($newarray)] = $dep;
	       }
	  }
	  unset($lb["departures"]["departure"]);
	  $lb["departures"]["departure"] = $newarray;
	  $lb["departures"]["number"] = sizeof($newarray);
	  return $lb;
     }
     

     public function getVehicleinfo($vehicleid){
	  $args = array(
	       "lang" => $this->lang,
	       "id" => $vehicleid
	       );
	  try{
	       return APICall::execute("vehicle", $args);
	  }
	  catch(Exception $e){
	       throw $e;
	  }
	  
     }     

}
?>