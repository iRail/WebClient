<?
//let's first create some helpfunctions so we can output the json more easily
function formatDuration($dur){
     $i = $dur/60%60;
     $h = floor($dur/3600);
     //    if($h < 10){ // don't do this. too much zeros
     //	  $h = "0" . $h;
     //   }
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
			return"+" . $aantalH .":". $min;
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
    <body>
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
                <a href="/route/"><div class="bannerCubeContainerFixed gradientBanner"><?=$i18n["route"] ?></div></a>
                <a href="/board/"><div class="bannerCubeContainerFixed bannerLinkActive removeBorderLeft"><?=$i18n["board"] ?></div></a>
                <a href="/settings/"><div class="bannerCubeContainerFixedSettings gradientBanner"><?=$i18n["settings"] ?></div></a>
                <div class="bannerCubeContainerScaleFill gradientBanner"></div>
		</div>
		<div class="boardContainer">
			<?
			$styleBoardInfo = "boardInfo";
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
			?>
		</div>
	</div>
	</body>
</html>
