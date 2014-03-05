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
	
	<div id="userInventory" style="margin-top: 50px;" class="section">
		<span class='sectionHeader'>Inventory:</span>
		<?php
		for($i = 0; $i <= 5; $i++){
			$output = '<div class="inventoryRow">';
			for($x = 0; $x <= 3; $x++){
				$output .= '<span class="inventorySlot" id="">Item</span>';
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
	<div id="searchBox" style="z-index: 50; display: none; ">
		<input type="text">
		<span id="searchCancelButton" style="position: relative; right: 20px; padding: 0px; opacity: 0.4;"><img src="../images/close_button.png"></span>
		<div id="searchResults">
		</div>
	</div>
	<script>
		$(document).ready(function(){
			jQuery.getJSON('../includes/data/users.php', {'action': 'getUserById', 'id': <?php echo($userId); ?>}, function(data){
				$("#GM option[value='-1']").remove()
				jQuery.each(data, function(key, data){
					$('#' + key).val(data);
				});
			});
			$('.charAttribute span input, .charAttribute span select').on('focusin', function(event){
				$(this).data('initialData', $(this).val());
			});
			$('.charAttribute span input, .charAttribute span select').on('focusout keyup', function(event){
				if(event.keyCode == 13 || event.type == "focusout")
					saveField(this);
			});
			$('.charAttribute span select ').on('click', function(event){
				saveField(this);
			});

			$('.inventorySlot').on('click', function(event){
				var position = $(this).offset();
				console.log(position);
				position.left += 10; 
				position.top += 10;
				$('#searchBox').show('slow').offset(position);
			});
			$('#searchCancelButton').click(function(event){
				$('#searchBox').hide('slow');
			});
			$(window).resize(function(){
				$('#searchBox').hide();
			});
			$('#searchBox input').on('keyup', function(event){
				switch(event.keyCode){
					case 13: 
						break;
					case 27: 
						console.log('hit');
						$('#searchBox').hide('slow');
					break;
				}
			}).bind("input propertychange", function (evt) {
				// If it's the propertychange event, make sure it's the value that changed.
				if (window.event && event.type == "propertychange" && event.propertyName != "value")
				return;

				// Clear any previously set timer before setting a fresh one
				window.clearTimeout($(this).data("timeout"));
				$(this).data("timeout", setTimeout(function () {
					$('#searchResults').html('<div class="searchResult"><img src="../images/processing.gif"> Searching...</div>');
					jQuery.getJSON('../includes/data/items.php', {'action': 'searchItems', 'query': $('#searchBox input').val(), 'limit': 5}, function(data){
						$('#searchResults').html('');
						if(data.length){
							jQuery.each(data, function(key, value){
								$('#searchResults').append('<div class="searchResult" id="item' + value.id + '" style="">');
								if(value.Icon == "0"){
									value.iconPath = '../images/no.png';
								} else {
									value.iconPath = '../images/icons/' + value.Icon + '.png'
								}
								$('#item' + value.id).append('<span><img class="itemIcon" src="' + value.iconPath + '">');
								$('#item' + value.id).append('<span><span class="itemName">' + value.Name + "</span></div>");
								$('.searchResult').click(function(event){
									console.log($(this).attr('id').substr(5));
								});;
							})
						} else {
							$('#searchResults').append('<div class="searchResult">No items found.</div>');
						}
						$('.searchResult').hover(function(event){
							if(event.type == "mouseenter"){
								$(this).addClass('searchResultHoverIn');
							} else {
								$(this).removeClass('searchResultHoverIn');
							}
						});
					});
				}, 1000));
			});
			function saveField(element){
				if($(element).data('initialData') != $(element).val()){
					var elementName = $(element).attr('id');
					var savingElementName = '#saving' + elementName;
					$(savingElementName).addClass('active');
					var data = {
						'action': 'updateUserAttribute', 
						'id': '<?php echo($userId); ?>'
					}
					data[$(element).attr('id')] = $(element).val(); //I hate javascript sometimes...
					jQuery.getJSON('../includes/data/users.php', data, function(data){
						$(savingElementName).removeClass('active');
					});
					$(element).data('initialData', $(element).val());
				}
			}

		});
	</script>

<?php
	require_once('../includes/footer.php');
?>
