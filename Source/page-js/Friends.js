function friends() {
	const friend_form = document.getElementsByClassName('fr-user')[0];
	const for_paste_form = document.getElementsByClassName('fr-list')[0];
	const images_folder = 'http://localhost/syktsu-social-network/images/userImages/';

	this.check = function(){
		writeFriend({
			icon: 'url',
			firstname: 'hui',
			lastname: 'huev',
			hover: 'hover',
			type: 'type'
		});
	}

	function writeFriend(input){
		var friend = friend_form.cloneNode(true);
		var img = friend.getElementsByClassName('fr-img')[0];
			img.setAttribute('src', images_folder + input.icon);
		var name = friend.getElementsByClassName('fr-user-name')[0];
			name.innerHTML = input.firstname + " " + input.lastname;
		var button = friend.getElementsByClassName('fr-user-unfr')[0];
			button.innerHTML = input.hover;
		var noneHoverButton = friend.getElementsByClassName('fr-user-fr')[0];
			noneHoverButton.innerHTML = input.type;
		var inviseElem;
			noneHoverButton.onmousemove = function (event){
				inviseElem = event.target.parentNode.getElementsByClassName('fr-user-unfr')[0];
				inviseElem.classList.add('get-display')
			}

		for_paste_form.appendChild(friend);

	}
}