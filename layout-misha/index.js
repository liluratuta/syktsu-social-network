
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
	document.getElementById('news-post').style.display = 'none';
	document.getElementById('news-post-pop-out').style.display = 'block';
}
function img_origin(){
	document.getElementById('main').style.opacity = '0.3';
	document.getElementById('main').style.backgroundColor = '#000';
	document.getElementById('origin_img').style.display = 'block';
	document.getElementById('news-post-pop-out').style.display ='none';
	document.getElementById('news').style.display ='none';
	var img1 = document.getElementById('pop_out_orig_img');
	var img_width = img1.clientWidth;
	var body_width = document.body.clientWidth;
	var left_margin = (body_width - img_width)/2;
	document.getElementById('origin_img').style.left = left_margin + "px"; 
}