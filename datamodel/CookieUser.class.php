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
	       $this->saveInCookie($name,$default);
	  }
     }

     private function checkoutCookieArray($name,$numberof){
	  if($this->numberofvalues < $numberof){ //circularbuffer
	       $numberof = $numberof % $this->numberofvalues;
	  }
	  
	  for($i=0;$i<$numberof;$i++){
	       //killing in the
	       $nameof = $name . $i;
	       if(isset($_COOKIE[$nameof])){	       
		    $ar = &$this->$name;
		    $ar[$i] = $_COOKIE[$nameof];
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
	  $this->lang = $this->setLang($lang);
	  $this->checkoutCookieArray("favroutesfrom", $this->numberoffavroutes);
	  $this->checkoutCookieArray("favroutesto", $this->numberoffavroutes);
	  $this->checkoutCookieArray("favboardsof", $this->numberoffavboards);
	  $this->checkoutCookieArray("favboardsto", $this->numberoffavboards);
	  $this->checkoutCookieArray("usedroutesfrom", $this->numberofusedroutes);
	  $this->checkoutCookieArray("usedroutesto", $this->numberofusedroutes);
	  $this->checkoutCookieArray("usedboardsof", $this->numberofusedboards);
	  $this->checkoutCookieArray("usedboardsto", $this->numberofusedboards);
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
	  $this->saveInCookie($name . $i, $value);
	  $ar = $this->$name;
	  $ar[$i] = $value;
	  $this->$name = $ar;
     }

     public function addFavRoute($from,$to){
	  if(!$this->containsRoute($this->favroutesfrom, $this->favroutesto,$of,$to)){
	       $this->addVarToCookieArray("favroutesfrom",$from);
	       $this->addVarToCookieArray("favroutesto",$to);
	       $this->numberoffavroutes++;
	       $this->saveInCookie("numberoffavroutes",$this->numberoffavroutes);
	  }
     }

     public function addFavBoard($of,$to = ""){
	  if(!$this->containsBoard($this->favboardsof, $this->favboardsto,$of,$to)){
	       $this->addVarToCookieArray("favboardsof",$of);
	       $this->addVarToCookieArray("favboardsto",$to);
	       $this->numberoffavboards++;
	       $this->saveInCookie("numberoffavboards",$this->numberoffavboards);
	  }
     }
     
     public function addUsedBoard($of,$to = ""){
	  if(!$this->containsBoard($this->usedboardsof, $this->usedboardsto,$of,$to)){
	       $this->addVarToCookieArray("usedboardsof",$of);
	       $this->addVarToCookieArray("usedboardsto",$to);
	       $this->numberofusedboards++;
	       $this->saveInCookie("numberofusedboards",$this->numberofusedboards);
	  }
     }

     public function addUsedRoute($from,$to){
	  if(!$this->containsRoute($this->usedroutesfrom, $this->usedroutesto,$from,$to)){
	       $this->addVarToCookieArray("usedroutesfrom",$from);
	       $this->addVarToCookieArray("usedroutesto",$to);
	       $this->numberofusedroutes++;
	       $this->saveInCookie("numberofusedroutes",$this->numberofusedroutes);
	  }
     }

private function containsRoute($atf,$att,$from, $to){
//NY implemented
     return false;
     
}

private function containsBoard($abo,$abt,$of, $to){
//ny implemented
     return false;
     
}



     public function setLang($lang){
	  $this->language = $lang;
	  $this->saveInCookie("language",$lang);
     }

     private function saveInCookie($name,$var){
	  setcookie($name, $var, $this->timetolive, "/");
     }

     public function getLastUsedRoute(){
	  $index = $this->numberofusedroutes % $this->numberofvalues;
	  $frommm = $usedroutesfrom[$index];
	  $tooo = $usedroutesto[$index];
	  return array("from"=> $frommm, "to" => $tooo);
     }
     
     public function getLastUsedBoard(){
	  $index = $this->numberofusedboards % $this->numberofvalues;
	  $of = $usedboardsof[$index];
	  if(isset($usedboardsto[$index])){
	       $to = $usedboardsto[$index];
	  }else{
	       $to = "";
	  }
	  return array("of"=> $of, "to" => $to);
     }

}

?>