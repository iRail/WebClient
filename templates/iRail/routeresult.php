<?
function formatDateFav($time){
     return date("dmy",$time);
}

function formatTimeFav($time){
     return date("Hi",$time);
}

if(isset($_GET["hiddenDirection"])){ 
		$this->user->addFavRoute($content["connection"][0]["departure"]["station"],$content["connection"][0]["arrival"]["station"]);
		header( 'Location: /route/'.$content["connection"][0]["departure"]["station"].'/'.$content["connection"][0]["arrival"]["station"].'/?time='. formatTimeFav($content["connection"][0]["departure"]["time"]) . '&date=' .formatDateFav($content["connection"][0]["departure"]["time"]) .'&direction=' . $_GET["hiddenDirection"]);	
}



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

function formatVehicle($veh){
	$arrVehicle = explode(".", $veh);
	return $arrVehicle[2];
}

function trainMoveFormat($time){
     return date("Hi",$time);
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
	<form action="" method="GET" name="formResults">
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
		<div class="routeContainer">
			<div class="routeHeader">
				<p>
				<?=$content["connection"][0]["departure"]["station"]?><br>
				<img src="/templates/iRail/images/arrowRoute.png" alt="arrow"/><?=$content["connection"][0]["arrival"]["station"]?>
				</p>
				<input type="text" value="<?=$_GET["direction"] ?>" style="display: none; position: relative;" name="hiddenDirection" id="hiddenDirection"/>
				<div onclick="formResults.submit()" class="routeHeaderAddFavBtn"></div>
			</div>
			
			<?
			foreach($content["connection"] as $connection){
			?>
			<!-- START: Class routeCube will be multiplied by x quantity of steps passenger has to take to reach destination -->
			<div class="routeCube routeBlackStations" id="routeCube" onclick="fold(this)">
				<div class="routeCubeHeader">
					<div class="routeCubeLeft">
						<? print formatTime($connection["departure"]["time"]) . "<img src=\"/templates/iRail/images/arrowRouteSmall.jpg\" alt=\"arrow\" style=\"padding-left:10px;padding-right:10px;\"/><img src=\"/templates/iRail/images/arrowRouteSmall.jpg\" alt=\"arrow\" style=\"padding-right:10px;\"/>" . formatTime($connection["arrival"]["time"]); ?>
					</div>
					<div class="routeCubeRight">
						| <?=formatDuration($connection["duration"])?> |
					</div>
				</div>
				<div class="routeCubeInfo" id="routeCubeInfo" style="visibility: hidden; position: absolute;">
					<div class="infoRouteContainer">
						<div class="infoRouteLeft routeBlueTime">
							<?=formatTime($connection["departure"]["time"]); ?>
						</div>
						<div class="infoRouteRight">
							<div class="platformStyle"><? if(is_numeric($connection["departure"]["platform"])){ echo $connection["departure"]["platform"];}else{ echo "-";} ?></div>
						</div>
						<div class="infoRouteMid routeRedStations">
							<?=$content["connection"][0]["departure"]["station"]?>
						</div>
					</div>


					
					<?
					if(isset($connection["vias"])){
					?>
						<?
						foreach($connection["vias"]["via"] as $via){
						?>	
						<!-- MID -->
						
						<div class="infoRouteContainer">
							<div class="infoRouteLeft">
								↓
							</div>
							<div class="infoRouteMid">
								<?=formatVehicle($via["vehicle"])?> <span class="routeSmallerFont"><?=$via["direction"]["name"]?></span>
							</div>
						</div>
						
						<div class="infoRouteContainer">
							<div class="infoRouteLeft">
								<?=formatTime($via["departure"]["time"]); ?>
							</div>
							<div class="infoRouteRight">
								<div class="platformStyle"><? if(is_numeric($via["departure"]["platform"])){ echo $connection["departure"]["platform"];}else{ echo "-";} ?></div>
							</div>
							<div class="infoRouteMid routeRedStations">
								<?=$via["stationinfo"]["name"]?>
							</div>
						</div>	
						<?
						}
						?>
					<?
					}
					?>
					<!-- arrival -->

					<div class="infoRouteContainer">
						<div class="infoRouteLeft">
							↓
						</div>
						<div class="infoRouteMid">
							<?=formatVehicle($content["connection"][0]["arrival"]["vehicle"])?> <span class="routeSmallerFont"><?=$content["connection"][0]["arrival"]["direction"]["name"]?></span>
						</div>
					</div>
					
					<div class="infoRouteContainer">
						<div class="infoRouteLeft routeBlueTime">
							<?=formatTime($connection["arrival"]["time"]); ?>
						</div>
						<div class="infoRouteRight">
							<div class="platformStyle"><? if(is_numeric($connection["arrival"]["platform"])){ echo $connection["arrival"]["platform"];}else{ echo "-";} ?></div>
						</div>
						<div class="infoRouteMid routeRedStations">
							<?=$content["connection"][0]["arrival"]["station"]?>
						</div>
					</div>
				</div>
				</div>
			</div>
			<!-- END -->
			<?
			}
			?>
			
			<div class="routeBottomBtnContainer">
				<!-- Ride later sets the new depart hour to the old arrival hour, and ride ealier is not working yet, need some help here-->
				<div class="routeBottomBtn textShadow"><p><a href="<? echo "/route/" . $content["connection"][0]["departure"]["station"] . "/" . $content["connection"][0]["arrival"]["station"] ."/?time=" . trainMoveFormat($connection["departure"]["time"]) . "&date=" . $_GET["date"] . "&direction=" . $_GET["direction"]; ?>"><strong><</strong> <?=$i18n["rideEarlier"] ?></a></p></div>
				<div class="routeBottomBtn textShadow"><p><a href="<? echo "/route/" . $content["connection"][0]["departure"]["station"] . "/" . $content["connection"][0]["arrival"]["station"] ."/?time=" . trainMoveFormat($connection["arrival"]["time"]) . "&date=" . $_GET["date"] . "&direction=" . $_GET["direction"]; ?>"><?=$i18n["rideLater"] ?> <strong>></strong></a></p></div>
			</div>
		</form>
		</div>
	</div>
	</body>
</html>
