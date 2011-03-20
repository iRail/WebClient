<?php
/* Copyright (C) 2011 by iRail vzw/asbl
 *
 * This is the main datalayer. This class will perform the requests to the API according to the arguments given to the static execute call. You will retrieve the json tree into a variable.
 *
 * Usage example:
 *
 * include_once("datamodel/APICall.php");
 * $result = APICall::execute();
 * 
 * @author Pieter Colpaert
 * @license aGPL
 * @package datamodel
 */
class APICall {

     public static function execute($functionname, $argumentarray = array()){
          //preconditions: we need a good functionname (probably one of the four defined in the iRail api, but let's not be racist). If we urlencode the functionname we're sure that no hacking will be possible (such as entering http://www.ihazhackedyourwebsitescript as a functionname)
	  $functionname= urlencode($functionname);
          //url encode the argumentsarray so we have a good call to the API
	  $arguments = "";
	  foreach($argumentarray as $argument){
	       $arguments .= "&" . urlencode($argument);
	  }
	  include("config.php");
	  $url = $APIurl . $functionname . "/?format=json" . $arguments;
	  //Now let's fire up the call to the api and return the result
	  return json_decode(APICall::httpcall($url), true);
     }

     private static function httpcall($url){
	  //maybe we should add the method to the config. Some servers have curl, some have this method:
	  include("config.php");
	  $request_options = array(
	       "referer" => "http://iRail.be/",
	       "timeout" => "30",
	       "useragent" => $iRailAgent
	       );
	  $post = http_post_data($url, "", $request_options) or die("");
	  return http_parse_message($post)->body;
     }     
}
?>