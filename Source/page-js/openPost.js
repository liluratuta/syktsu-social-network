function openPost(){
	//OPTIONS:
	const max_lenght_post_text = 50;
	const image_folder = 'http://localhost/syktsu-social-network/Source/image_upload/uploads/';
	const close_form_dilay = 200;

	//CONSTRUCTOR:
	const news_form = document.getElementById('news');
	var self = this;
	//PUBLIC:
	this.open = function(post_id){
		var elem = document.getElementById('post-'+post_id);

			addClassChild(elem, 'news-post-date', 'news-post-pop-out-date');
			addClassChild(elem, 'news-post-img', 'news-post-pop-out-img');
			addClassChild(elem, 'news-post-text', 'news-post-pop-out-text');

			//var img = elem.getElementsByClassName('news-post-text');

			var http = new XMLHttpRequest();
	    	var url = "Source/page-out/get-full-text.php"; //менять эту настройку	
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
			    	//console.log(server_options.text);
			    	var text = server_options
			    	replaceTextImg(elem, server_options.text, server_options.images);

				}
			}


			http.send(params);
			elem.classList.toggle('news-post-pop-out');

			bindClose(elem);

	};
	this.close = function() {
		var elem = document.getElementsByClassName('news-post-pop-out')[0];

			removeClass(elem, 'news-post-pop-out-date');
			removeClass(elem, 'news-post-pop-out-img');
			removeClass(elem, 'news-post-pop-out-text');

		var text_form = elem.getElementsByClassName('news-post-text')[0];
		var str = text_form.innerHTML;
			str = str.substring(0, max_lenght_post_text);
		text_form.innerHTML = str;

		elem.classList.toggle('news-post-pop-out');

		//document.body.style.overflow = '';
		setTimeout(function(){
			self.need_close = false;
			self.form_elem = undefined;
			console.log('стер переменные', self.need_close);
		},close_form_dilay);

		var deleted_img = elem.getElementsByClassName('news-post-pop-out-ext-img')[0];
			if(deleted_img != undefined) 
				elem.removeChild(deleted_img);

		function removeClass(elem, deleted_class){
			var find = elem.getElementsByClassName(deleted_class)[0];
			find.classList.remove(deleted_class);
		}
	}
	this.clickPost = function(elem){
		const ignore_class = ['like', 
							  'dislike',
							  'like-number',
							  'comment',
							  'comment-out',
							  'comment-pop-out'];

		while (elem){
			//console.log('работаем с elem:', elem);
			if(elem.classList == undefined)
				return false;
			for (key in ignore_class) 
				if(elem.classList.contains(ignore_class[key]))
					return false;
			if (elem.classList.contains('news-post')) 
				return getIdByElem(elem);
			elem = elem.parentNode;
		}
		return false;
		function getIdByElem(elem){
			var text = elem.getAttribute('id');
			return text.substring(text.indexOf('-') + 1);
		}
	}
	//PRIVATE:
	function addClassChild(parent, delete_class, add_class){
		var elem = parent.getElementsByClassName(delete_class)[0];
			elem.classList.add(add_class);
	}
	function replaceTextImg(elem,text_inf,imgJson){
		
		var text = elem.getElementsByClassName('news-post-text')[0];
			text.innerHTML = text_inf;
		

		if(imgArray == 'not-images') return;
		var img, div_img;
		var more_imgs = document.createElement('div');
			more_imgs.classList.add('news-post-pop-out-ext-img');
			var imgArray = JSON.parse(imgJson);
			for (let key in imgArray) {
				div_img = document.createElement('div');
					div_img.classList.add('ext-img');
					img = document.createElement('img');
						img.setAttribute('src', image_folder + imgArray[key]);
						div_img.appendChild(img);
					more_imgs.appendChild(div_img);
			}
			elem.appendChild(more_imgs);
	}
	function bindClose(elem){	
		setTimeout(function(){
			self.need_close = true;
			self.form_elem = elem;
			//console.log('смена переменной', self.need_close);
			//document.body.style.overflow = 'hidden';
		},close_form_dilay);
	}
}