$(document).ready(function(){
	var clickedItemBox = 0;
	$('.inventorySlot').on('click', function(event){
		$('#searchResults').html('');
		clickedItemBox = $(this).attr('id');
		var position = $(this).offset();
		position.left += 10; 
		position.top += 10;
		$('#itemSearchBox').show('slow').offset(position);
	});
	$('#searchCancelButton').click(function(event){
		$('#itemSearchBox').hide('slow');
	});
	$(window).resize(function(){
		$('#itemSearchBox').hide();
	});
	$('#itemSearchBox input').on('keyup', function(event){
		switch(event.keyCode){
			case 13: 
				break;
			case 27: 
				$('#itemSearchBox').hide('slow');
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
			jQuery.getJSON('../includes/data/items.php', {'action': 'searchItems', 'query': $('#itemSearchBox input').val(), 'limit': 5}, function(data){
				$('#searchResults').html('');
				if(data.length){
					jQuery.each(data, function(key, value){
						if(value.Icon != "0"){
							value.iconPath = '../images/icons/' + value.Icon + '.png'
							$('#searchResults').append('<div class="searchResult" title="' + value.Name + '" id="item' + value.id + '" icon="' + value.iconPath + '" style="">');
							$('#item' + value.id).append('<span><img class="itemIcon" src="' + value.iconPath + '">');
							$('#item' + value.id).append('<span><span class="itemName">' + value.Name + "</span></div>");
						} else {
							//If we want to display items without icons, this would be the place to do it.
							//Would need to include showNoIconItems=true in the item query also.
							value.iconPath = '../images/icons/no.png'
						}
					});
					$('.searchResult').click(function(event){
						var iconPath = $(this).attr('icon');
						var itemName = $(this).attr('title');
						var itemQL = window.prompt("QL: ","1");
						if(isNumber(itemQL)){
							$('.inventorySlot#' + clickedItemBox).addClass('active');
							jQuery.getJSON('../includes/data/items.php', {'action': 'spawnItemForUser', 'userId': window['userId'], 'itemId': $(this).attr('id').substr(5), 'ql': itemQL}, function(data){
								if(data.success){
									$('.inventorySlot#' + clickedItemBox).css("background-image", "url(" + iconPath + ")");
									$('.inventorySlot#' + clickedItemBox).attr('title', itemName)
								}
								$('.inventorySlot#' + clickedItemBox).removeClass('active');
							});
							$('#itemSearchBox').hide('slow');
							$('#searchResults').html('');
						}
					});
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

	$('.charAttribute span input, .charAttribute span select').on('focusin', function(event){
		$(this).data('initialData', $(this).val());
	});
	$('.charAttribute span input, .charAttribute span select').on('focusout keyup', function(event){
		if(event.keyCode == 13 || event.type == "focusout")
			saveField(this);
	});
	function isNumber(n) {
		return !isNaN(parseFloat(n)) && isFinite(n);
	}
});