<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
<title>iRail - {from} to {to}</title>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<link href="templates/iRail/css/query.css" rel="stylesheet" type="text/css" />
<link rel="apple-touch-icon" href="img/irail.png" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
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
<tr>
<td><?=$i18n["map"] ?>: <a href="http://maps.google.be/?saddr={location1}&daddr={location2}" target="_blank"><img border="0" class="icon" src="img/map.png" width="14" height="14" alt="Local Map" title="Click for map" /></a>
</td>
<td><?=$i18n["date"] ?>: {date}
</td>
</tr>
<tr>
<td><?=$i18n["from"] ?>: <b> {from}</b></td>
<td><?=$i18n["to"] ?>: <b> {to}</b></td></tr></table>
<table align="left" cellpadding="0" cellspacing="1" bgcolor="FFFFFF" summary="Train Info">
<tr>
<th><?=$i18n["time"] ?></th>
<th><?=$i18n["duration"] ?></th>
<th><?=$i18n["delay"] ?></th>
<th><?=$i18n["platform"] ?></th>
<th><?=$i18n["transfers"] ?></th>
<th><?=$i18n["transportation"] ?></th>
</tr>
<?
foreach($content["connection"] as $key => $value){

      foreach($value as $key2 => $value2){
      echo $key2 . " " . $value2 . " \n ";
      }
      
      
?>
    <tr class="color{colorindex}">
        <td>
            {departtime}<br/>{arrivaltime}
        </td>
        <td>
            {duration}
        </td>
        <td class="{delayed}">
            {delay}
        </td>
        <td>
            {platform}
        </td>
        <td>
            {transfers}
        </td>
        <td>
            {trains}
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
