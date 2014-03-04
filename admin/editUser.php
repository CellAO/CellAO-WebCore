<?php
	isset($_REQUEST['id']) ? $userId = $_REQUEST['id'] : $userId = "";
	define('GM_REQUIRED', True);
	define("PRE_LINK", "../");
	$includeCSSFiles[] = '../css/editUser.css';
	require_once('../includes/header.php');
	if($userId == ""){
		header("Location: findUser.php");
		exit;
	}
?>
	<div id="editUser" class="indentedContent">
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
				<input type="text" value="" id="GM" />
			</span>
			<span id='savingGM' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Expansions">Expansions: </label>
			</span>
			<span>
				<input type="text" value="" id="Expansions" />
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
	<div id="userInventory" style="margin-top: 50px; "class="">
		<div class='inventoryRow'>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
		</div>
		<div class='inventoryRow'>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
		</div>
		<div class='inventoryRow'>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
		</div>
		<div class='inventoryRow'>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
		</div>
		<div class='inventoryRow'>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
		</div>
		<div class='inventoryRow'>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
			<span class="inventorySlot" id="">Item</span>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			jQuery.getJSON('../includes/data/users.php', {'action': 'getUserById', 'id': <?php echo($userId); ?>}, function(data){
				jQuery.each(data, function(key, data){
					$('#' + key).val(data);
					// console.log(key);
				});
			});
			$('.charAttribute span input').on('focusin', function(event){
				$(this).data('initialData', $(this).val());
			});
			$('.charAttribute span input').on('focusout', function(event){
				if($(this).data('initialData') != $(this).val()){

					var elementName = $(this).attr('id');
					var savingElementName = '#saving' + elementName;
					$(savingElementName).addClass('active');
					var data = {
						'action': 'updateUserAttribute', 
						'id': '<?php echo($userId); ?>'
					}
					data[$(this).attr('id')] = $(this).val(); //I hate javascript sometimes...
					jQuery.getJSON('../includes/data/users.php', data, function(data){
						$(savingElementName).removeClass('active');
					});
					$(this).data('initialData', $(this).val());
				}
			});
		});
	</script>

<?php
	require_once('../includes/footer.php');
?>
