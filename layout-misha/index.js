document.getElementById('reg-display-button').onclick = function(){
	document.getElementById('auth').style.display = 'none';
	document.getElementById('registration').style.display = 'block';
}
function setting_show(){
	var elem=document.getElementById('set-div');
	if(elem.style.visibility=="visible"){
		elem.style.visibility = "hidden";
	}
	else
	elem.style.visibility = "visible";


}