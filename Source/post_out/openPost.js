function openPost(){
	//OPTIONS:
	const image_folder = 'http://localhost/syktsu-social-network/Source/image_upload/uploads/';

	//CONSTRUCTOR:
	const news_form = document.getElementById('news');

	//PUBLIC:
	this.open = function(post_id){
		var elem = document.getElementById('post-'+post_id);

			addClassChild(elem, 'news-post-date', 'news-post-pop-out-date');
			addClassChild(elem, 'news-post-img', 'news-post-pop-out-img');
			addClassChild(elem, 'news-post-text', 'news-post-pop-out-text');

			var img = elem.getElementsByClassName('news-post-text');

			var http = new XMLHttpRequest();
	    	var url = "get-full-text.php"; //менять эту настройку	
	    	var params = 'id_post='+post_id;
			http.open("POST", url, true);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.onreadystatechange = function() {
			    if(http.readyState == 4 && http.status == 200) {
			    	console.log(http.responseText);
			    	var server_options = JSON.parse(http.responseText);
			    	if (server_options.answer != 'good') {
			    		console.log(http.responseText);
			    		return;
			    	}
			    	replaceTextImg(elem, server_options.text, server_options.images);

				}
			}
			http.send(params);
			elem.classList.add('news-post-pop-out');
	};
	//PRIVATE:
	function addClassChild(parent, delete_class, add_class){
		var elem = parent.getElementsByClassName(delete_class)[0];
			elem.classList.add(add_class);
	}
	function replaceTextImg(elem,text,imgJson){
		var img;
		var text = elem.getElementsByClassName('news-post-text')[0];
			text.innerHTML = text;
		var more_imgs = document.createElement('div');

		if(imgArray == 'not-images') return;
			var imgArray = JSON.parse(imgJson);
			for (let key in imgArray) {
				img = document.createElement('img');
					img.setAttribute('src', image_folder + imgArray[key]);
					more_imgs.appendChild(img);
			}
			elem.appendChild(more_imgs);
	}
}