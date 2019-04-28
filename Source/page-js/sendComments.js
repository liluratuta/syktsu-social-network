function comments(id_page,auth_user){
	//OPTIONS:
	const length_short_text = 60;
	const update_interval = 500;
	const close_form_dilay = 100;
	//constructor
	var post_elem, form_elem, input_text, id,last_server_id;
	var self = this;
	this.need_close = false;
	this.form_elem;


	getLastServerId();
	startUpdate();
	//publish
	this.activePost = function(post_id){
		if(auth_user == 'none') {
			console.log('Зарегестрируйтесь, чтобы оставлять комментарии!');
			return;
		}
		this.closeCommentForm();

		id = post_id;
		post_elem = document.getElementById('post-' + post_id);
		form_elem = post_elem.getElementsByClassName('comment-pop-out')[0];
		form_elem.classList.toggle('unset-display-none');

		var user = document.createElement('div');
			var div = document.createElement('div');
			div.classList.add('out-user-img');
			var img = document.createElement('img');
			img.setAttribute('src', getPageUserAvatar());
			img.setAttribute('width', '30px');
			img.setAttribute('height', '30px');
			div.appendChild(img)
			user.appendChild(div);

			div = document.createElement('div');
			div.classList.add('out-user-name');
			div.innerHTML = getPageUserName();
			user.appendChild(div);

			user.classList.add('comment-pop-out-user');
			form_elem.appendChild(user);

		var short_text = document.createElement('div');
			short_text.classList.add('out-short-text');
			short_text.innerHTML = getPostText();
			form_elem.appendChild(short_text);

		var comment_text = document.createElement('div');
			div = document.createElement('div');
				input_text = document.createElement('input');
					input_text.setAttribute('type', 'text');
					input_text.classList.add('pop-out-comment-input');
					div.appendChild(input_text);
				div.classList.add('comment-pop-out-text-in');
			comment_text.appendChild(div);

			div = document.createElement('div');
				var button = document.createElement('button');
					button.classList.add('pop-out-publish');
					button.setAttribute('onclick', 'comments.send()');
					div.appendChild(button);
				div.classList.add('pop-out-button');
				comment_text.appendChild(div);

			comment_text.classList.add('comment-pop-out-text');
			form_elem.appendChild(comment_text);


			installPositionForm(form_elem);
			document.body.style.overflow = 'hidden';

			bindClose();
	}

	this.send = function(){
		var http = new XMLHttpRequest();
    	var url = "Source/post-out/send-comment.php"; //менять эту настройку	
    	if(input_text.value == "") {
    		console.log('Пустой комментарий!');
    		return;
    	}
    	var params = "id_post="+id+"&text="+input_text.value;
    
		http.open("POST", url, true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		this.closeCommentForm();

		http.onreadystatechange = function() {
		    if(http.readyState == 4 && http.status == 200) {
		    	var server_options = http.responseText;
		    	if (server_options == '1')
		    		
		    		console.log('отправлено');
		   		}
			}
		http.send(params);
	}
	//private
	//check data
	function startUpdate(){
		var timerId = setInterval(function() {
  			UpdateComments();
		}, update_interval);
	}
	function getLastServerId(){
		var http = new XMLHttpRequest();
    	var url = "Source/post-out/get-last-id-comment.php"; //менять эту настройку	
		http.open("POST", url, true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		http.onreadystatechange = function() {
		    if(http.readyState == 4 && http.status == 200) {
		    	var server_options = http.responseText;
		    	console.log(server_options);
		    	if (server_options.substring(0,4) == 'Good'){
		    		last_server_id = server_options.substring(4);
		    	}
		    }
		}
		http.send();
	}
		
	
	function UpdateComments(){
		var http = new XMLHttpRequest();
    	var url = "Source/post-out/update-comments.php"; //менять эту настройку	
    	var params = "id_last_comment="+last_server_id+"&id_page="+id_page;
		http.open("POST", url, true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.onreadystatechange = function() {
		    if(http.readyState == 4 && http.status == 200) {
		    	var server_options = http.responseText;
		    	if (server_options.substring(0,4) != 'good') {
		    		if(server_options.substring(0,4) != 'none')
		    			console.log(server_options);
		    		return;
		    	}
		    	server_options = server_options.substring(4);
		    	var data = JSON.parse(server_options);
		    	console.log(data);
		    	var post_id;
		    	for (post_id in data){
		    		var post_elem = document.getElementById('post-' + data[post_id][1]);
		    		var div = document.createElement('div');
		    			div.classList.add('comment-out');
		    			div.innerHTML = data[post_id][0];
		    			post_elem.appendChild(div);
		    	}
		    	last_server_id = post_id;
			}
		}
		http.send(params);
	}
	this.closeCommentForm = function(){
		if(form_elem === undefined) return;


		form_elem.classList.toggle('unset-display-none');

		while (form_elem.firstChild) 
    		form_elem.removeChild(form_elem.firstChild);

		id = undefined;
		form_elem = undefined;
		post_elem = undefined;

		document.body.style.overflow = '';

		setTimeout(function(){
			self.need_close = false;
			self.form_elem = undefined;
			console.log('стер переменные', self.need_close);
		},close_form_dilay);
		
	}
	function getPostText(){
		var elem = post_elem.getElementsByClassName('news-post-text')[0];
		var str = elem.innerHTML;
		if (str.length > length_short_text){
			str = str.substring(0,length_short_text-3);
			str += '...';
		}
		return str;
	}
	function getPageUserAvatar(){
		var elem = document.getElementsByClassName('header-image')[0];
		elem = elem.getElementsByTagName('img')[0];
		return elem.getAttribute('src');
	}
	function getPageUserName(){
		var elem = document.getElementsByClassName('user')[0];
		var second_elem = elem.getElementsByClassName('user-name')[0];
		var output = second_elem.innerHTML;
		second_elem = elem.getElementsByClassName('user-lastname')[0];
		output += second_elem.innerHTML;
		return output;
	}
// 	//bind
	function bindClose(){	
		setTimeout(function(){
			self.need_close = true;
			self.form_elem = form_elem;
		},close_form_dilay);
	}
	function installPositionForm(elem){
		var X = document.body.clientWidth / 2;
		X = X - elem.clientWidth / 2;
		elem.style.left = X + 'px';
	}
}

