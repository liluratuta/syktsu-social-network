function post(id_page){
	//OPTIONS:
	const image_folder = 'http://localhost/syktsu-social-network/images/userImages/';//менять эту настройку
	const image_formats = '.jpg, .jpeg, .png';
	const max_images = 5;
	//CONSTRUCTOR:
	if (id_page == 'none') {
		console.log('true');
		var node = document.getElementsByClassName('new-post')[0];
			if (node.parentNode) {
  				node.parentNode.removeChild(node);
			}
			return;
	}
	const new_post_form = document.getElementsByClassName('new-post')[0];
	const pre_image_form = document.getElementsByClassName('new-post-pre-img')[0];
	var pre_images = [];
	//PUBLIC:
	this.openFile = function(){
		var count = pre_image_form.getElementsByTagName('img');
		if (count.length >= max_images){
			console.log('Внимание: максимальное колличество изображение в публикации 5');
			return;
		}

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
			    	var server_options = http.responseText;
			    	//console.log(server_options);
			    	if (server_options.substring(0,4) == 'good')
			    		addImage(server_options.substring(4));
			    	else 
			    		console.log(server_options);
			   		}
				}
			http.send(formData);
		};
	}
	this.deleteImage = function(URL){
		pre_images.splice(pre_images.indexOf(URL),1);

		var img = document.getElementById(URL);
			pre_image_form.removeChild(img);
		console.log(pre_images);
	}
	this.send = function(){
		console.log('check send');
		var http = new XMLHttpRequest();
    	var url = "Source/post-out/send-post.php"; //менять эту настройку	
    	
    	var input = new_post_form.getElementsByClassName('new-post-input')[0];
    	var text = input.value; //тут поменять
    	// console.log(new_post_form);
    	// console.log(input);

    	if ((text == '')&&(pre_images.length == 0)) {
    		console.log('Пост пустой!');
    		return;
    	}

    	if (pre_images.length == 0)
    		var images_JSON = '';
    	else 
    		var images_JSON = JSON.stringify(pre_images);

    	var params = 'text=' + text + '&images_JSON='+images_JSON;
    	//console.log(params);

		http.open("POST", url, true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		http.onreadystatechange = function() {
		    if(http.readyState == 4 && http.status == 200) {
		    	var server_options =JSON.parse(http.responseText);
		    	if (server_options.answer == 'good')
		    		writePost(server_options.id_post, server_options.elem);
		    		clearData();
		    	}
		    	



		    
		}
		http.send(params);
	}
	//PRIVATE:
	function writePost(id_post, data){
		var news_form = document.getElementById('news');
		var mark_div = document.getElementsByClassName('news-post')[0]; //нужен, чтобы осуществить вставку перед ним
		var post = document.createElement('div');
			post.classList.add('news-post');
			post.setAttribute('id', id_post);
			post.innerHTML = data;

		news_form.insertBefore(post, mark_div);
	}
	function addImage(URL){
		pre_images.push(URL);
		var boss_div = document.createElement('div');
			boss_div.classList.add('new-post-attach');
			boss_div.setAttribute('id', URL);
			var img = document.createElement('img');
				img.classList.add('attach-img');
				img.setAttribute('src', image_folder + URL);
				boss_div.appendChild(img);
			var div = document.createElement('div');
				div.classList.add('new-post-delete');
				div.setAttribute('onclick', 'postWriter.deleteImage("'+URL+'")');
				img = document.createElement('img');
					img.classList.add('delete-img');
					img.setAttribute('src', 'images/cross.png');
					div.appendChild(img);
			boss_div.appendChild(div)
			pre_image_form.appendChild(boss_div);
	}
	function clearData(){
		while (pre_image_form.firstChild) 
    		pre_image_form.removeChild(pre_image_form.firstChild);

    	var input = new_post_form.getElementsByClassName('new-post-input')[0];
    	input.value = '';

    	pre_images = [];
	}
	
}