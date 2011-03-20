<!DOCTYPE html>
<html lang="en">    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width:device-width; height:device-height; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
        <meta name="keywords" content="nmbs, sncb, iphone, mobile, irail, irail.be, route planner"/>
        <meta name="description" content="NMBS/SNCB mobile iPhone train route planner."/>
        <title>iRail.be - <?=$content["message"] ?></title>
        <link rel="shortcut icon" href="/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="/templates/iRail/css/main.css" />
        <script src="/templates/iRail/js/main.js"></script>
    </head>
    <body class="bckgroundDarkBlue">
        <div class="MainContainer">
            <div class="err404banner">
                <div class="err404logo">iRail</div>
            </div>
            <div class="err404container">
                <div class="err404train"></div>
            </div>
            <div class="err404text">
                <h1 class="err404h1 removePadding">We're so sorry!</h1>
                <p class="removePadding">Something went wrong.</p>
<!--<p class="err404underline"><?=$content["message"] ?></p>-->
                <p class="err404underline removePadding"><a href="javascript:history.back()">Go back</a> or try to <a href="javascript:location.reload(true)">refresh the page</a>.</p>
            </div>
        </div>
    </body>
</html>
