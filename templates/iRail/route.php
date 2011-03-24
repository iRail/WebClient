<?
	if($_GET['to'] != "" && $_GET['from'] != ""){
		$dYEAR = substr($_GET['y'],-2);
		header( 'Location: http://muhammet.irail.be/route/'.$_GET['from'].'/'.$_GET['to'].'/?time='. $_GET['h'] .''. $_GET['m'] . '&date=' . $_GET['d'] .''. $_GET['mo'] .''. $dYEAR . '&direction=' . $_GET["direction"]);			
	}
?>
<!DOCTYPE html>
<html lang="en" manifest="appcache.mf">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width:device-width; height:device-height; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
        <meta name="keywords" content="nmbs, sncb, iphone, mobile, irail, irail.be, route planner"/>
        <meta name="description" content="NMBS/SNCB mobile iPhone train route planner."/>
        <title>iRail.be</title>
        <link rel="shortcut icon" href="/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="/templates/iRail/css/main.css" />
        <script>
      var stations= [<? foreach($content["station"] as $station){
	   echo "\"" . $station["name"] . "\",";
      } ?>];
        </script>
        <script src="/templates/iRail/js/main.js"></script>
    </head>
    <body onclick="removeAllHolders()" class="bckgroundDarkGrey">
        <div class="MainContainer">
		<form method="get" action="">
            <div class="bannerContainer">
                <div class="bannerCubeContainerFixedLogo gradient">
                    <div class="Top">iRail</div>
                    <div class="Bot">
                        <div class="blackFlagColor"></div>
                        <div class="yelFlagColor"></div>
                        <div class="redFlagColor"></div>
                    </div>
                </div>
                <a href="/route/"><div class="bannerCubeContainerFixed bannerLinkActive"><?=$i18n["route"] ?></div></a>
                <a href="/board/"><div class="bannerCubeContainerFixed gradientBanner removeBorderLeft"><?=$i18n["board"] ?></div></a>
                <a href="/settings/"><div class="bannerCubeContainerFixedSettings gradientBanner"><?=$i18n["settings"] ?></div></a>
                <div class="bannerCubeContainerScaleFill gradientBanner"></div>
            </div>
            <div class="searchContainer">
                <div class="containerFrom">
                    <div class="fillDotLeft"></div>
                    <div class="fillDotRight"></div>
                    <div class="listButton">
                        <div class="buttonFav"><a href="/stations/"><img src="/templates/iRail/images/fav.png" alt="<?=$i18n["favourite"] ?>" width="40" height="25" class="floatRight"/></a></div>
                    </div>
                    <div class="fromHeader"><?=$i18n["from"] ?></div>
                </div>
                <div class="inputFrom">
                    <input autocomplete="off" value="" class="inputStyle" value="<?=$_GET["from"] ?>" onKeyPress="return disableEnterKey(event)" onkeyup="autoComplete('from', event)" type="text" id="from" name="from"/>
                    <div id="autoCmpletefrom" class="autoCmpletefrom">
                    </div>
                </div>
                <div class="inputChange"><img class="pointer" src="/templates/iRail/images/change.png" onclick="swap_From_To()" alt="favorite" width="25" height="30"/></div>
                <div class="inputMid"></div>
                <div class="toHeader"><?=$i18n["to"] ?></div>
                <div class="inputTo">
                    <input autocomplete="off" value="" class="inputStyle" value="<?=$_GET["to"] ?>" onKeyPress="return disableEnterKey(event)" onkeyup="autoComplete('to', event)" type="text" id="to" name="to"/>
                    <div id="autoCmpleteto" class="autoCmpleteto">
                    </div>
                </div>
            </div>
            <div class="subMenuContainer">
                <div class="containerMenu">
                    <div class="containerButtons">
                        <div id="arrAt" class="buttonL buttonActive"><div class="subMenuBtnText"><Input class="hideRadioBtn" type = 'Radio' Name ='direction' id="arrive" value="arrive" CHECKED /><label onclick="changeActive('arrive')" for="arrive"><?=$i18n["arrival_at"] ?></label></div></div>
                        <div id="deprtAt" class="buttonR"><div class="subMenuBtnText"><Input class="hideRadioBtn" type = 'Radio' Name ='direction' id="depart" value="depart" /><label onclick="changeActive('depart')" for="depart"><?=$i18n["departure_at"] ?></label></div></div>
                    </div>
                </div>
                <div class="containerSubMenuDate">
                    <div class="centerDiv">
                        <select name="d" class="selectFont" id="timeselectd">
                            <?
                            for ($i = 1; $i <= 31; $i++) {
                                if ($i < 10) {
                                    $j = "0" . $i;
                                } else {
                                    $j = $i;
                                }
                                $selected = "";
                                if ($i == date("j")) {
                                    $selected = "selected=\"selected\"";
                                }
                                echo "<option value=\"" . $j . "\" " . $selected . ">" . $j . "</option>";
                            }
                            ?>
                        </select> / <select name="mo" class="selectFont" id="timeselectmo">
                            <?
                            for ($i = 1; $i <= 12; $i++) {
                                if ($i < 10) {
                                    $j = "0" . $i;
                                } else {
                                    $j = $i;
                                }
                                $selected = "";
                                if ($i == date("n")) {
                                    $selected = "selected=\"selected\"";
                                }
                                echo "<option value=\"" . $j . "\" " . $selected . ">" . $j . "</option>";
                            }
                            ?>
                        </select> / <select class="selectFont" name="y">
                            <?
                            $dummy = date("Y") + 1;
                            echo "<option value=\"" . date("Y") . "\">" . date("Y") . "</option>";
                            echo "<option value=\"" . $dummy . "\">" . $dummy . "</option>";
                            ?>
                        </select>
                    </div>
                </div>
                <div class="containerSubMenuTime">
                    <div class="centerDiv">
                        <select name="h" class="selectFont" id="timeselecth">
                            <?
                            for ($i = 0; $i < 24; $i++) {
                                if ($i < 10) {
                                    $j = "0" . $i;
                                } else {
                                    $j = $i;
                                }
                                $selected = "";
                                if ($i == date("H")) {
                                    $selected = "selected=\"selected\"";
                                }
                                echo "<option value=\"" . $j . "\" " . $selected . ">" . $j . "</option>";
                            }
                            ?>
                        </select> : <select name="m" class="selectFont" id="timeselectm">
                            <?
                            for ($i = 0; $i < 6; $i++) {
                                $selected = "";
                                if ($i == floor(date("i") / 10)) {
                                    $selected = "selected=\"selected\"";
                                }
                                if ($i == 0) {
                                    $j = "00";
                                } else {
                                    $j = $i * 10;
                                }
                                echo "<option value=\"" . $j . "\" " . $selected . ">" . $j . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="containerSubMenuBtn">
                    <div class="centerDivBtn">
                        <input class="gradientBtnSearch Btn" type="submit" name="search" id="search" value="<?=$i18n["search"] ?>"/>
                    </div>
                </div>
            </div>
		</form>
        </div>
    </body>
</html>

