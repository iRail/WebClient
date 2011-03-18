//Public vars

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
    var xmlhttp;
    var holdtext =  "autoCmplete"+elmID;
    var holder = document.getElementById(holdtext);//the holder div
    holder.setAttribute("class", holdtext);


    if (str=="")
    {
        while(holder.hasChildNodes()){
            holder.removeChild(holder.lastChild);
        }
        return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            while(holder.hasChildNodes()){
                holder.removeChild(holder.lastChild);
            }
            if(document.getElementById(elmID).value.length >= 2){
                xmlDoc = xmlhttp.responseXML;
                var names = xmlDoc.getElementsByTagName('name');
                holder.setAttribute("class", "autoCmpleteBorder"+elmID+"");

                for(var i=0; i<names.length;i++){
                    var newdiv = document.createElement('div');
                    newdiv.setAttribute("class", "autoBox");
                    newdiv.setAttribute("id", "autoBox");
                    newdiv.setAttribute("onclick", "set_"+elmID+"('"+names[i].textContent+"')");
                    newdiv.appendChild(document.createTextNode(names[i].textContent));
                    holder.appendChild(newdiv);
                }
            }
        }
    }
    xmlhttp.open("GET","getTrainInfo.php?name="+str,true);
    xmlhttp.send();
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