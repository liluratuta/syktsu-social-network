function sendLike(id_post_or_comment, bool_PoC, bool_like){ 
			var http = new XMLHttpRequest();
    		var url = "like-script.php"; //менять эту настройку
    		
    		var params = "bool_like="+bool_like+"&id_post_or_comment="+id_post_or_comment+"&bool_PoC="+bool_PoC;
    
		    http.open("POST", url, true);
		    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    http.onreadystatechange = function() {
		    if(http.readyState == 4 && http.status == 200) {
		    	var server_options = http.responseText;
		    	var id = bool_PoC + "-" + id_post_or_comment;
		    	console.log(server_options);
		    	var elem = document.getElementById(id);
		    	elem.classList.remove('false-like');
		    	elem.classList.remove('true-like');
		    		if (server_options === '1') {
		    			elem.classList.add('true-like');
		    		} else if (server_options === '0') {
		    			
		    			elem.classList.add('false-like');
		    		} else if (server_options === 'delete'){
		    			elem.setAttribute('class', 'like');
		    		}
		    	
		   		}
			}
			http.send(params);
		}