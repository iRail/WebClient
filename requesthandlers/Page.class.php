<?php
  /* Copyright (C) 2011 by iRail vzw/asbl
   *
   * This is the start of all pages. It uses the template design pattern to
   * create the page: it will need a template and language chosen by the user.
   *
   * Usage:
   * 
   * If you want to use this class you need to override it into a new class, preferably from the page where you're going to start
   *
   * @author Pieter Colpaert
   * @license aGPL
   */

abstract class Page {

     //CONFIGURATION OF THIS CLASS
     protected $AVAILABLE_TEMPLATES = array("iRail");
     protected $AVAILABLE_LANGUAGES = array("EN", "NL", "FR", "DE");
     private $detectLanguage = false;

     //DON'T TOUCH
     private $template = "iRail";
     private $lang = "EN";
     private $pageName = "index";

     /**
      * Function is used for API Requests
      * @return array will return an associative array of page specific variables.
      */
     protected abstract function loadContent();

     public function buildPage($pageName) {
	  if ($this->detectLanguage) {
	       $this->detectLanguage();
	  }
	  try{
	       $content = $this->loadContent();
	       $globals = $this->loadGlobals();
	       $i18n = $this->loadI18n();
	       include("templates/" . $this->template . "/" . $pageName . ".php");
	  }catch(Exception $e){
	       $this->buildError($lang, $pageName, $e);
	  }
     }

     public function setDetectLanguage($bool) {
	  $this->detectLanguage = $bool;
     }

     private function detectLanguage() {
	  if (isset($_COOKIE["language"])) {
	       $this->setLanguage($_COOKIE["language"]);
	  }else if(in_array(strtoupper(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2)), $this->AVAILABLE_LANGUAGES)){
	       $this->setLanguage(strtoupper(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2)));
	  }else{
	       $this->setLanguage("EN");
	  }
	  if (isset($_GET["lang"])) {
	       $this->setLanguage($_GET["lang"]);
	       setcookie("language", $_GET["lang"], time() + 60 * 60 * 24 * 360);
	  }
     }

     private function loadGlobals() {
	  $globals =array();
//	 $globals["GoogleAnalytics"] = file_get_contents("includes/googleAnalytics.php");
//	 $globals["footer"] = file_get_contents("includes/footer.php");
	  $globals["iRail"] = "iRail";
	  return $globals;
     }

     public function setTemplate($template) {
	  if (in_array($template, $this->AVAILABLE_TEMPLATES)) {
	       $this->template = $template;
	  }else{
	       throw new Exception("template doesn't exist");
	  }
     }

     public function setLanguage($lang) {
	  if (in_array($lang, $this->AVAILABLE_LANGUAGES)) {
	       $this->lang = $lang;
	  }else{
	       throw new Exception("language doesn't exist");
	  }
     }

     private function loadI18n() {
	  if(in_array($this->lang,$this->AVAILABLE_LANGUAGES)){
	       include_once("i18n/". strtoupper($this->lang) . ".php");
	  }
	  if ($this->lang == "EN") {
	       include_once("i18n/EN.php");
	  } else if ($this->lang == "NL") {
	       include_once("i18n/NL.php");
	  } else if ($this->lang == "FR") {
	       include_once("i18n/FR.php");
	  } else if ($this->lang == "DE") {
	       include_once("i18n/DE.php");
	  }
	  return $i18n;
     }

     public function getLang() {
	  return $this->lang;
     }

     public function buildError($lang, $pageName, $e){
	  //1. TODO: Of course we'll need to log the error first in a file

	  //2. We'll return a nice error page to our users so they are not getting too frustrated - TODO: better solution for this
	  header("Location: http://iRail.be/oops");
     }
  }
?>
