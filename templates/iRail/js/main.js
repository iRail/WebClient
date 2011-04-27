//Public vars

var MAXTOCOMP = 10; // limit size of autocompletion list
var activeAuto = -1;
//End Public vars
function changeActive(btn){
    if(btn == "depart"){
        document.getElementById("deprtAt").setAttribute("class","buttonActive buttonR");
        document.getElementById("arrAt").setAttribute("class","buttonL");
    }
    if(btn == "arrive"){
        document.getElementById("deprtAt").setAttribute("class","buttonR");
        document.getElementById("arrAt").setAttribute("class","buttonActive buttonL");
    }
}
function changeActiveFav(btn){
    if(btn == "favourite"){
        document.getElementById("favourite").setAttribute("class","favButtonActive favButtonL");
        document.getElementById("mostUsed").setAttribute("class","favButtonMid");
        document.getElementById("nearby").setAttribute("class","favButtonR");
    }
    if(btn == "mostUsed"){
        document.getElementById("favourite").setAttribute("class","favButtonL");
        document.getElementById("mostUsed").setAttribute("class","favButtonActive favButtonMid");
        document.getElementById("nearby").setAttribute("class","favButtonR");

    }
    if(btn == "nearby"){
        document.getElementById("favourite").setAttribute("class","favButtonL");
        document.getElementById("mostUsed").setAttribute("class","favButtonMid");
        document.getElementById("nearby").setAttribute("class","favButtonActive favButtonR");

    }
}

function disableEnterKey(e)
{
	var key = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
   
	 if(window.event)
		  key = window.event.keyCode; //IE
	 else
		  key = e.which; //firefox     

	 return (key != 13);
}

//Auto complete, event: onkeyup
function autoComplete(elmID, e){
    var input = document.getElementById(elmID).value;
    showUser(input, elmID, e);
}

function showUser(str, elmID, e)
{
	var holdtext =  "autoCmplete"+elmID;
	var holder = document.getElementById(holdtext);//the holder div
	var key = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
	if(key != 40 && key != 38 && key != 13){
		activeAuto = -1;

		holder.setAttribute("class", holdtext);

		var completionlist = autocompletestring(str);

		while(holder.hasChildNodes()){
			holder.removeChild(holder.lastChild);
		}

			
		if(completionlist.length < MAXTOCOMP && completionlist.length > 0){
		holder.setAttribute("class", "autoCmpleteBorder"+elmID+"");
		for(var i=0; i<completionlist.length;i++){
				var newdiv = document.createElement('div');
				newdiv.setAttribute("class", "autoBox");
				newdiv.setAttribute("id", "autoBox");
				newdiv.setAttribute("onclick", "set_"+elmID+"('"+completionlist[i]+"')");
				newdiv.appendChild(document.createTextNode(completionlist[i]));
				holder.appendChild(newdiv);
		}
			//holder.firstChild.setAttribute("style","text-decoration: underline");
		}

	}
	
	if (key==13){ //13 = enter, 9=tab
		var childs = holder.childNodes;
		if(holder.hasChildNodes()){
			var fromInput = document.getElementById(elmID);
			if(activeAuto == -1){
				fromInput.value = childs[0].innerHTML;
			}else{
				fromInput.value = childs[activeAuto].innerHTML;
			}
			
			if(elmID == "from"){
				var toInput = document.getElementById("to");
				toInput.focus();
			}else{
				var submitBtn = document.getElementById("search");
				submitBtn.focus();
			}
		}
		clearHolder(elmID);
	}
}

function changeActiveAutoCompletion(elmID, e){
	var key = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;

	var holdtext =  "autoCmplete"+elmID;
    var holder = document.getElementById(holdtext);//the holder div

	//up arrow 	38
	//down arrow 	40
	var childs = holder.childNodes;
	
	
	if (key==40 && activeAuto < childs.length-1){
		activeAuto++;
		if(activeAuto > 0){
			var tssStap = activeAuto-1
			childs.item(tssStap).setAttribute("style", "");
			//alert(activeAuto + " " + childs.length);
		}
		childs.item(activeAuto).setAttribute("style", "text-decoration: underline;");
	}
	if(key==38 && activeAuto > 0){ // not >= if last elem selected, we can't enter if
		activeAuto--;
		var tssStap = activeAuto+1
		childs.item(tssStap).setAttribute("style", "");
		childs.item(activeAuto).setAttribute("style", "text-decoration: underline;");
	}
}

//str is the user given string so far
//It will return an array of stations which contain the given string
function autocompletestring(str){
    var autocomp = [];
    //only if there's something in the string
    if(str.length > 0){
	for(var i=0;i<stations.length; i++){
	    //if str is indexed at -1 in the stationname it doesn't match, otherwise it does
	    if(stations[i].toLowerCase().indexOf(str.toLowerCase()) != -1){
		autocomp.push(stations[i]);
	    }
	}
    }
    return autocomp;
}

//End Auto complete

//set "to" input to text selected from the autocomplete
function set_to(text){
    document.getElementById("to").value = text;
    clearHolder("to");
}
//set "from" input to text selected from the autocomplete
function set_from(text){
    document.getElementById("from").value = text;
    clearHolder("from");
}

//clean one of the autocomplete containers
function clearHolder(elmID){
    var holdtext = "autoCmplete"+elmID;
    var holder = document.getElementById(holdtext);//the holder div

    holder.setAttribute("class", holdtext);
    while(holder.hasChildNodes()){
        holder.removeChild(holder.lastChild);
    }
}

//clean both autocomplete containers
function removeAllHolders(){
    var holderFrom = document.getElementById('autoCmpletefrom');//the holder div
    var holderTo = document.getElementById('autoCmpleteto');//the holder div
    
    while(holderFrom.hasChildNodes()){
        holderFrom.removeChild(holderFrom.lastChild);
    }

    while(holderTo.hasChildNodes()){
        holderTo.removeChild(holderTo.lastChild);
    }
}

function reset_From() {
    document.getElementById("from").value = '';
}
function reset_To() {
    document.getElementById("to").value = '';
}

function swap_From_To(){
    var from = document.getElementById("from").value
    document.getElementById("from").value = document.getElementById("to").value;
    document.getElementById("to").value = from;
}

function fold(elm){
	var children = elm.childNodes;
	var fold;
	var found = false;

	for(i = 0; i < children.length; i++)
	{
		var link = children.item(i);
		if(link.id == "routeCubeInfo"){
			fold = link;
			found = true;
		}
	}
	
	if(found){
		if(fold.style.visibility == 'hidden'){
			fold.style.visibility = 'visible';
			fold.style.position = "static";
		}else{
			fold.style.visibility = 'hidden';
			fold.style.position = "absolute";
		}
	}
}