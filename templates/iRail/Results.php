<?
//let's first create some helpfunctions so we can output the json more easily
function formatDuration($dur){
     $i = $dur/60%60;
     $h = floor($dur/3600);
     //    if($h < 10){ // don't do this. too much zeros
     //	  $h = "0" . $h;
     //   }
     if($i<10){
	  $i = "0" . $i;
     }
     return  $h.":".$i;
}

function formatDelay($del){    
     if($del>0){
	  return"+" . $del/60;
     }
     return "/";
}

function formatDate($time){
     return date("d/m/Y",$time);
}

function formatTime($time){
     return date("H:i",$time);
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
     <title><?=$page["title"]?>: <?=$content["connection"][0]["departure"]["station"]?> - <?=$content["connection"][0]["arrival"]["station"]?> </title>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<link href="templates/iRail/css/query.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<script type="application/x-javascript">
addEventListener('load', function() { setTimeout(hideAddressBar, 0); }, false)
function hideAddressBar() { window.scrollTo(0, 1); }
</script>
</head>
<body>
              <div data-role="content">

<?
if($page["strike"]){
	  echo "<div id=\"strike\">". $i18n["strike"] ."</div>";
} 
?>
<!-- compass image by Yusuke Kamiyamane, Creative Commons (Attribution 3.0 Unported) -->
<table>
<tr><?//TODO: ADD BETTER LOCATIONINFORMATION TO JSON?>
<td><a href="http://maps.google.be/?saddr=<? echo $content["connection"][0]["departure"]["stationinfo"]["locationY"] . " ".$content["connection"][0]["departure"]["stationinfo"]["locationX"]; ?>&daddr=<? echo $content["connection"][0]["arrival"]["stationinfo"]["locationY"] . " ".$content["connection"][0]["arrival"]["station"]["locationX"]; ?>" target="_blank"><img border="0" class="icon" src="templates/iRail/img/map.png" width="20" height="20" alt="Local Map" title="Click for map" /></a>
</td>
     <td><?=$i18n["date"] ?>: <?=formatDate($content["connection"][0]["arrival"]["time"])?>
</td>
</tr>
<tr>
<td><?=$i18n["from"] ?>: <b><a href="http://widgets.iRail.be/liveboard.html?station=<?=$content["connection"][0]["departure"]["station"]?>" target="_blank"><?=$content["connection"][0]["departure"]["station"]?></a></b></td>
<td><?=$i18n["to"] ?>: <b><a href="http://widgets.irail.be/liveboard.html?station=<?=$content["connection"][0]["arrival"]["station"]?>" target="_blank"><?=$content["connection"][0]["arrival"]["station"]?></a></b></td></tr></table>
<table align="left" cellpadding="0" cellspacing="1" bgcolor="FFFFFF" summary="Train Info">
<tr>
<th><?=$i18n["time"] ?></th>
<th><?=$i18n["duration"] ?></th>
<th><?=$i18n["delay"] ?></th>
<th><?=$i18n["platform"] ?></th>
<th><?=$i18n["transfers"] ?></th>
</tr>
<?
foreach($content["connection"] as $connection){
?>
    <tr class="color<? echo $connection["id"]%2; ?>">
        <td><?=formatTime($connection["departure"]["time"]); ?>
<br/><?=formatTime($connection["arrival"]["time"]); ?>
        </td>
        <td>
<?=formatDuration($connection["duration"])?>
        </td>
        <td class="<? if($connection["arrival"]["delay"] > 0 ) {echo "delayed";} ?>">
<?=formatDelay($connection["departure"]["delay"]); ?> <br/>
<!-- delay on arrival: <?=formatDelay($connection["arrival"]["delay"]); ?> -->

        </td>
        <td>
<? if(is_numeric($connection["departure"]["platform"])){ echo $connection["departure"]["platform"];}else{ echo "-";} ?>
<br/>
<!-- arrival platform: <? if(is_numeric($connection["arrival"]["platform"])){ echo $connection["arrival"]["platform"];}else{ echo "-";} ?>-->
        </td>
        <td>
<?
if(isset($connection["vias"])){ 
   foreach($connection["vias"]["via"] as $via){
	if(is_numeric($via["departure"]["platform"])){
		     echo $via["departure"]["platform"] . " - ";
		}
		echo $via["station"] . "<br/>\n";
   } 
}else{
     echo "/";
}
?>
        </td>
<?
}
?>
</tr>

<tr>
<td colspan="8">
<center>
    <form action="/">
<input type="submit" name="submit" value="<?=$i18n["back"] ?>">
</form>
</center>
<br />
</td>
</tr>
</table>
</div>
</body>
</html>
