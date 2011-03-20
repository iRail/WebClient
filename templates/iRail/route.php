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
            <div class="bannerContainer">
                <div class="bannerCubeContainerFixedLogo gradient">
                    <div class="Top">iRail</div>
                    <div class="Bot">
                        <div class="blackFlagColor"></div>
                        <div class="yelFlagColor"></div>
                        <div class="redFlagColor"></div>
                    </div>
                </div>
                <a href="/route/"><div class="bannerCubeContainerFixed bannerLinkActive">Route</div></a>
                <a href="/board/"><div class="bannerCubeContainerFixed gradientBanner removeBorderLeft">Board</div></a>
                <a href="/settings/"><div class="bannerCubeContainerFixedSettings gradientBanner">Settings</div></a>
                <div class="bannerCubeContainerScaleFill gradientBanner"></div>
            </div>
            <div class="searchContainer">
                <div class="containerFrom">
                    <div class="fillDotLeft"></div>
                    <div class="fillDotRight"></div>
                    <div class="listButton">
                        <div class="buttonFav"><a href="/stations/"><img src="/templates/iRail/images/fav.png" alt="favorite" width="40" height="25" class="floatRight"/></a></div>
                    </div>
                    <div class="fromHeader">From</div>
                </div>
                <div class="inputFrom">
                    <input class="inputStyle" onkeyup="autoComplete('from')" type="text" id="from" name="from"/>
                    <div id="autoCmpletefrom" class="autoCmpletefrom">
                    </div>
                </div>
                <div class="inputChange"><img class="pointer" src="/templates/iRail/images/change.png" onclick="swap_From_To()" alt="favorite" width="25" height="30"/></div>
                <div class="inputMid"></div>
                <div class="toHeader">To</div>
                <div class="inputTo">
                    <input class="inputStyle" onkeyup="autoComplete('to')" type="text" id="to" name="to"/>
                    <div id="autoCmpleteto" class="autoCmpleteto">
                    </div>
                </div>
            </div>
            <div class="subMenuContainer">
                <div class="containerMenu">
                    <div class="containerButtons">
                        <div id="arrAt" onclick="changeActive('arrive')" class="buttonActive buttonL"><div class="subMenuBtnText">Arrive at</div></div>
                        <div id="deprtAt" onclick="changeActive('depart')" class="buttonR"><div class="subMenuBtnText">Depart at</div></div>
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
                        <input class="gradientBtnSearch Btn" type="button" name="search" id="search" value="Search route"/>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
