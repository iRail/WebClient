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
    <body class="bckgroundDarkGrey">
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
                <a href="/board/"><div class="bannerCubeContainerFixed gradientBanner removeBorderLeft"><?=$i18n["board"] ?></div></a>
                <a href="/settings/"><div class="bannerCubeContainerFixedSettings gradientBanner"><img style="margin-top: 15px;" src="/templates/iRail/images/settings.png" alt="set" height="18" width="14"/></div></a>
                <div class="bannerCubeContainerScaleFill gradientBanner"></div>
            </div>
            <div class="searchContainer">
                <div class="containerMenu">
                    <div class="containerButtons noMargins">
                        <div class="settingsButtonL"><?=$i18n["log_in"] ?></div>
                        <div class="buttonActive settingsButtonR"><?=$i18n["register"] ?></div>
                    </div>
                </div>
            </div>
            <div class="headerText"><?=$i18n["username"] ?></div>
            <div class="inputFieldLogin">
                <input class="width100" type="text" name="username" id="username"/>
            </div>
            <div class="headerText"><?=$i18n["password"] ?></div>
            <div class="inputFieldLogin">
                <input class="width100" type="password" name="password" id="password"/>
            </div>
            <div class="containerSubMenuBtn">
                <div class="centerDivBtn">
                    <input class="gradientBtnLogin Btn" type="button" name="search" id="search" value="<?=$i18n["register"] ?>"/>
                </div>
            </div>
        </div>
<? include_once("templates/iRail/footer.php"); ?>
    </body>
</html>
