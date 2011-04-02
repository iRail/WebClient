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
 */
include_once("datamodel/APICall.class.php");

class DataLayer {
     private $lang;
     private $stations;
     private $user;

     public function __construct($lang, & $user){
	  $this->lang = $lang;
	  $this->user= &$user;
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

/**
 * Vicinity is given in km. X and Y in degrees (double) - not used in current webclient
 */
     public function getClosestStations($x,$y, $vicinity=20){
	  $stationslist = $this->getStations();
	  $output = array();
	  foreach($stationslist["station"] as $station){
	       $distance = $this->distance($x,$station["locationX"],$y,$station["locationY"]);
	       if($distance  < $vicinity){
		    $station["distance"] = $distance;
		    $output[sizeof($output)] = $station;
	       }
	  }
	  //insertion sort with distance as key
	  for($i = 1; $i < sizeof($output); $i ++){
	       $h = $output[$i];
	       $j = $i-1;
	       while($j >= 0 & $output[$j]["distance"] < $h["distance"]){
		    $output[$j+1] = $output[$j];
		    $j--;
	       }
	       $output[$j+1] = $h;
	  }
	  return $output;
     }

     private function distance($x1,$x2,$y1,$y2){
	  $R = 6371; // km
	  $dY = deg2rad($y2-$y1);
	  $dX = deg2rad($x2-$x1);
	  $a = sin($dY/2) * sin($dY/2) + cos(deg2rad($y1)) * cos(deg2rad($y2)) *sin($dX/2) * sin($dY/2);
	  $c = 2 * atan2(sqrt($a), sqrt(1-$a));
	  return $R * $c;
     }


     public function getConnections($from, $to, $direction, $time, $date){
//preconditions: from is a stationname, to is a stationname, direction is arrive or depart, time is Hi, date is dmy.
	  //first let's tell the user class that we got an extra connection
	  $this->user->addUsedRoute($from,$to);
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
	  $this->user->addUsedBoard($station,$destination);
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