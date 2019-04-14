function sendLike(id_post_or_comment, bool_PoC, bool_like){ 
	//console.log(id_post_or_comment, bool_PoC, bool_like);
			var http = new XMLHttpRequest();
    		var url = "../like/like-script.php"; //менять эту настройку
    		
    		var params = "bool_like="+bool_like+"&id_post_or_comment="+id_post_or_comment+"&bool_PoC="+bool_PoC;
    
		    http.open("POST", url, true);
		    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    http.onreadystatechange = function() {
		    if(http.readyState == 4 && http.status == 200) {
		    	var server_options = http.responseText;
		    	var id = 'like-'+bool_PoC + "-" + id_post_or_comment;
		    	var elem = document.getElementById(id);
		    	var like_number = elem.getElementsByClassName('like-number')[0];
		    	var value = parseInt(like_number.innerHTML);
		    	console.log(value);
		    	if (elem.classList.contains('like-true')) {
		    		elem.classList.remove('like-true');
		    		value--;	
		    	}
		    	if (elem.classList.contains('dislike-true')) {
		    		elem.classList.remove('dislike-true');
		    		value++;	
		    	}
		    	
		    	
		    		if (server_options === '1') {
		    			elem.classList.add('like-true');
		    			value++;
		    		} else if (server_options === '0') {
		    			elem.classList.add('dislike-true');
		    			value--;
		    		 } //else if (server_options === 'delete'){
		    		// 	elem.setAttribute('class', 'like-div');
		    		// }
		    		
		    	like_number.innerHTML = value;
		    	
		   		}
			}
			http.send(params);
		}