<?
global $test;
$test = $this->user->getLang();
?>
<!DOCTYPE html>
<html lang="en">    
    <head>
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
                <a href="/settings/"><div class="bannerCubeContainerFixedSettings bannerLinkActive"><img style="margin-top: 15px; margin-bottom: 10px;" src="/templates/iRail/images/settings.png" alt="set" height="18" width="14"/></div></a>
                <div class="bannerCubeContainerScaleFill gradientBanner"></div>
            </div>
			<div class="settingsContent">
			<form action="" method="get" name="settings">
				<div style="font-size:1.1em;padding-bottom: 5px;padding-left:5px;"><?=$i18n["settings"] ?></div>
				<div class="languageDiv">
					<label style="" for="language"><?=$i18n["pickLanguage"] ?></label>
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
				<div style="font-size:1.1em;padding-bottom: 5px;padding-left:5px;"><?=$i18n["aboutUs"] ?></div>
				<div class="about">
					<ul class="aboutlist">
						<li><?=$i18n["datausedfrom"]?>: <a href="http://api.irail.be" target="_blank">iRail API</a>
						<li><?=$i18n["madeby"]?>: <a href="http://project.irail.be" target="_blank">iRail <?=$i18n["npo"] ?></a>
						<li><?=$i18n["authors"]?>:
							<ul>
								<li><?=$i18n["design"]?>: Dennis Kestelle
								<li><?=$i18n["frontendcoding"]?>: Muhammet Kilic
								<li><?=$i18n["backendcoding"]?>: Pieter Colpaert
								<li><?=$i18n["infrastructure"]?>: Yeri Tiete
								<li><?=$i18n["andothers"]?>
							</ul>
						<li>&copy; 2011 iRail <?=$i18n["npo"];?>
						<li><a href="http://www.github.com/iRail/WebClient/" target="_blank"><?=$i18n["stealthiscode"];?></a>
					</ul>
				</div>
			</form>
			</div>
        </div>
    </body>
</html>
