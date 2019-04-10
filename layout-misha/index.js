
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
	document.getElementById('news-post-pop-out').style.display = 'block';
	var div1_width = div1.offsetWidth;
	var body_width = document.body.clientWidth;
	var left_margin = (body_width - div1_width)/2;
	document.getElementById('news-post-pop-out').style.left = left_margin + "px"; 
	
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