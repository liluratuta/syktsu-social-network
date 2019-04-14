function reg_display(){
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
function news_post(){
	var body_id = document.getElementById('body');
	body_id.style.opacity='0.9';
	var div1 = document.getElementById('news-post-pop-out');
	var pop_out = document.getElementById('news-post-pop-out');
	pop_out.style.display = 'block';
	var div1_width = div1.offsetWidth;
	var body_width = document.body.clientWidth;
	var left_margin = (body_width - div1_width)/2;
	document.getElementById('news-post-pop-out').style.left = left_margin + "px"; 
	
}
function img_origin(){
	var dark = document.getElementById('dark');
	dark.style.display = 'block';
	var orig_img = document.getElementById('origin_img');
	if(orig_img.style.display == 'block'){
		orig_img.style.display = 'none';
		pop_out.style.display ='block';
		news.style.display ='block';
	}
	else{
		orig_img.style.display = 'block';
		var img1 = document.getElementById('pop_out_orig_img');
		var img_width = img1.clientWidth;
		var body_width = document.body.clientWidth;
		var left_margin = (body_width - img_width)/2;
		document.getElementById('origin_img').style.left = left_margin + "px"; 
	}
}
function like(){
	var like_false = document.getElementById('like_false');
	var like_true =  document.getElementById('like_true');
	if(like_false.style.display == 'none'){
		like_false.style.display = 'block';
		like_true.style.display = 'none';
	}
	else{
		like_false.style.display = 'none';
		like_true.style.display = 'block';
	}
}
function dislike(){
	var dislike_false = document.getElementById('dislike_false');
	var dislike_true =  document.getElementById('dislike_true');
	if(dislike_false.style.display == 'none'){
		dislike_false.style.display = 'block';
		dislike_true.style.display = 'none';
	}
	else{
		dislike_false.style.display = 'none';
		dislike_true.style.display = 'block';
	}
}
function new_comment(){
	var com = document.getElementById('com-pop-out');
	com.style.display.block;
}