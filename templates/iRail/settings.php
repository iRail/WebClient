<!DOCTYPE html>
<html lang="en" manifest="/appcache.mf">
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
	<script>
		window.addEventListener('load', function(e) {
		window.applicationCache.update();
		  window.applicationCache.addEventListener('updateready', function(e) {
			if (window.applicationCache.status == window.applicationCache.UPDATEREADY) {
			  window.applicationCache.swapCache();
			window.location.reload();	  
			}
		  }, false);

		}, false);
	</script>
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
                <a href="/settings/"><div class="bannerCubeContainerFixedSettings bannerLinkActive"><img style="margin-top: 15px; margin-bottom: 10px;" src="/templates/iRail/images/settingsActive.png" alt="set" height="18" width="14"/></div></a>
                <div class="bannerCubeContainerScaleFill gradientBanner"></div>
            </div>
			<div class="settingsContent">
			<form action="" method="get" name="settings">
				<div class="languageDiv">
					<label for="language" style="font-weight: bold; font-size: 1.2em;padding-top:10px;"><?=$i18n["pickLanguage"] ?></label><br/>
					<select id="language" name="lang" size="1" onchange="settings.submit()" style="margin-top: 10px;padding:5px;">
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
				<?
				$agent = $_SERVER['HTTP_USER_AGENT'];
				$listAgent = array("iPhone", "iPod");
				if(strstr($agent, "iPhone") || strstr($agent, "iPod"))
				{
					print "<a href=\"itms://itunes.apple.com/us/app/betrains/id403631462?mt=8\">Appstore</a>";
				}
				if(strstr($agent, "Android")){
					print "<a href=\"market://search?q=pname:tof.cv.mpp\">Android Market</a>"
				}
				if(strstr($agent, "Maemo browser")){
					print "<a href=\"http://maleadt.be:8080/downloads/BeTrains.Qt/nightlies/maemo/betrains-20110417_armel.deb\">Android Market</a>";
				}
				if(strstr($agent, "Windows Phone")){
					print "<a href=\"http://social.zune.net/redirect?type=phoneApp&amp;id=807c02b6-7a4d-e011-854c-00237de2db9e\">Windows application</a>";
				}
				
				?>				
				<div style="padding-bottom: 5px; padding-left: 5px; font-size: 1.2em; font-weight: bold;"><?=$i18n["aboutUs"] ?></div>
				<div class="about">
					<ul class="aboutlist">
						<li><?=$i18n["datausedfrom"]?>: <a href="http://api.irail.be" target="_blank">iRail API</a>
						<li><?=$i18n["madeby"]?>: <a href="http://project.irail.be" target="_blank">iRail <?=$i18n["npo"] ?></a>
						<li style="color: #FFFFFF;padding-top:15px;"><?=$i18n["authors"]?>:
						<li><?=$i18n["design"]?>: Dennis Kestelle
						<li><?=$i18n["frontendcoding"]?>: Muhammet Kilic
						<li><?=$i18n["backendcoding"]?>: Pieter Colpaert
						<li><?=$i18n["infrastructure"]?>: <a style="text-decoration: none;" href="http://yeri.be" target="_blank">Yeri Tiete</a>
						<li><?=$i18n["andothers"]?>
						<li>&copy; 2011 iRail <?=$i18n["npo"];?>
						<li style="padding-top:15px;"><a href="http://www.github.com/iRail/WebClient/" target="_blank"><?=$i18n["stealthiscode"];?></a>
					</ul>
				</div>
			</form>
			</div>
        </div>
<? include_once("templates/iRail/footer.php"); ?>
    </body>
</html>
