function auth(){
	//OPTIONS:
	const redirect_url_to_page = 'http://localhost/syktsu-social-network/page.php?id=';
	//CONSTRUCTOR:
	//PUBLIC:
	this.sendRegistration = function(){
		var elem = document.forms.namedItem("registration");
		var form_data = new FormData(elem);
		
		var http = new XMLHttpRequest();
    	var url = "Source/auth/registration.php"; //менять эту настройку	
    
		http.open("POST", url, true);

		//http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.onreadystatechange = function() {
		    if(http.readyState == 4 && http.status == 200) {
		    	console.log(http.responseText);
		    	showServerMessage(http.responseText);
			}
		}
		http.send(form_data);
	}
	this.sendAuth = function(){
		var elem = document.forms.namedItem("auth");
		var form_data = new FormData(elem);
		
		var http = new XMLHttpRequest();
    	var url = "Source/auth/auth.php"; //менять эту настройку	
		http.open("POST", url, true);

		//http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.onreadystatechange = function() {
		    if(http.readyState == 4 && http.status == 200) {
		    	console.log(http.responseText);
		    	var server_options = JSON.parse(http.responseText);
		    	if (server_options.typemessage == 'good')
		    		window.location.href = redirect_url_to_page + server_options.message;
		    	else
		    		showServerMessage(http.responseText);
			}
		}
		http.send(form_data);
	}


	//PRIVATE:
	function showServerMessage(code){
		var code = JSON.parse(code);
		var elem = document.getElementsByClassName('server-message')[0];
		//console.log(elem);
		elem.setAttribute('class', 'server-message');

		if (code.typemessage == 'good')
			elem.classList.add('good-server-message');
		else 
			elem.classList.add('bad-server-message');

		elem.innerHTML = code.message;
	}
}