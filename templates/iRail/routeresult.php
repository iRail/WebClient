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
			<a href="/route/"><div class="bannerCubeContainerFixed bannerLinkActive"><?=$i18n["route"] ?></div></a>
			<a href="/board/"><div class="bannerCubeContainerFixed gradientBanner removeBorderLeft"><?=$i18n["board"] ?></div></a>
			<a href="/settings/"><div class="bannerCubeContainerFixedSettings gradientBanner"><?=$i18n["settings"] ?></div></a>
			<div class="bannerCubeContainerScaleFill gradientBanner"></div>
		</div>
		<div class="routeContainer">
			<div class="routeHeader">
				<p>
				<?=$content["connection"][0]["departure"]["station"]?><br>
				<img src="/templates/iRail/images/arrow.gif" width="16" height="16" alt="arrowRight"/><?=$content["connection"][0]["arrival"]["station"]?>
				</p>
				<div class="routeHeaderAddFavBtn"></div>
			</div>
			
			<?
			foreach($content["connection"] as $connection){
			?>
			<!-- START: Class routeCube will be multiplied by x quantity of steps passenger has to take to reach destination -->
			<div class="routeCube" id="routeCube" onclick="fold(this)">
				<div class="routeCubeHeader">
					<div class="routeCubeLeft">
						<?=formatTime($connection["departure"]["time"]); ?> -> -> ->
						<?=formatTime($connection["arrival"]["time"]); ?>
					</div>
					<div class="routeCubeRight">
						| <?=formatDuration($connection["duration"])?> |
					</div>
				</div>
				<div class="routeCubeInfo" id="routeCubeInfo" style="visibility: hidden; position: absolute;">
					<table>
					<tr>
						<td><?=formatTime($connection["departure"]["time"]); ?></td>
						<td style="width:100%; text-align:center;"><?=$content["connection"][0]["departure"]["station"]?></td>
						<td><div class="platformStyle"><? if(is_numeric($connection["departure"]["platform"])){ echo $connection["departure"]["platform"];}else{ echo "-";} ?></div></td>
					</tr>
					<tr>
						<td><?=formatTime($connection["arrival"]["time"]); ?></td>
						<td style="text-align:center;"><?=$content["connection"][0]["arrival"]["station"]?></td>
						<td><div class="platformStyle"><? if(is_numeric($connection["arrival"]["platform"])){ echo $connection["arrival"]["platform"];}else{ echo "-";} ?></div></td>
					</tr>
					</table> 
				</div>
			</div>
			<!-- END -->
			<?
			}
			?>
			
			<div class="routeBottomBtnContainer">
				<div class="routeBottomBtn"><p>|< <?=$i18n["earliestRide"] ?></p></div>
				<div class="routeBottomBtn"><p>< <?=$i18n["rideEarlier"] ?></p></div>
				<div class="routeBottomBtn"><p><?=$i18n["rideLater"] ?> ></p></div>
				<div class="routeBottomBtn"><p><?=$i18n["latestRide"] ?> >|</p></div>
			</div>
		</div>
	</div>
	</body>
</html>
