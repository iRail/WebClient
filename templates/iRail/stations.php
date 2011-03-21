<!DOCTYPE html>
<html lang="en">    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width:device-width; height:device-height; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
        <meta name="keywords" content="nmbs, sncb, iphone, mobile, irail, irail.be, route planner"/>
        <meta name="description" content="NMBS/SNCB mobile iPhone train route planner."/>
        <title>iRail.be</title>
        <link rel="shortcut icon" href="favicon.ico"/>
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
            <div class="searchContainer">
                <div class="containerHeader"><?=$i18n["your_routes"] ?>
                    <a href="/stations/"><img src="/templates/iRail/images/fav.png" alt="favorite" width="40" height="25" class="floatRight"/></a>
                </div>
                <div class="containerMenuRoutes">
                    <div class="containerButtonsFav">
                        <div onclick="changeActiveFav('favourite')" id="favourite" class="favButtonActive favButtonL"><?=$i18n["favourite"] ?></div>
                        <div onclick="changeActiveFav('nearby')" id="nearby" class="favButtonR"><?=$i18n["nearby"] ?></div>
                        <div onclick="changeActiveFav('mostUsed')" id="mostUsed" class="favButtonMid"><?=$i18n["most_used"] ?></div>
                    </div>
                </div>
            </div>
            <div class="containerResults">
                <div class="containerResultsBoxBlue">

                </div>
                <div class="containerResultsBoxWhite">

                </div>
                <div class="containerResultsBoxBlue">

                </div>
                <div class="containerResultsBoxWhite">

                </div>
            </div>
        </div>
    </body>
</html>
