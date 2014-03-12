<?php
	isset($_REQUEST['id']) ? $userId = $_REQUEST['id'] : $userId = "";
	define('GM_REQUIRED', True);
	define("PRE_LINK", "../");
	$includeCSSFiles[] = '../css/editUser.css';
	$includeJavascriptFiles[] = '../js/editCharacter.js';
	require_once('../includes/header.php');
	if($userId == ""){
		header("Location: findUser.php");
		exit;
	}
?>
	
	<div id="userInventory" style="margin-top: 50px;" class="section">
		<span class='sectionHeader'>Inventory:</span>
		<?php
		for($y = 0; $y <= 6; $y++){
			$output = '<div class="inventoryRow">';
			for($x = 0; $x <= 3; $x++){
				$output .= '<span class="inventorySlot" id="inventory' . $y . $x . '"></span>';
			}
			$output .= '</div>';
			echo($output);
		} ?>
		<button id='updateInventory'>Refresh</button><span id='updatingInventory' class="savingIcon"></span>

	</div>
	<div id="editUser" class="indentedContent section">
	<span class="sectionHeader">User Attributes:</span> 
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Id">Id: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="Id" disabled />
			</span>
			<span id='savingUsername' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Username">Username: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="Username" disabled />
			</span>
			<span id='savingUsername' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="HeadingW">HeadingW: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="HeadingW" />
			</span>
			<span id='savingHeadingW' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="HeadingX">HeadingX: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="HeadingX" />
			</span>
			<span id='savingHeadingX' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="HeadingY">HeadingY: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="HeadingY" />
			</span>
			<span id='savingHeadingY' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="HeadingZ">HeadingZ: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="HeadingZ" />
			</span>
			<span id='savingHeadingZ' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="FirstName">FirstName: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="FirstName" />
			</span>
			<span id='savingFirstName' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="LastName">LastName: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="LastName" />
			</span>
			<span id='savingLastName' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Name">Name: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="Name" />
			</span>
			<span id='savingName' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Textures0">Textures0: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="Textures0" />
			</span>
			<span id='savingTextures0' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Textures1">Textures1: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="Textures1" />
			</span>
			<span id='savingTextures1' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Textures2">Textures2: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="Textures2" />
			</span>
			<span id='savingTextures2' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Textures3">Textures3: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="Textures3" />
			</span>
			<span id='savingTextures3' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Textures4">Textures4: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="Textures4" />
			</span>
			<span id='savingTextures4' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="X">X: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="X" />
			</span>
			<span id='savingX' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Y">Y: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="Y" />
			</span>
			<span id='savingY' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Z">Z: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="Z" />
			</span>
			<span id='savingZ' class="savingIcon loadingCharAttribute"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="playfield">Playfield: </label>
			</span>
			<span>
				<input type="text" value="" class="charAttribute" id="playfield" />
			</span>
			<span id='savingplayfield' class="savingIcon loadingCharAttribute"></span>
		</div>
		<button id="updateCharAttributes">Refresh</button>
	</div>
	<div id="itemSearchBox" style="z-index: 50; display: none; ">
		<input type="text">
		<span id="searchCancelButton" style="position: relative; right: 20px; padding: 0px; opacity: 0.4;"><img src="../images/close_button.png"></span>
		<div id="searchResults">
		</div>
	</div>
	<script>
		window['userId'] = <?php echo $userId ?>;
		$(document).ready(function(){
			updateCharAttributes();
			updateInventory();
		});
		$('#updateInventory').click(function(event){
			updateInventory();
		});
		$('#updateCharAttributes').click(function(event){
			updateCharAttributes();
		})

		function updateCharAttributes(){
			$('.loadingCharAttribute').addClass('active');
			$('.charAttribute').val('');
			jQuery.getJSON('../includes/data/characters.php', {'action': 'getCharacterInfo', 'query': <?php echo $userId ?>}, function(data){
				jQuery.each(data, function(index, value){
					$('input#'+index).val(value);
				});
				$('.loadingCharAttribute').removeClass('active');
			});
		}

		function updateInventory(){
			$('#updatingInventory').addClass('active');
			$('.inventorySlot').unbind('click');
			$('.inventorySlot').css('background-image', 'none');
			$('.inventorySlot').attr('title', '');
			jQuery.getJSON('../includes/data/items.php', {'action': 'getUsersInventory', 'query': window['userId']}, function(data){
				var invSlotX = 0;
				var invSlotY = 0;
				jQuery.each(data, function(index, item){
					
					if(invSlotX > 3){
						invSlotX = 0;
						invSlotY++;
					}
					var currentInvSlot = $('.inventorySlot#inventory' + invSlotY + invSlotX);
					$(currentInvSlot).css('background-image', 'url(../images/icons/' + item.Icon + '.png)');
					$(currentInvSlot).attr('title', 'QL: ' + item.Quality + "\n" + item.Name);
					$(currentInvSlot).unbind('click');
					$(currentInvSlot).click(function(event){
						window.open('https://aoitems.com/item/' + item.HighId, '_blank');
					})
					invSlotX++;
				})
				$('#updatingInventory').removeClass('active');
			});
		}

		function saveField(element){
			if($(element).data('initialData') != $(element).val()){
				var elementName = $(element).attr('id');
				var savingElementName = '#saving' + elementName;
				$(savingElementName).addClass('active');
				var data = {
					'action': 'udpateCharacterAttribute', 
					'query': '<?php echo($userId); ?>'
				}
				data[$(element).attr('id')] = $(element).val(); //I hate javascript sometimes...
				jQuery.getJSON('../includes/data/characters.php', data, function(data){
					if(data.success){
						$(savingElementName).removeClass('active');
					}
				});
				$(element).data('initialData', $(element).val());
			}
		}
	</script>

<?php
	require_once('../includes/footer.php');
?>
