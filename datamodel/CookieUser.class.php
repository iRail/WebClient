<?php
/* Copyright (C) 2011 by iRail vzw/asbl
 *
 * This is part of the DataLayer. Use this class to store and load information about your user from a cookie.
 *
 *
 * @author Pieter Colpaert
 * @license aGPL
 * @package datamodel
 */
include_once("datamodel/IUser.class.php");
class CookieUser implements IUser{

     private $numberoffavroutes = 0;
     private $favroutesfrom = array();
     private $favroutesto = array();
     private $numberoffavboards = 0;
     private $favboardsof = array();
     private $favboardsto = array();
     private $numberofusedroutes = 0;
     private $usedroutesfrom = array();
     private $usedroutesto = array();
     private $numberofusedboards= 0;
     private $usedboardsof = array();
     private $usedboardsto = array();
     private $language;

     private $timetolive;
     private $numberofvalues;

     private function checkoutCookieVar($name,$default){
	  if(isset($_COOKIE[$name])){
	       $this->$name= $_COOKIE[$name];
	  }else{
	       $this->$name = $default;
	       setcookie($name,$default,$this->timetolive);
	  }
     }

     private function checkoutCookieArray($name,$numberof){
	  if(isset($_COOKIE[$name])){
	       for($i=0;$i<$numberof;$i++){
		    $this->$name[$i]= $_COOKIE[$name . $i];
	       }
	  }  
     }
     

     public function __construct($lang){
	  include("config.php");
	  $this->timetolive= $timetolive;
	  $this->numberofvalues = $values;
	  $this->checkoutCookieVar("numberoffavroutes", 0);
	  $this->checkoutCookieVar("numberofusedroutes", 0);
	  $this->checkoutCookieVar("numberoffavboards", 0);
	  $this->checkoutCookieVar("numberofusedboards", 0);
	  $this->checkoutCookieVar("language", $lang);
	  $this->checkoutCookieArray("favroutesfrom", $this->numberoffavroutes);
	  $this->checkoutCookieArray("favroutesto", $this->numberoffavroutes);
	  $this->checkoutCookieArray("favboardsof", $this->numberoffavboards);
	  $this->checkoutCookieArray("favboardsto", $this->numberoffavboards);
	  $this->checkoutCookieArray("usedroutesfrom", $this->numberofusedroutes);
	  $this->checkoutCookieArray("usedroutesto", $this->numberofusedroutes);
	  $this->checkoutCookieArray("usedboardsof", $this->numberofusedboards);
	  $this->checkoutCookieArray("usedboardsto", $this->numberofusedboards);
//DUMMY DATA
	  $this->addFavRoute("Gent sint pieters", "Diest");
	  $this->addUsedBoard("Gent sint pieters");
	  $this->addUsedBoard("Hasselt");
	  $this->addUsedRoute("Gent sint pieters","Harelbeke");

//	  var_dump($this->usedboardsof);
	  
	  
     }

     public function getFavRoutes(){
	  $frf = $this->favroutesfrom;
	  $frt = $this->favroutesto;
	  return array("from" =>  $frf, "to" => $frt);
     }
     
     public function getFavBoards(){
	  return array("of" => $this->favboardsof , "to" => $this->favboardsto);
     }
     
     public function getUsedBoards(){
	  return array("of" => $this->usedboardsof , "to" => $this->usedboardsto);	  
     }
     
     public function getUsedRoutes(){
	  return array("from" => $this->usedroutesfrom , "to" => $this->usedroutesto);	  
     }
     
     public function getLang(){
	  return $this->language;
     }

     //circular buffer
     private function addVarToCookieArray($name,$value){
	  $i = sizeof($this->$name) % $this->numberofvalues;
	  setcookie($name . $i, $value, $this->timetolive);
	  $ar = $this->$name;
	  $ar[$i] = $value;
	  $this->$name = $ar;
     }

     public function addFavRoute($from,$to){
	  $this->addVarToCookieArray("favroutesfrom",$from);
	  $this->addVarToCookieArray("favroutesto",$to);
	  if($this->numberoffavroutes <= $this->numberofvalues)
	  $this->numberoffavroutes++;
	  setcookie("numberoffavroutes",$this->numberoffavroutes, $this->timetolive);
     }

     public function addFavBoard($of,$to = ""){
	  $this->addVarToCookieArray("favboardsof",$of);
	  $this->addVarToCookieArray("favboardsto",$to);
	  if($this->numberoffavboards <= $this->numberofvalues)
	  $this->numberoffavboards++;
	  setcookie("numberoffavboards",$this->numberoffavboards, $this->timetolive);
     }
     
     public function addUsedBoard($of,$to = ""){
	  $this->addVarToCookieArray("usedboardsof",$of);
	  $this->addVarToCookieArray("usedboardsto",$to);
	  if($this->numberofusedboards <= $this->numberofvalues){
	       $this->numberofusedboards++;
	  }
	  setcookie("numberofusedboards",$this->numberofusedboards, $this->timetolive);
     }

     public function addUsedRoute($from,$to){
	  $this->addVarToCookieArray("usedroutesfrom",$from);
	  $this->addVarToCookieArray("usedroutesto",$to);
	  if($this->numberofusedroutes <= $this->numberofvalues)
	  $this->numberofusedroutes++;
	  setcookie("numberofusedroutes",$this->numberofusedroutes, $this->timetolive);
     }

     public function setLang($lang){
	  $this->language = $lang;
	  setcookie("language", $this->language, $this->timetolive);
     }

}

?>