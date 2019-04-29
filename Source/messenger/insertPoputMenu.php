<div id="cover">
<div id="poput">

	<div id="settings-container">
		<div class="settings-subcontainer">
			<div class="settings-box">
				<img id="settings-icon" src="img/Group.png">
			</div>
			<div class="settings-box">
				<label class="settings-label">
					Иконка чата
				</label>
				<div class="settings-box-body">
					<input id="settings-icon-src" class="settings-entryfield" type="text" name="" value="Group.png">
				</div>
			</div>
		</div>

		<div class="settings-box">
			<label class="settings-label">Название группы</label>
			<div class="settings-body">
				<input id="settings-name" class="settings-entryfield" type="text" name="" value="Name">
			</div>
		</div>

		<div class="settings-box">
			<label class="settings-label">Тип доступа</label>
			<div class="settings-body">
				<div class="settings-radiogroup">

					<input id="radio-accesstype-private" class="settings-radio" type="radio" name="access-type" value="private">
					<label for="radio-accesstype-private" class="settings-radio-label">Private</label>

					<input id="radio-accesstype-public" class="settings-radio" type="radio" name="access-type" value="public">
					<label for="radio-accesstype-public" class="settings-radio-label">Public</label>
				
				</div>
			</div>
		</div>

		<div class="settings-box">
			<label class="settings-label">Роль пользователя по умолчанию</label>
			<div class="settings-body">
				<div class="settings-radiogroup">

					<input id="radio-userrole-reader" class="settings-radio" type="radio" name="user-role" value="reader">
					<label for="radio-userrole-reader" class="settings-radio-label">Reader</label>

					<input id="radio-userrole-writer" class="settings-radio" type="radio" name="user-role" value="writer">
					<label for="radio-userrole-writer" class="settings-radio-label">Writer</label>
				
					<input id="radio-userrole-admin" class="settings-radio" type="radio" name="user-role" value="admin">
					<label for="radio-userrole-admin" class="settings-radio-label">Admin</label>

				</div>
			</div>
		</div>

		<div id="settings-submit">Сохранить изменения</div>

	</div>

	<div id="usermanager-menu">
			<input id="menu-tab-usersmanager" class="menu-tab" type="radio" name="usermanager-menu" checked="true">
			<label for="menu-tab-usersmanager" class="menu-tab-label">Управление подписчиками</label>

			<input id="menu-tab-addusers" class="menu-tab" type="radio" name="usermanager-menu">
			<label for="menu-tab-addusers" class="menu-tab-label">Добавить друзей в чат</label>			
		</div>

	<div id="usermanager-list">
		<!-- <div id="usermanager-userlist">list</div> -->
		<div class="chat-user">
			<img src="">
			
		</div>
	</div>
</div>

</div>

<script type="text/javascript">
	
</script>