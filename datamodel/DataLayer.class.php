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
	       $this->stations = APICall::execute("stations");
	  }
	  return $this->stations;
     }

     public function getConnections($from, $to, $direction, $time, $date){
//preconditions: from is an ID, to is an ID, direction is arrival or departure, time is Hi, date is dmY.
	  $args = array(
	       "lang" => $this->lang,
	       "from" => $from,
	       "to" => $to,
	       "arrdep" => $direction,
	       "time" => $time,
	       "date" => $date
	       );
	  return APICall::execute("connections", $args);
     }

     public function getLiveboard($station, $direction, $time){
	  $args = array(
	       "lang" => $this->lang,
	       "station" => $station,
	       "arrdep" => $direction,
	       "time" => $time
	       );
	  return APICall::execute("liveboard", $args);
     }

     public function getVehicleinfo($vehicleid){
	  $args = array(
	       "lang" => $this->lang,
	       "id" => $vehicleid
	       );
	  return APICall::execute("vehicle", $args);
     }     

}
?>