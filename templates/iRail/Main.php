<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?=$page["title"] ?></title>
        <link href="templates/iRail/css/mobile.css" rel="stylesheet">

        <meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
        <meta name="keywords" content="nmbs, sncb, iphone, mobile, irail, irail.be, route planner">
        <meta name="description" CONTENT="NMBS/SNCB mobile iPhone train route planner.">

        <meta http-equiv="Cache-control" content="no-cache">
        <script src="templates/iRail/js/index.js"></script>
        <script>
      var data= [<? echo implode(",",$content); ?>];
        </script>
    </head>

    <body>
        <div class="container">
            <div class="toolbar anchorTop">
		 <div class="title"><a href="/"><?=$page["title"] ?></a> </div>
                <div style="text-align:right;float:right;margin-right:10px"><a href="settings"><img style="vertical-align:middle;" border="0" src="templates/iRail/img/i.png" alt="Settings"></a></div>
                <br>
                <div class="toolbar">

                    <div id="toolbar" style="height: 14px; padding: 2px; background-color: #efefef; text-align: center; color: #555; font-size: 12px; font-weight: normal;">
                        <?=$page["date"]?></div>

                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                        <tr>
                        <form name="search" method="post" action="results">
                            <td>
                                <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF" style="color:#000000";>
                                       <tr>

                                        <td width="70"><?=$i18n["from"] ?>:</td>
                                        <td colspan="2">
                                            <input name="from" type="text" id="from" AUTOCOMPLETE="OFF" value="<?=$page["from"] ?>">
                                            <a href="#" onclick="javascript:reset_from()"><img src="templates/iRail/img/x.png" alt="X" border="0"></a>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td><?=$i18n["to"] ?>:</td>
                                        <td colspan="2"><input name="to" type="text" id="to" AUTOCOMPLETE="OFF" value="<?=$page["to"] ?>">
                                            <a href="#" onclick="javascript:reset_to()"><img src="templates/iRail/img/x.png" alt="X" border="0"></a>
                                        </td>
                                    </tr>
                                    <tr><td colspan="3"><br></td></tr>
                                    <tr>
                                        <td><?=$i18n["date"] ?>:</td>
                                        <td colspan="2">
                                            <select NAME="d" id="timeselectd">
<?
for($i = 1; $i <= 31;$i ++){
     if($i<10){
	  $j = "0".$i;
     }else{
	  $j = $i;
     }
     $selected = "";
     if($i == date("j")){
	  $selected="selected=\"selected\"";
     }
     echo "<option VALUE=\"" .$j ."\" ". $selected .">" . $j . "</option>";
}

?>                                            </select>/<select NAME="mo" id="timeselectmo">
<?
for($i = 1; $i <= 12;$i ++){
     if($i<10){
	  $j = "0".$i;
     }else{
	  $j = $i;
     }
     $selected = "";
     if($j == date("m")){
	  $selected="selected=\"selected\"";
     }
     echo "<option VALUE=\"" .$j ." ". $selected ."\">" . $j . "</option>";
}

?>
                                            </select>/<select name="y">
<?
if(date("n") == 1){
     echo "<option value=\"". date("y")-1 . "\"  >" . date("Y")-1  . "</option>";
}
echo "<option value=\"". date("y") . "\" selected=\"selected\" >" . date("Y")  . "</option>";
if(date("n") == 12 ){
     echo "<option value=\"". date("y")+1 . "\">" . date("Y")+1  . "</option>";
}

?>
                                                <option value="11"  >2011</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><?=$i18n["time"] ?>:</td>
                                        <td colspan="2">
                                            <select NAME="h" id="timeselecth">
<?
for($i = 0; $i<24;$i++){
     if($i<10){
	  $j = "0" . $i;
     }else{
	  $j = $i;
     }
     $selected = "";
     if($i == date("h")){
	  $selected="selected=\"selected\"";
     }
     echo "<option VALUE=\"" .$j ."\" ". $selected .">" . $j . "</option>";
}
?>                           
                                            </select>:<select NAME="m" id="timeselectm">
<?
for($i = 0; $i<6;$i++){
     $selected="";
     if($i == floor(date("i")/10)){
	  $selected="selected=\"selected\"";
     }
     if($i ==0){
	  $j = "00";
     }else{
	  $j = $i*10;
     }
     echo "<option VALUE=\"" .$j ."\" ". $selected .">" . $j . "</option>";
}
?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">
                                            <input type="radio" name="timesel" value="depart" checked><span style="font-weight:normal;font-size:18px;"><?=$i18n["depart"] ?></span>
                                            <input type="radio" name="timesel" value="arrive"><span style="font-weight:normal;font-size:18px;"><?=$i18n["arrival"] ?></span>

                                        </td>
                                    </tr>
                                    <tr><td colspan="3"></td></tr>
                                    <tr>
                                        <td colspan="3">
                                            <div style="text-align:center;">
                                                <button type="submit" name="submit" value="Search"><?=$i18n["search"] ?></button>
                                                <button type="button" onclick="javascript:switch_station()"><?=$i18n["switch"] ?></button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr><td colspan="3"><br></td></tr>
                                </table>
                            </td>
                        </form>

                        </tr>
                    </table>
<?=$globals["footer"]?>


                </div>
            </div>
        </div>
     <?=$globals["GoogleAnalytics"]?>
    </body>
</html>