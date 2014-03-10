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
		for($i = 0; $i <= 5; $i++){
			$output = '<div class="inventoryRow">';
			for($x = 0; $x <= 3; $x++){
				$output .= '<span class="inventorySlot" id="' . $i . $x . '"></span>';
			}
			$output .= '</div>';
			echo($output);
		} ?>
	</div>
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
				<input type="text" value="" id="Username" disabled />
			</span>
			<span id='savingUsername' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="HeadingW">HeadingW: </label>
			</span>
			<span>
				<input type="text" value="" id="HeadingW" />
			</span>
			<span id='savingHeadingW' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="HeadingX">HeadingX: </label>
			</span>
			<span>
				<input type="text" value="" id="HeadingX" />
			</span>
			<span id='savingHeadingX' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="HeadingY">HeadingY: </label>
			</span>
			<span>
				<input type="text" value="" id="HeadingY" />
			</span>
			<span id='savingHeadingY' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="HeadingZ">HeadingZ: </label>
			</span>
			<span>
				<input type="text" value="" id="HeadingZ" />
			</span>
			<span id='savingHeadingZ' class="savingIcon"></span>
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
				<label for="Name">Name: </label>
			</span>
			<span>
				<input type="text" value="" id="Name" />
			</span>
			<span id='savingName' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Textures0">Textures0: </label>
			</span>
			<span>
				<input type="text" value="" id="Textures0" />
			</span>
			<span id='savingTextures0' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Textures1">Textures1: </label>
			</span>
			<span>
				<input type="text" value="" id="Textures1" />
			</span>
			<span id='savingTextures1' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Textures2">Textures2: </label>
			</span>
			<span>
				<input type="text" value="" id="Textures2" />
			</span>
			<span id='savingTextures2' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Textures3">Textures3: </label>
			</span>
			<span>
				<input type="text" value="" id="Textures3" />
			</span>
			<span id='savingTextures3' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Textures4">Textures4: </label>
			</span>
			<span>
				<input type="text" value="" id="Textures4" />
			</span>
			<span id='savingTextures4' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="X">X: </label>
			</span>
			<span>
				<input type="text" value="" id="X" />
			</span>
			<span id='savingX' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Y">Y: </label>
			</span>
			<span>
				<input type="text" value="" id="Y" />
			</span>
			<span id='savingY' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="Z">Z: </label>
			</span>
			<span>
				<input type="text" value="" id="Z" />
			</span>
			<span id='savingZ' class="savingIcon"></span>
		</div>
		<div class="charAttribute">
			<span class="charAttrLabel">
				<label for="playfield">Playfield: </label>
			</span>
			<span>
				<input type="text" value="" id="playfield" />
			</span>
			<span id='savingplayfield' class="savingIcon"></span>
		</div>
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
			jQuery.getJSON('../includes/data/characters.php', {'action': 'getCharacterInfo', 'query': <?php echo $userId ?>}, function(data){
				jQuery.each(data, function(index, value){
					$('input#'+index).val(value);
				});
			});
		});

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
