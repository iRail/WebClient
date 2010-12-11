<?php
/**
    Copyright 2010-2011 iRail vzw
    Author: Pieter Colpaert (pieter@irail.be - http://bonsansnom.wordpress.com)

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

	source available at http://github.com/iRail/

 */

include_once("Page.php");

class AboutPage extends Page {
     protected function loadContent(){
	  return array();
     }
     
    protected function loadPage() {
        $page = array(
            "title" => "iRail.be",
            "subtitle" => "project.iRail.be"
        );
	return $page;
    }
}

//__MAIN__

$page = new AboutPage();
if(isset($_COOKIE["language"])){
    $page -> setLanguage($_COOKIE["language"]);
}
if(isset($_GET["output"])){
    $page ->setTemplate($_GET["output"]);
}
$page -> buildPage("About");
?>
