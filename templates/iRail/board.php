<?
if($_GET['from']){
	if($_GET["to"] != ""){
		header( 'Location: /board/'.$_GET['from'].'/'.$_GET['to'].'/');			
	}else{
		header( 'Location: /board/'.$_GET['from'].'/');					
	}
}
?>
<!DOCTYPE html>
<html lang="en">    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width; height=device-height; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
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
                <a href="/route/"><div class="bannerCubeContainerFixed gradientBanner"><?=$i18n["route"] ?></div></a>
                <a href="/board/"><div class="bannerCubeContainerFixed bannerLinkActive removeBorderLeft"><?=$i18n["board"] ?></div></a>
                <a href="/settings/"><div class="bannerCubeContainerFixedSettings gradientBanner"><img src="/templates/iRail/images/settings.png" alt="set" height="39" width="38"/></div></a>
                <div class="bannerCubeContainerScaleFill gradientBanner"></div>
            </div>
            <div class="searchContainer">
                <div class="containerFrom">
                    <div class="fillDotLeft"></div>
                    <div class="fillDotRight"></div>
                    <div class="listButton">
                        <div class="buttonFav"><a href="/stations/"><img src="/templates/iRail/images/fav.png" alt="favorite" width="40" height="25" class="floatRight"/></a></div>
                    </div>
                    <div class="fromHeader"><?=$i18n["of"] ?></div>
                </div>
                <div class="inputFrom">
                    <input autocomplete="off" onKeyPress="return disableEnterKey(event)" onkeyup="autoComplete('from', event); changeActiveAutoCompletion('from', event)" class="inputStyle" type="text" id="from" name="from"/>
					<div id="autoCmpletefrom" class="autoCmpletefrom">
                    </div>
				</div>
                <div class="inputChange"><img class="pointer" src="/templates/iRail/images/change.png" onclick="swap_From_To()" alt="change" width="25" height="30"/></div>
                <div class="inputMid"></div>
                <div class="toHeader"><?=$i18n["to_optional"] ?></div>
                <div class="inputTo">
                    <input autocomplete="off" onKeyPress="return disableEnterKey(event)" onkeyup="autoComplete('to', event); changeActiveAutoCompletion('to', event)" class="inputStyle" type="text" id="to" name="to"/>
                    <div id="autoCmpleteto" class="autoCmpleteto">
                    </div>               
			   </div>

            </div>
            <div class="subMenuContainer">
                <div class="containerSubMenuBtn">
                    <div class="centerDivBtn">
                        <input class="gradientBtnSearch Btn" type="submit" name="search" id="search" value="<?=$i18n["show_live_board"] ?>"/>
                    </div>
						<?
							if($_GET["search"]){
								if($_GET["from"]){
									
								}else{
									print "<p style=\"padding: 10px; color: #FFFFFF;\">". $i18n["errSubmitBoard"] . "</p>";
								}
							}
						?>
                </div>
            </div>
		</form>
        </div>
    </body>
</html>
