<?
if(isset($_GET['from'])){
     header_remove();
     if(isset($_GET["to"]) && $_GET["to"] != ""){
		header('Location: /board/'.$_GET['from'].'/'.$_GET['to'].'/');			
	}else{
		header('Location: /board/'.$_GET['from'].'/');					
	}
}
?>
<!DOCTYPE html>
<html lang="en" appcache="/appcache.mf">    
    <head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.6, user-scalable=no" />
        <meta name="keywords" content="nmbs, sncb, iphone, mobile, irail, irail.be, route planner"/>
        <meta name="description" content="NMBS/SNCB mobile iPhone train route planner."/>
	<!-- as not every OS supports HTML-less icon detection, provide this in details, and link to imgage dir instead of root -->
	<!-- 1. iPhone 4/retina --> 
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="./templates/iRail/images/apple-touch-icon-114x114-precomposed.png">
	<!-- iPad G1 -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="./templates/iRail/images/apple-touch-icon-72x72-precomposed.png">
	<!-- non-retina iPhone, iPod Touch, Android 2.1+ -->
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="./templates/iRail/images/apple-touch-57x57-icon-precomposed.png">
	<!-- everything else, provider higher resolution img -->
	<link rel="apple-touch-icon-precomposed" href="./templates/iRail/images/apple-touch-icon-precomposed.png">
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
                <div class="bannerCubeContainerFixedLogo gradient" style="cursor: pointer;" onclick="window.location='/'">
                    <div class="Top">iRail</div>
                    <div class="Bot">
                        <div class="blackFlagColor"></div>
                        <div class="yelFlagColor"></div>
                        <div class="redFlagColor"></div>
                    </div>
                </div>
                <a href="/route/"><div class="bannerCubeContainerFixed gradientBanner"><?=$i18n["route"] ?></div></a>
                <a href="/board/"><div class="bannerCubeContainerFixed bannerLinkActive removeBorderLeft"><?=$i18n["board"] ?></div></a>
                <a href="/settings/"><div class="bannerCubeContainerFixedSettings gradientBanner"><img style="margin-top: 15px;" src="/templates/iRail/images/settings.png" alt="set" height="18" width="14"/></div></a>
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
<?
$last = $this->user->getLastUsedBoard();
$lastof = $last["of"];
$lastto = $last["to"];
?>
                <div class="inputFrom">
                    <input autocomplete="off" onKeyPress="return disableEnterKey(event)" onkeyup="autoComplete('from', event); changeActiveAutoCompletion('from', event)" class="inputStyle" type="text" id="from" name="from" value="<?=$last["of"]?>"/>
					<div id="autoCmpletefrom" class="autoCmpletefrom">
                    </div>
				</div>
                <div class="inputChange"><img class="pointer" src="/templates/iRail/images/change.png" onclick="swap_From_To()" alt="change" width="25" height="30"/></div>
                <div class="inputMid"></div>
                <div class="toHeader"><?=$i18n["to_optional"] ?></div>
                <div class="inputTo">
                    <input autocomplete="off" onKeyPress="return disableEnterKey(event)" onkeyup="autoComplete('to', event); changeActiveAutoCompletion('to', event)" class="inputStyle" type="text" id="to" name="to" value="<?=$last["to"]?>"/>
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
     if(isset($_GET["search"]) && !$_GET["from"]){
	  print "<p style=\"padding: 10px; color: #FFFFFF;\">". $i18n["errSubmitBoard"] . "</p>";
     }
?>
                </div>
            </div>
		</form>
        </div>
		<? include_once("templates/iRail/footer.php"); ?>
    </body>
</html>
