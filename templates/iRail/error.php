<!DOCTYPE html>
<html lang="en" appcache="/appcache.mf">
    <head>
	<meta name="apple-mobile-web-app-capable"  content="yes" />
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.6, user-scalable=no" />
        <meta name="keywords" content="nmbs, sncb, iphone, mobile, irail, irail.be, route planner"/>
        <meta name="description" content="NMBS/SNCB mobile iPhone train route planner."/>
      <title>iRail.be - Error :(</title>
        <link rel="shortcut icon" href="/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="/templates/iRail/css/main.css" />
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
    <body class="bckgroundDarkBlue">
        <div class="MainContainer">
            <div class="err404banner">
                <div class="err404logo">iRail</div>
            </div>
            <div class="err404container">
                <div class="err404train"></div>
				<div class="err404Fgwave"></div>
				<div class="err404Bgwave"></div>
            </div>
            <div class="err404text">
                <h1 class="err404h1 removePadding"><?=$i18n["err404_FirstParagraph"] ?></h1>
                <p class="removePadding"><?=$i18n["err404_SecondParagraph"] ?></p>
<!--<p class="err404underline"><?=$content["message"] ?></p>-->
                <p class="err404underline removePadding"><a href="javascript:history.back()"><?=$i18n["go_back"] ?></a> <?=$i18n["or_try_to"] ?><a href="javascript:location.reload(true)"> <?=$i18n["refresh_page"] ?></a>.</p>
            </div>
        </div>
<? include_once("templates/iRail/footer.php"); ?>
    </body>
</html>
