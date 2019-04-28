function auth(auth_user_id){
	//OPTIONS:
	const index_site = 'http://localhost/syktsu-social-network/';
	const redirect_url_to_page = 'http://localhost/syktsu-social-network/page.php?id=';
	const image_formats = '.jpg, .jpeg, .png';
	//CONSTRUCTOR:
	if (auth_user_id != 'not'){
		var setting_list = document.getElementsByClassName('settings-list')[0];
		var setting_items = setting_list.getElementsByTagName('li');
	
		if (auth_user_id === 'none'){
			var elem = setting_items[0].getElementsByTagName('a')[0];
			elem.innerHTML = 'Войти';
			elem.setAttribute('href' , index_site);
			setting_list.removeChild(setting_items[1]);
			setting_list.removeChild(setting_items[2]);
		} else {
			var elem = setting_items[0].getElementsByTagName('a')[0];
			elem.setAttribute('href' , redirect_url_to_page+auth_user_id);
			elem = setting_items[3].getElementsByTagName('a')[0];
			elem.setAttribute('onclick', 'authUser.out()');
		}
	}

	//PUBLIC:
	this.replaceUserIcon = function(){

		var form = document.createElement('form');
			form.setAttribute('enctype','multipart/form-data');
			form.setAttribute('method', 'post');
		var input = document.createElement('input');
			input.setAttribute('type', 'file');
			input.setAttribute('name', 'file');
			input.setAttribute('accept', image_formats);
			form.appendChild(input);
			input.click();

		input.onchange = function(e) { 
  			var http = new XMLHttpRequest();
    		var url = "Source/image-upload/upload.php"; //менять эту настройку	

    		formData = new FormData(form);
			http.open("POST", url, true);

			http.onreadystatechange = function() {
		    	if(http.readyState == 4 && http.status == 200) {
		    		console.log(http.responseText);
		   			if(http.responseText.substring(0,4) == 'good')
			    		replaceIconInDB(http.responseText.substring(4));
			    	else console.log(http.responseText);
				}
			
			}
			http.send(formData);
		}
	}
	this.out = function(){
		var http = new XMLHttpRequest();
    	var url = "Source/auth/out.php"; //менять эту настройку	
		http.open("POST", url, true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		http.onreadystatechange = function() {
		    if(http.readyState == 4 && http.status == 200) {
		    	if (http.responseText.substring(0,4) == 'good'){
		    		window.location.href = index_site;
		    	} else console.log(http.responseText);
		    }
		}
		http.send();
	}
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
	function replaceIconInDB(new_url){
		var http = new XMLHttpRequest();
    	var url = "Source/auth/replace-user-icon.php"; //менять эту настройку	
		http.open("POST", url, true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		http.onreadystatechange = function() {
		    if(http.readyState == 4 && http.status == 200) {
		    	if (http.responseText.substring(0,4) == 'good'){
		    		var image_url = http.responseText.substring(4);
		    		var image_tag = document.getElementsByClassName('header-image-img')[0];
		    			image_tag.setAttribute('src', image_url);
		    	} else console.log(http.responseText);
		    }
		}
		http.send('new-image-url='+new_url);
	}
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