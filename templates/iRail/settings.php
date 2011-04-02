<?
global $test;
$test = $this->user->getLang();
?>
<!DOCTYPE html>
<html lang="en" appcache="/appcache.mf">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width; height=device-height; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
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
                <div class="bannerCubeContainerFixedLogo gradient">
                    <div class="Top">iRail</div>
                    <div class="Bot">
                        <div class="blackFlagColor"></div>
                        <div class="yelFlagColor"></div>
                        <div class="redFlagColor"></div>
                    </div>
                </div>
                <a href="/route/"><div class="bannerCubeContainerFixed gradientBanner"><?=$i18n["route"] ?></div></a>
                <a href="/board/"><div class="bannerCubeContainerFixed gradientBanner removeBorderLeft"><?=$i18n["board"] ?></div></a>
                <a href="/settings/"><div class="bannerCubeContainerFixedSettings bannerLinkActive"><div class="settingsBtn"></div></div></a>
                <div class="bannerCubeContainerScaleFill gradientBanner"></div>
            </div>
			<div class="settingsNew">
			<form action="" method="get" name="settings">
				<div class="languageDiv">
					<label style="color: #FFFFFF;" for="language"><?=$i18n["pickLanguage"] ?></label>
					<select name="lang" size="1" onchange="settings.submit()">
						<?
						$arrayLang = $this->AVAILABLE_LANGUAGES;
						for($i=0;$i<sizeof($arrayLang);$i++)
						{
							$option = "<option ";
							if($this->user->getLang() == $arrayLang[$i]){
								$option .= "selected=\"true\"";
							}
							$option .= " value=\"" . $arrayLang[$i] . "\">";
							$option .= $i18n[$arrayLang[$i]] . "</option>";
							echo $option;
						}
						?>

					</select>
				</div>
			</form>
			</div>
        </div>
    </body>
</html>
