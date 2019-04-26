window.onload = function() {
    document.body.onclick = function (e) {
	//console.log('пытаюсь закрыть');
	e = e || event;
	target = e.target || e.srcElement;
	//console.log(comments.need_close);
	var elem = document.elementFromPoint(e.clientX, e.clientY);
	if (comments.need_close){
	   	if (!comments.form_elem.contains(target)) 
	        comments.closeCommentForm();
	    //console.log('пытаюсь закрыть коментсы');
	} else if (openPost.need_close){
		if (!openPost.form_elem.contains(target))
			openPost.close();
	} else  if (openid = openPost.clickPost(elem)) {
		openPost.open(openid);
	} 
	

	// if (openPost.need_close)
	// 	if (!comments.form_elem.contains(target)) 
	//         comments.closePostForm();
	}
}