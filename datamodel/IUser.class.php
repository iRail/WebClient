<?php
/* Copyright (C) 2011 by iRail vzw/asbl
 *
 * This is part of the DataLayer. Implement this interface to store and load information about your user.
 *
 * Usage:
 * 
 * This class is meant to store 
 *
 * @author Pieter Colpaert
 * @license aGPL
 * @package datamodel
 */

interface IUser{
     public function getFavRoutes();
     public function getFavBoards();
     public function getUsedBoards();
     public function getUsedRoutes();
     public function getLang();

     public function addFavRoute($from,$to);
     public function addFavBoard($of,$to);
     public function addUsedBoard($of,$to);
     public function addUsedRoute($from,$to);
     public function setLang($lang);
}

?>