<!DOCTYPE html>
<html lang="en">    
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
    <body class="bckgroundDarkGrey">
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
                <a href="/route/"><div class="bannerCubeContainerFixed gradientBanner">Route</div></a>
                <a href="/board/"><div class="bannerCubeContainerFixed bannerLinkActive removeBorderLeft">Board</div></a>
                <a href="/settings/"><div class="bannerCubeContainerFixedSettings gradientBanner">Settings</div></a>
                <div class="bannerCubeContainerScaleFill gradientBanner"></div>
            </div>
            <div class="searchContainer">
                <div class="containerFrom">
                    <div class="fillDotLeft"></div>
                    <div class="fillDotRight"></div>
                    <div class="listButton">
                        <div class="buttonFav"><a href="/stations/"><img src="/templates/iRail/images/fav.png" alt="favorite" width="40" height="25" class="floatRight"/></a></div>
                    </div>
                    <div class="fromHeader">Of</div>
                </div>
                <div class="inputFrom">
                    <input class="inputStyle" type="text" id="of" name="of"/>
                </div>
                <div class="inputChange"><img class="pointer" src="/templates/iRail/images/change.png" onclick="swap_From_To()" alt="change" width="25" height="30"/></div>
                <div class="inputMid"></div>
                <div class="toHeader">To (optional)</div>
                <div class="inputTo">
                    <input class="inputStyle" type="text" id="to" name="to"/>
                </div>

            </div>
            <div class="subMenuContainer">
                <div class="containerSubMenuBtn">
                    <div class="centerDivBtn">
                        <input class="gradientBtnSearch Btn" type="button" name="search" id="search" value="Show live board"/>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
