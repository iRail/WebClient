<?
//let's first create some helpfunctions so we can output the json more easily
function formatDuration($dur){
     $i = $dur/60%60;
     $h = floor($dur/3600);
     if($i<10){
	  $i = "0" . $i;
     }
     return  $h.":".$i;
}

function formatDelay($del){    
     if($del>0){
		$min = $del/60;
		if($min > 60){
			$aantalH = floor($min / 60);
			$min = $min % 60;
			return "+" . $aantalH .":". $min;
		}
		return"+" . $min;
     }
     return "/";
}

function formatDate($time){
     return date("d/m/Y",$time);
}

function formatTime($time){
     return date("H:i",$time);
}

if(isset($_GET["refresh"])){
	if(isset($_GET["destination"])){
		header('Location: /board/'.$_GET['station'].'/'.$_GET['destination']. '/');				
	}else{
		header('Location: /board/'.$_GET['station'].'/');				
	}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="apple-mobile-web-app-capable"  content="yes" />
	<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.6, user-scalable=no" />
        <meta name="keywords" content="nmbs, sncb, iphone, mobile, irail, irail.be, route planner"/>
        <meta name="description" content="NMBS/SNCB mobile iPhone train route planner."/>
        <title>iRail.be</title>
        <link rel="shortcut icon" href="/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="/templates/iRail/css/main.css" />
        <script src="/templates/iRail/js/main.js"></script>
    </head>
    <body>
	<div class="MainContainer">
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
		<div class="boardHeaderBoard">
		    <div class="containerSubMenuBtn">
                <div class="centerDivBtn">
					<form method="get" action="">
						<input class="gradientBtnLogin BtnRefresh" type="submit" name="refresh" id="refresh" value="<?=$i18n["refreshBoard"] ?>"/>
					</form>
                </div>
            </div>
				<p style="padding-left: 5px;padding-top:10px;">
				<?=$content["station"]?><br>
				<?
     if(isset($_GET["destination"])){
						echo "<img src=\"/templates/iRail/images/arrowRoute.png\" alt=\"arrow\"/>&nbsp;" . $_GET["destination"];
					}
				?>
				</p>
		</div>
		<div class="boardContainer">
			<?
			$styleBoardInfo = "boardInfo";
			if($content["departures"]["number"] == 0){
				?>
				<div class="<? echo $styleBoardInfo; ?>">
					<?=$i18n["ErrNoResults"] ?>
				</div>
				<?
			}
			for($i = 0; $i < $content["departures"]["number"]; $i++){
				$departures = $content["departures"];
				$departure = $departures["departure"][$i];
			?>
			<div class="<? echo $styleBoardInfo; ?>">
				<div class="boardPlatform"><div class="platformStyle"><? if($departure["platform"] == ""){ echo "-"; }else{ echo $departure["platform"];}  ?></div></div>
				<div class="boardDelay"><? if($departure["delay"] != "0"){ echo formatDelay($departure["delay"]);}  ?></div>
				<div class="boardTime"><?=formatTime($departure["time"]) ?></div>
				<div class="boardStation"><?=$departure["station"] ?></div>
			</div>
			<?
				if($styleBoardInfo == "boardInfo"){
					$styleBoardInfo = "boardInfoBackColorGrey";
				}else{
					$styleBoardInfo = "boardInfo";
				}
			}
			
			$timestampPlus = date("Hi", mktime(date("H")+1 ,date("i"), 0, 0 ,0 , 0));
			$timestampMin = date("Hi", mktime(date("H")-1 ,date("i"), 0, 0 ,0 , 0));
			
			function curPageURL() {
			 $pageURL = 'http';
			 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			 $pageURL .= "://";
			 if ($_SERVER["SERVER_PORT"] != "80") {
			  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
			 } else {
			  $pageURL .= $_SERVER["SERVER_NAME"];
			 }
			 return $pageURL;
			}	
			
			if($_GET["station"] != ""){
				$req = $_GET["station"];
				if($_GET["destination"] != ""){
					$req .= "/" . $_GET["destination"];
				}
			}
			
			if(isset($_GET["time"])){
				$datum = date("H", strtotime($_GET["time"]));
				if($_GET["d"] == "min"){
					if($datum == "00") { $datum = 24; };
				}
				$timestampMin = $datum - 1;
				$timestampMin .= "00";
				$timestampPlus = $datum + 1;
				$timestampPlus .= "00";
				$timestampMin = sprintf("%04d", $timestampMin);
				$timestampPlus = sprintf("%04d", $timestampPlus);
				if((int)$timestampMin == 2400){
					$timestampMin = 0;
					$timestampMin = sprintf("%04d", (int)$timestampMin);
				}
				if((int)$timestampPlus == 2400){
					$timestampPlus = 0;
					$timestampPlus = sprintf("%04d", (int)$timestampPlus);
				}
			}
			?>
			<div class="routeBottomBtnContainerBoard">
				<a href="<? $adr = curPageURL(); echo $adr . "/board/" . $req ."/?time=" . $timestampMin . "&d=min"; ?>"><div class="routeBottomBtnBoard textShadow"><p><img style="vertical-align: middle;" height="16" width="9" alt="left" src="/templates/iRail/images/left.png"> <?=$i18n["rideEarlier"] ?></p></div></a>
				<a href="<? $adr = curPageURL(); echo $adr . "/board/" . $req ."/?time=" . $timestampPlus . "&d=plus"; ?>"><div class="routeBottomBtnBoard textShadow"><p><?=$i18n["rideLater"] ?> <img style="vertical-align: middle;" height="16" width="9" alt="left" src="/templates/iRail/images/right.png"></p></div>
			</div>
		</div>
	</div>
		<? include_once("templates/iRail/footer.php"); ?>
	</body>
</html>
