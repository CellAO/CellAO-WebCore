<?php
	isset($_REQUEST['id']) ? $userId = $_REQUEST['id'] : $userId = "";
	define('GM_REQUIRED', True);
	define("PRE_LINK", "../");
	$includeCSSFiles[] = '../css/editUser.css';
	$includeJavascriptFiles[] = '../js/editUser.js';

	require_once('../includes/header.php');
	if($userId == ""){
		header("Location: findUser.php");
		exit;
	}
?>
	
<div id="editUser" class="indentedContent section">
	<span class="sectionHeader">User Attributes:</span> 
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Id">Id: </label>
			</span>
			<span>
				<input type="text" value="" id="Id" disabled />
			</span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Username">Username: </label>
			</span>
			<span>
				<input type="text" value="" id="Username" />
			</span>
			<span id='savingUsername' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="FirstName">FirstName: </label>
			</span>
			<span>
				<input type="text" value="" id="FirstName" />
			</span>
			<span id='savingFirstName' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="LastName">LastName: </label>
			</span>
			<span>
				<input type="text" value="" id="LastName" />
			</span>
			<span id='savingLastName' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Email">Email: </label>
			</span>
			<span>
				<input type="text" value="" id="Email" />
			</span>
			<span id='savingEmail' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="GM">GM: </label>
			</span>
			<span>
				<select id="GM">					
					<option value="-1"></option>
					<option value="0">User</option>
					<option value="1">GM</option>
					<option value="100">Administrator</option>
				</select>
			</span>
			<span id='savingGM' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Expansions">Expansions: </label>
			</span>
			<span>
				<input type="text" value="" id="Expansions" />
<!-- 			<select multiple>
				<option value="0">Notum Wars</option>
				<option value="1">Shadow Lands</option>
				<option value="2">Shadow Lands Pre-Order</option>
				<option value="3">Alien Invasion</option>
				<option value="4">Alien Invasion Pre-Order</option>
				<option value="5">Lost Eden</option>
				<option value="6">Lost Eden Pre-Order</option>
				<option value="7">Legacy of Xan</option>
				<option value="8">Legacy of Xan Pre-Order</option>
				<option value="9">Mail</option>
				<option value="10">PMV Obsidian Edition</option>
			</select> -->
			</span>
			<span id='savingExpansions' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Password">Password: </label>
			</span>
			<span>
				<input type="text" value="" id="Password" />
			</span>
			<span id='savingPassword' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="AccountFlags">AccountFlags: </label>
			</span>
			<span>
				<input type="text" value="" id="AccountFlags" />
			</span>
			<span id='savingAccountFlags' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="AllowedCharacters">AllowedCharacters: </label>
			</span>
			<span>
				<input type="text" value="" id="AllowedCharacters" />
			</span>
			<span id='savingAllowedCharacters' class="savingIcon"></span>
		</div>		
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="characterList">Characters: </label>
			</span>
			<span>
				<select id="characterList">
				</select>
			</span>
			<button style="display: inline-block;" id="editCharacter">Edit</button>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="CreationDate">CreationDate: </label>
			</span>
			<span>
				<input type="text" value="" id="CreationDate" disabled />
			</span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Flags">Flags: </label>
			</span>
			<span>
				<input type="text" value="" id="Flags" />
			</span>
			<span id='savingFlags' class="savingIcon"></span>
		</div>
	</div>
	<script>
		//Needs to be here since we're printing PHP directly to the script.
		$(document).ready(function(){
			jQuery.getJSON('../includes/data/users.php', {'action': 'getUserById', 'id': <?php echo($userId); ?>}, function(data){
				$("#GM option[value='-1']").remove()
				jQuery.each(data, function(key, data){
					$('#' + key).val(data);
				});
			});
			jQuery.getJSON('../includes/data/characters.php', {'action': 'getCharacterList', 'query': <?php echo($userId); ?>}, function(data){
				jQuery.each(data, function(index, data){
					$('#characterList').append($("<option></option>")
										.attr("value",data.Id)
										.text(data.Name)); 
				});
			});
		});

		function saveField(element){
			if($(element).data('initialData') != $(element).val()){
				var elementName = $(element).attr('id');
				var savingElementName = '#saving' + elementName;
				$(savingElementName).addClass('active');
				var data = {
					'action': 'updateUserAttribute', 
					'query': '<?php echo($userId); ?>'
				}
				data[$(element).attr('id')] = $(element).val(); //I hate javascript sometimes...
				jQuery.getJSON('../includes/data/users.php', data, function(data){
					$(savingElementName).removeClass('active');
				});
				$(element).data('initialData', $(element).val());
			}
		}
	</script>

<?php
	require_once('../includes/footer.php');
?>
