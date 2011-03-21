//Public vars

var MAXTOCOMP = 10; // limit size of autocompletion list

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
//Auto complete, event: onkeyup
//This will change, we will load all stations onload
function autoComplete(elmID){
    var input = document.getElementById(elmID).value;
    showUser(input, elmID);
}
function showUser(str, elmID)
{
//TODO: if return has been pressed, the first answer has to be entered and the focus should be the next field in the form
    var holdtext =  "autoCmplete"+elmID;
    var holder = document.getElementById(holdtext);//the holder div
    holder.setAttribute("class", holdtext);

    var completionlist = autocompletestring(str);

    while(holder.hasChildNodes()){
        holder.removeChild(holder.lastChild);
    }

    if(completionlist.length < MAXTOCOMP){
	for(var i=0; i<completionlist.length;i++){
            var newdiv = document.createElement('div');
            newdiv.setAttribute("class", "autoBox");
            newdiv.setAttribute("id", "autoBox");
            newdiv.setAttribute("onclick", "set_"+elmID+"('"+completionlist[i]+"')");
            newdiv.appendChild(document.createTextNode(completionlist[i]));
            holder.appendChild(newdiv);
	}
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