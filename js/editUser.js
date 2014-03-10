$(document).ready(function(){
	$('.charAttribute span input, .charAttribute span select').on('focusin', function(event){
		$(this).data('initialData', $(this).val());
	});
	$('.charAttribute span input, .charAttribute span select').on('focusout keyup', function(event){
		if(event.keyCode == 13 || event.type == "focusout")
			saveField(this);
	});
	$('.charAttribute span select').on('click', function(event){
		saveField(this);
	});
	$('#editCharacter').click(function(event){
		if($('#characterList').val() != "")
			window.location = "editCharacter.php?id=" + $('#characterList').val(); 
	})
});