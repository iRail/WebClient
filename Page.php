<?php

/**
 * This is the start of all pages. It uses the template design pattern to
 * create the page: it will need a template and language chosen by the user.
 *
 * @author pieterc
 * @copyright iRail vzw 2010, 2011
 * @license GPL v3+
 */

abstract class Page {

    //CONFIG PART
    protected $AVAILABLE_TEMPLATES = array("iRail");
    protected $AVAILABLE_LANGUAGES = array("EN", "NL", "FR", "DE");
    private $detectLanguageAndTemplate = false;

    //DON'T TOUCH
    private $template = "iRail";
    private $lang = "EN";
    private $pageName = "index";


   /**
    * @return array will return an associative array of page specific variables.
    */
    protected abstract function loadContent();

/**
 * @return array will return an assoc array
 */    
    protected abstract function loadPage();

    public function buildPage($pageName) {
        if ($this->detectLanguageAndTemplate) {
            $this->detectLanguageAndTemplate();
        }
//variables to be used in the template
	$page = $this -> loadPage();
	$content = $this->loadContent();
        $globals = $this->loadGlobals();
        $i18n = $this->loadI18n();
	include("templates/" . $this->template . "/" . $pageName . ".php");
    }

    public function setDetectLanguageAndTemplate($bool) {
        $this->detectLanguageAndTemplate = $bool;
    }

    private function detectLanguageAndTemplate() {
        if (isset($_COOKIE["language"])) {
            $this->setLanguage($_COOKIE["language"]);
        }else if(in_array(strtoupper(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2)), $this->AVAILABLE_LANGUAGES)){
            $this->setLanguage(strtoupper($_SERVER['HTTP_ACCEPT_LANGUAGE']));
        }else{
            $this->setLanguage("EN");
        }
        if (isset($_GET["lang"])) {
            $this->setLanguage($_GET["lang"]);
            setcookie("language", $_GET["lang"], time() + 60 * 60 * 24 * 360);
        }
        if (isset($_COOKIE["output"])) {
            $this->setTemplate($_COOKIE["output"]);
        }
        if (isset($_GET["output"])) {
            $this->setTemplate($_GET["output"]);
            setcookie("output", $_GET["output"], time() + 60 * 60 * 24 * 360);
        }
    }

    private function loadGlobals() {
	 $globals =array();
	 $globals["GoogleAnalytics"] = file_get_contents("includes/googleAnalytics.php");
	 $globals["footer"] = file_get_contents("includes/footer.php");
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

}
?>
