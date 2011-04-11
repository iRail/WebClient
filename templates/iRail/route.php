<?
//this piece of code will format the url correctly and redirect us to the right URL
if(isset($_GET['to']) && isset($_GET['from']) && $_GET['to'] != "" && $_GET['from'] != ""){
		$dYEAR = substr($_GET['y'],-2);
		header_remove();
		header('Location: /route/'.$_GET['from'].'/'.$_GET['to'].'/?time='. $_GET['h'] .''. $_GET['m'] . '&date=' . $_GET['d'] .''. $_GET['mo'] .''. $dYEAR . '&direction=' . $_GET["direction"]);			
	}

//page starts here:
?>
<!DOCTYPE html>
<html manifest="/appcache.mf">
    <head>
	<meta name="apple-mobile-web-app-capable"  content="yes" />
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.6, user-scalable=no" />
        <meta name="keywords" content="nmbs, sncb, iphone, mobile, irail, irail.be, route planner"/>
        <meta name="description" content="NMBS/SNCB mobile iPhone train route planner."/>
        <link rel="stylesheet" href="/templates/iRail/css/main.css" />
	<!-- as not every OS supports HTML-less icon detection, provide this in details, and link to imgage dir instead of root -->
	<!-- 1. iPhone 4/retina --> 
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/templates/iRail/images/apple-touch-icon-114x114-precomposed.png">
	<!-- iPad G1 -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/templates/iRail/images/apple-touch-icon-72x72-precomposed.png">
	<!-- non-retina iPhone, iPod Touch, Android 2.1+ -->
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="/templates/iRail/images/apple-touch-57x57-icon-precomposed.png">
	<!-- everything else, provider higher resolution img -->
	<link rel="apple-touch-icon-precomposed" href="/templates/iRail/images/apple-touch-icon-precomposed.png">
        <title>iRail.be</title>
        <link rel="shortcut icon" href="/favicon.ico"/>
		<script>
		window.addEventListener('load', function(e) {
			  window.applicationCache.update();
		  window.applicationCache.addEventListener('updateready', function(e) {
			if (window.applicationCache.status == window.applicationCache.UPDATEREADY) {
			  window.applicationCache.swapCache();
			window.location.reload();	  
			}
		  }, false);

		}, false);
      var stations= [<? foreach($content["station"] as $station){
	   echo "\"" . $station["name"] . "\",";
      } ?>];

function setDate(){
    var ttt = new Date();
    var curr_day = ttt.getDate() -1; //from 0-30
    var curr_month = ttt.getMonth(); //from 0-11
    var dayelement = document.getElementById('timeselectd');
    var monthelement = document.getElementById('timeselectmo');
    dayelement.item(dayelement.selectIndex).selected = false;
    monthelement.item(monthelement.selectIndex).selected = false;
    dayelement.item(curr_day).selected = true;
    monthelement.item(curr_month).selected = true;
}

		function setTime(h, m){
			var d = new Date();
			var curr_hour = d.getHours();
			var curr_min = d.getMinutes();
		
			var hour = document.getElementById(h);
			var min = document.getElementById(m);
		
			var hourChilds = hour.childNodes;
			var minChilds = min.childNodes;
			
			var hourL = hourChilds.length;
			var minL = minChilds.length;
			
			
			var selIndexHour = hour.selectedIndex;
			var selIndexMin = min.selectedIndex;
			
			
			for(var i = 0; i < hourL; i++){
				if(hourChilds.item(i).value == curr_hour){
					hourChilds.item(i).setAttribute("selected","selected");
				}
			}
			for(var i = 0; i < minL; i++){
				//Set to 10, 20, 30, ...
				curr_min = curr_min / 10.0;
				curr_min = Math.round(curr_min);
				curr_min = curr_min * 10;

				if(minChilds.item(i).value == curr_min){
					minChilds.item(i).setAttribute("selected","selected");
				}
			}
		}

        </script>
        <script src="/templates/iRail/js/main.js"></script>
    </head>
    <body onclick="removeAllHolders()" onload="setTime('timeselecth', 'timeselectm');" class="bckgroundDarkGrey">
        <div class="MainContainer">
		<form method="get" action="">
            <div class="bannerContainer">
                <div class="bannerCubeContainerFixedLogo gradient" style="cursor: pointer;" onclick="window.location='/'">
                    <div class="Top">iRail</div>
                    <div class="Bot">
                        <div class="blackFlagColor"></div>
                        <div class="yelFlagColor"></div>
                        <div class="redFlagColor"></div>
                    </div>
                </div>
                <a href="/route/"><div class="bannerCubeContainerFixed bannerLinkActive"><?=$i18n["route"] ?></div></a>
                <a href="/board/"><div class="bannerCubeContainerFixed gradientBanner removeBorderLeft"><?=$i18n["board"] ?></div></a>
                <a href="/settings/"><div class="bannerCubeContainerFixedSettings gradientBanner"><img style="margin-top: 15px;" src="/templates/iRail/images/settings.png" alt="set" height="18" width="14"/></div></a>
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
<?
$last = $this->user->getLastUsedRoute();
?>
                <div class="inputFrom">
                    <input autocomplete="off" class="inputStyle" onKeyPress="return disableEnterKey(event)" onkeyup="autoComplete('from', event); changeActiveAutoCompletion('from', event)" type="text" id="from" name="from" value="<?=$last["from"]?>" />
                    <div id="autoCmpletefrom" class="autoCmpletefrom">
                    </div>
                </div>
                <div class="inputChange"><img class="pointer" src="/templates/iRail/images/change.png" onclick="swap_From_To()" alt="favorite" width="25" height="30"/></div>
                <div class="inputMid"></div>
                <div class="toHeader"><?=$i18n["to"] ?></div>
                <div class="inputTo">
                    <input autocomplete="off" class="inputStyle" onKeyPress="return disableEnterKey(event)" onkeyup="autoComplete('to', event); changeActiveAutoCompletion('to', event)" type="text" id="to" name="to" value="<?=$last["to"]?>"/>
                    <div id="autoCmpleteto" class="autoCmpleteto">
                    </div>
                </div>
            </div>
            <div class="subMenuContainer">
                <div class="containerMenu">
                    <div class="containerButtons">
						<div id="arrAt" class="buttonL"><div class="subMenuBtnText"><Input class="hideRadioBtn" type = 'Radio' Name ='direction' id="arrive" value="arrive" /><label class="centerMenuRoute" onclick="changeActive('arrive')" for="arrive"><?=$i18n["arrival_at"] ?></label></div></div>
						<div id="deprtAt" class="buttonR buttonActive"><div class="subMenuBtnText"><Input class="hideRadioBtn" type = 'Radio' Name ='direction' id="depart" value="depart" CHECKED /><label class="centerMenuRoute" onclick="changeActive('depart')" for="depart"><?=$i18n["departure_at"] ?></label></div></div>
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
							$dummyPlus = date("Y") + 1;
							$dummyMin= date("Y") - 1;
							if(date("n") == 1){
								 echo "<option value=\"". $dummyMin . "\"  >" . $dummyMin  . "</option>";
							}
							echo "<option value=\"". date("y") . "\" selected=\"selected\" >" . date("Y")  . "</option>";
							if(date("n") == 12){
								 echo "<option value=\"". $dummyPlus . "\">" . $dummyPlus  . "</option>";
							}
                            $dummy = date("Y") + 1;
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
<? include_once("templates/iRail/footer.php"); ?>
    </body>
</html>

