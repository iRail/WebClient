<!DOCTYPE html>
<html lang="en">    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width:device-width; height:device-height; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
        <meta name="keywords" content="nmbs, sncb, iphone, mobile, irail, irail.be, route planner"/>
        <meta name="description" content="NMBS/SNCB mobile iPhone train route planner."/>
        <title>iRail.be</title>
        <link rel="shortcut icon" href="favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="/templates/iRail/css/main.css" />
        <script>
		var stations = [<? foreach($content["station"] as $station){?>
			new stationObject(<? echo "\"" . $station["name"] . "\"," . "\"" . $station["locationX"] . "\"," ."\"" . $station["locationY"] . "\""; ?>),
		<?} ?>];
		var favRoute = [<? for ($i=0; $i < sizeof($page["favroutes"]["from"]); $i++){?>
			new route(<? echo "\"" . $page["favroutes"]["from"][$i] . "\"," . "\"" . $page["favroutes"]["to"][$i] . "\""; ?>),
		<?} ?>];
		var usedRoute = [<? for ($i=0; $i < sizeof($page["usedroutes"]["from"]); $i++){?>
			new route(<? echo "\"" . $page["usedroutes"]["from"][$i] . "\"," . "\"" . $page["usedroutes"]["to"][$i] . "\""; ?>),
		<?} ?>];
		
		var errorGeo = <? echo "\"" . $i18n["geolocationErr"] . "\"" ?>
		
		
		function compareDistance(a, b) {
			return a.distance - b.distance;
		}
		
		function getClosestStations(x, y, vicinity){
			var output = new Array();
		
			for (i in stations)
			{
				var dist = distance(x,stations[i].getX(),y,stations[i].getY());
				if(dist < vicinity){
					var obj = new stationObject(stations[i].getName(), stations[i].getX(),stations[i].getY());
					obj.distance = dist;
					output.push(obj);
				}
			}
			
			return output.sort(compareDistance);
		}

		function distance(lat1, lat2, lon1, lon2){
		     //haversine
			var R = 6371; // km
			var dLat = (lat2-lat1)*Math.PI/180;//radians
			var dLon = (lon2-lon1)*Math.PI/180;
			var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(lat1*Math.PI/180) * Math.cos(lat2*Math.PI/180) * Math.sin(dLon/2) * Math.sin(dLon/2); 
			var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
			return R * c;
		}		
		
		
		
		function getLocation() {
			// Get location no more than 10 minutes old. 600000 ms = 10 minutes.
			var mainHolder = document.getElementById("containerResults");
			if(document.getElementById("nearby").getAttribute("class") == "favButtonActive favButtonR"){
				mainHolder.innerHTML = <? echo "\"<p style='padding-left: 10px'>" . $i18n["geoLocationSearch"] . "</p>\""; ?>;
				navigator.geolocation.getCurrentPosition(showLocation, showError, {enableHighAccuracy:true,maximumAge:6000});
				timeLocation = setTimeout("getLocation()",25000);			
			}else{
				clearTimeout(timeLocation);
			}
			
		}

		function showError(error) {
			var mainHolder = document.getElementById("containerResults");
			mainHolder.innerHTML = "<p style='padding-left: 10px'>"+errorGeo+"</p>";
		}

		function showFavRoutes(){
			var mainHolder = document.getElementById("containerResults");
			var teller = 1;
			//clear mainContainer;
			mainHolder.innerHTML = "";
			
			for(i in favRoute){
					var resultHolder = document.createElement('div');
					if(teller % 2 == 0){
						resultHolder.setAttribute("class", "containerResultsBoxWhite");
					}else{
						resultHolder.setAttribute("class", "containerResultsBoxBlue");
					}			

					var nameURL = document.createElement('a');
					var nameDiv = document.createElement('div');

					
					nameDiv.setAttribute("class", "usedMost");
					nameURL.setAttribute("href", "/route/"+favRoute[i].getFrom()+"/"+favRoute[i].getTo()+"/");
					nameURL.innerHTML = "<p>"+favRoute[i].getFrom()+"<br/>"+favRoute[i].getTo()+"</p>";					
					nameDiv.appendChild(nameURL);					
					resultHolder.appendChild(nameDiv);

					
					mainHolder.appendChild(resultHolder);
					teller++;
			}
			if(teller == 1){
				mainHolder.innerHTML = <? echo "\"<p style='padding-left: 10px'>" . $i18n["noFav"] . "</p>\""; ?>;
			}
		}
		
		function showMostUsedRoutes(){
			var mainHolder = document.getElementById("containerResults");
			var teller = 1;
			//clear mainContainer;
			mainHolder.innerHTML = "";
			
			for(i in usedRoute){
					var resultHolder = document.createElement('div');
					if(teller % 2 == 0){
						resultHolder.setAttribute("class", "containerResultsBoxWhite");
					}else{
						resultHolder.setAttribute("class", "containerResultsBoxBlue");
					}			

					var nameURL = document.createElement('a');
					var nameDiv = document.createElement('div');

					
					nameDiv.setAttribute("class", "usedMost");
					nameURL.setAttribute("href", "/route/"+usedRoute[i].getFrom()+"/"+usedRoute[i].getTo()+"/");
					nameURL.innerHTML = "<p>"+usedRoute[i].getFrom()+"<br/><strong>&rarr;</Strong>"+usedRoute[i].getTo()+"</p>";					
					nameDiv.appendChild(nameURL);					
					resultHolder.appendChild(nameDiv);

					
					mainHolder.appendChild(resultHolder);
					teller++;
			}
			if(teller == 1){
				mainHolder.innerHTML = <? echo "\"<p style='padding-left: 10px'>" . $i18n["noMostUsed"] . "</p>\""; ?>;
			}
		}

		function showLocation(position) {
			var latitude = position.coords.latitude;
			var longitude = position.coords.longitude;
			var heading = position.coords.heading;
			
			//heading handler here

			if(latitude != ""){				
			     var nearbyStations = getClosestStations(longitude, latitude, 20);
				
				var teller = 1;
				var mainHolder = document.getElementById("containerResults");
				
//first thing to do is to clear the previous set of stations if there were any
				mainHolder.innerHTML = "";
				
				for(i in nearbyStations){
					var resultHolder = document.createElement('div');
					if(teller % 2 == 0){
						resultHolder.setAttribute("class", "containerResultsBoxWhite");
					}else{
						resultHolder.setAttribute("class", "containerResultsBoxBlue");
					}
					
					var nameURL = document.createElement('a');
					var nameDiv = document.createElement('div');
					var distanceDiv = document.createElement('div');
					
					nameDiv.setAttribute("class", "resultsName");
					distanceDiv.setAttribute("class", "resultsDistance");
					nameURL.setAttribute("href", "/board/"+nearbyStations[i].getName()+"/");
					nameURL.innerHTML = nearbyStations[i].getName();
					
					
					
					nameDiv.appendChild(nameURL);
					distanceDiv.appendChild(document.createTextNode(Math.round(nearbyStations[i].getDistance()*100)/100 + " km"));
						
					resultHolder.appendChild(nameDiv);
					resultHolder.appendChild(distanceDiv);
					
					mainHolder.appendChild(resultHolder);
					teller++;

				}
				if(teller == 1){
					mainHolder.innerHTML = <? echo "\"<p style='padding-left: 10px'>" . $i18n["noNearbyStations"] . "</p>\""; ?>;
				}
			}
		}
		
		function stationObject (n, x, y) {
			this.name = n;
			this.x = x;
			this.y = y;
			this.distance = 0;
			
			this.getName = function() {
				return this.name;
			};
			this.getX = function() {
				return this.x;
			};
			this.getY = function() {
				return this.y;
			};
			this.getDistance = function() {
				return this.distance;
			};
		}
		
		function route(f, t){
			this.to = t;
			this.from = f
			
			this.getTo = function (){
				return this.to;
			};
			this.getFrom = function(){
				return this.from;
			};
		}
	
        </script>
        <script src="/templates/iRail/js/main.js"></script>
    </head>
    <body onload="showFavRoutes()"> 
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
                <a href="/route/"><div class="bannerCubeContainerFixed bannerLinkActive"><?=$i18n["route"] ?></div></a>
                <a href="/board/"><div class="bannerCubeContainerFixed gradientBanner removeBorderLeft"><?=$i18n["board"] ?></div></a>
                <a href="/settings/"><div class="bannerCubeContainerFixedSettings gradientBanner"><?=$i18n["settings"] ?></div></a>
                <div class="bannerCubeContainerScaleFill gradientBanner"></div>
            </div>
            <div class="searchContainer">
                <div class="containerHeader"><?=$i18n["your_routes"] ?>
                    <a href="/stations/"><img src="/templates/iRail/images/fav.png" alt="favorite" width="40" height="25" class="floatRight"/></a>
                </div>
                <div class="containerMenuRoutes">
                    <div class="containerButtonsFav">
                        <div onclick="changeActiveFav('favourite'); showFavRoutes()" id="favourite" class="favButtonActive favButtonL"><?=$i18n["favourite"] ?></div>
                        <div onclick="changeActiveFav('nearby'); getLocation()" id="nearby" class="favButtonR"><?=$i18n["nearby"] ?></div>
                        <div onclick="changeActiveFav('mostUsed'); showMostUsedRoutes()" id="mostUsed" class="favButtonMid"><?=$i18n["most_used"] ?></div>
                    </div>
                </div>
            </div><!-- 3 divs you can hide/show by clicking on one of the tabs-->
            <div id="containerResults" class="containerResults">
				
            </div>
        </div>
    </body>
