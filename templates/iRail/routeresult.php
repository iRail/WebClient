<?
$date = str_split($_GET["date"], 2);
$time = str_split($_GET["time"], 2);
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
     if($i<10){
	  $i = "0" . $i;
     }
     return  $h.":".$i;
}

function formatDelay($del){    
     if($del>0){
	  return"+" . $del/60;
     }
     return "";
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
<html lang="en">
    <head>
        <meta name="apple-mobile-web-app-capable"  content="yes" />
	<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.6, user-scalable=no" />
        <meta name="keywords" content="nmbs, sncb, iphone, mobile, irail, irail.be, route planner"/>
        <meta name="description" content="NMBS/SNCB mobile iPhone train route planner."/>
        <title>iRail.be</title>
        <link rel="shortcut icon" href="/favicon.ico"/>
        <link rel="stylesheet" href="/templates/iRail/css/main.css" />
        <script src="/templates/iRail/js/main.js"></script>
    </head>
    <body>
	<div class="MainContainer">
	<form action="" method="GET" name="formResults">
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
		<div class="routeContainer">
			<div class="routeHeader">
				<p>
				
				<?=$content["connection"][0]["departure"]["station"]?><br>
				<img src="/templates/iRail/images/arrowRoute.png" alt="arrow"/>&nbsp;<?=$content["connection"][0]["arrival"]["station"]?>
				</p>
				<input type="text" value="<? if(isset($_GET["direction"])) echo $_GET["direction"]; ?>" style="display: none; position: relative;" name="hiddenDirection" id="hiddenDirection"/>
				<div onclick="formResults.submit()" class="routeHeaderAddFavBtn"></div>
				<div style="margin: 5px 0px 0px 125px; font-weight: normal;">
					<?
						print date('d F Y', $content["connection"][0]["departure"]["time"]);
					?>
				</div>
			</div>
			
			<?
			if(sizeof($content["connection"]) == 0){
				print $i18n["ErrNoResults"];
			}else{
			foreach($content["connection"] as $connection){
			?>
			<!-- START: Class routeCube will be multiplied by x quantity of steps passenger has to take to reach destination -->
			<div class="routeCube routeBlackStations" id="routeCube" onclick="fold(this)">
				<div class="routeCubeHeader">
					<div class="routeCubeLeft">
						<?
						$lengte = sizeof($connection["vias"]);
						print formatTime($connection["departure"]["time"]);
						print  "<img src=\"/templates/iRail/images/treinVervoer.png\" alt=\"arrow\" style=\"padding-left:10px;vertical-align:text-bottom;\"/>";						
						print  "<img src=\"/templates/iRail/images/arrowRouteSmall.jpg\" alt=\"arrow\" style=\"padding-left:10px;padding-right:10px;\"/>";
						
						if($lengte != 1){
							for($i = 1; $i <= $lengte;$i++){
								print  "<img src=\"/templates/iRail/images/treinVervoer.png\" alt=\"arrow\" style=\"vertical-align:text-bottom;\"/>";
								print  "<img src=\"/templates/iRail/images/arrowRouteSmall.jpg\" alt=\"arrow\" style=\"padding-left:10px;padding-right:10px;\"/>";
							}						
						}
						print  "<img src=\"/templates/iRail/images/treinVervoer.png\" alt=\"arrow\" style=\"vertical-align:text-bottom;padding-right:10px;\"/>" . formatTime($connection["arrival"]["time"]);						
						?>
					</div>
					<div class="routeCubeRight">
						| <?=formatDuration($connection["duration"])?> |
					</div>
					<div class="infoRouteRightDelay">
						<?=formatDelay($connection["departure"]["delay"])?>
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
							<?=$connection["departure"]["station"]?>
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
							<?=formatVehicle($connection["arrival"]["vehicle"])?> <span class="routeSmallerFont"><?=$connection["arrival"]["direction"]["name"]?></span>
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
							<?=$connection["arrival"]["station"]?>
						</div>
					</div>
				</div>
				</div>
			</div>
			<!-- END -->
			<?
			}
			}
			?>
			
			<div class="routeBottomBtnContainer">
				<a href="<? echo "/route/" . $content["connection"][0]["departure"]["station"] . "/" . $content["connection"][0]["arrival"]["station"] ."/?time=" . date("Hi",$content["connection"][0]["departure"]["time"]) . "&date=" . date("dmy",$content["connection"][0]["departure"]["time"]) . "&direction=arrive" ?>"><div class="routeBottomBtn textShadow"><p><img style="vertical-align: middle;" height="16" width="9" alt="left" src="/templates/iRail/images/left.png"> <?=$i18n["rideEarlier"] ?></p></div></a>
				<a href="<? echo "/route/" . $content["connection"][0]["departure"]["station"] . "/" . $content["connection"][0]["arrival"]["station"] ."/?time=" . date("Hi",$content["connection"][sizeof($content["connection"])-1]["departure"]["time"]) . "&date=" . date("dmy",$content["connection"][sizeof($content["connection"])-1]["departure"]["time"]) . "&direction=depart"?>"><div class="routeBottomBtn textShadow"><p><?=$i18n["rideLater"] ?> <img style="vertical-align: middle;" height="16" width="9" alt="left" src="/templates/iRail/images/right.png"></p></div>
			</div>
		</form>
		</div>
	</div>
<? include_once("templates/iRail/footer.php"); ?>
	</body>
</html>
