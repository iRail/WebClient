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
	  return"+" . $del/60;
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
		<div class="routeContainer">
			<div class="routeHeader">
				<p>
				<?=$content["connection"][0]["departure"]["station"]?><br>
				<img src="/templates/iRail/images/arrow.gif" width="16" height="16" alt="arrowRight"/><?=$content["connection"][0]["arrival"]["station"]?>
				</p>
				<div class="routeHeaderAddFavBtn"></div>
			</div>
			
			<!-- START: Class routeCube will be multiplied by x quantity of steps passenger has to take to reach destination -->
			<div class="routeCube" id="routeCube" onclick="fold(this)">
				<div class="routeCubeHeader">
					<div class="routeCubeLeft">lol</div>
					<div class="routeCubeRight">lol</div>
				</div>
				<div class="routeCubeInfo" id="routeCubeInfo" style="visibility: hidden; position: absolute;">
				<p>
					It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
				</p>
				</div>
			</div>
			<div class="routeCube" id="routeCube" onclick="fold(this)">
				<div class="routeCubeHeader">
					<div class="routeCubeLeft">lol</div>
					<div class="routeCubeRight">lol</div>
				</div>
				<div class="routeCubeInfo" id="routeCubeInfo" style="visibility: hidden; position: absolute;">
				<p>
					It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
				</p>
				</div>
			</div>
			<!-- END -->
			
			<div class="routeBottomBtnContainer">
				<div class="routeBottomBtn"><p>|< <?=$i18n["earliestRide"] ?></p></div>
				<div class="routeBottomBtn"><p>< <?=$i18n["rideEarlier"] ?></p></div>
				<div class="routeBottomBtn"><p><?=$i18n["rideLater"] ?> ></p></div>
				<div class="routeBottomBtn"><p><?=$i18n["latestRide"] ?> >|</p></div>
			</div>
		</div>
	</body>
</html>