</html>
<?
	    function generateList($arrayname, $page){
		 $count = 0;
		     for ($i=0; $i < sizeof($page[$arrayname . "routes"]["from"]); $i++){
			  
			  if($count%2 ==0){
			            echo "<div class=\"containerResultsBoxBlue\">";
			       
			       }else{
				    echo "<div class=\"containerResultsBoxWhite\">";
			       }
			       echo "<div class=\"resultsName\">";
			       echo "<div class=\"favFrom\">" . $page[$arrayname . "routes"]["from"][$i] . "</div>";
			       echo "<div class=\"favTo\">". $page[$arrayname . "routes"]["to"][$i] ."</div>";
			       echo "</div></div>";
			       $count ++;
		     }
		     for ($i=0; $i < sizeof($page[$arrayname . "routes"]["from"]); $i++){
			       if($count%2 ==0){
			            echo "<div class=\"containerResultsBoxBlue\">";
			       }else{
				    echo "<div class=\"containerResultsBoxWhite\">";
			       }
			       echo "<div class=\"resultsName\">";
			       echo "<div class=\"favFrom\">" . $page[$arrayname . "boards"]["of"][$i] . "</div>";
			       echo "<div class=\"favTo\">". $page[$arrayname . "boards"]["to"][$i] ."</div>";
			       echo "</div></div>";
			       $count ++;
		     }
}

?>