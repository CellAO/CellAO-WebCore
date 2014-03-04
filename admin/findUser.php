<?php
	define('GM_REQUIRED', True);
	define("PRE_LINK", "../");
	$includeJavascriptFiles[] = '../js/jquery.dynatable.js';
	$includeCSSFiles[] = '../css/jquery.dynatable.css';
	isset($_REQUEST['callback']) ? $callbackPage = $_REQUEST['callback'] : $callbackPage = "";
	require_once('../includes/header.php');
?>
	<div style="display: inline-block;" class="indentedContent">
	<table id="resultTable">
		<thead>
			<tr>
				<th>Id</th>
				<th>Username</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Access</th>
				<th>Creation Date</th>
				<?php if($callbackPage == ""){ ?>
					<th>Edit</th>
					<th>Delete</th>
				<?php } else { ?>
					<th>Select</th>
				<?php }	?>

			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
	<script>
		$(document).ready(function(){
			jQuery.getJSON('../includes/data/users.php', {'action': 'getAllUsers'}, function(data){
				$('#resultTable').dynatable({
					dataset: {
						records: data,
					}, 
					writers: {
						_rowWriter: function(rowIndex, record, columns, cellWriter){
							var cssStyle = "";
							var userLevel = "User";

							if (rowIndex % 2 === 0) { cssStyle += 'odd'; }
							
							if(record.GM > 0 && record.GM < 100){
								userLevel = "GM";
							} else if(record.GM > 100){
								userLevel = "Administrator";
							}
							//Yeah, there's a better way to do this.
							//TODO: Fix how we're alternating colors here. 
							var returnData = "<tr>";
							returnData += "<td id='userId' class='" + cssStyle + "'>" + record.Id + "</td>";
							returnData += "<td id='username' class='" + cssStyle + "'>" + record.Username + "</td>";
							returnData += "<td id='firstName' class='" + cssStyle + "'>" + record.FirstName + "</td>";
							returnData += "<td id='lastName' class='" + cssStyle + "'>" + record.LastName + "</td>";
							returnData += "<td id='userLevel' class='" + cssStyle + "'>" + userLevel + "</td>";
							returnData += "<td id='creationDate' class='" + cssStyle + "'>" + record.CreationDate + "</td>";
							<?php if($callbackPage == ""){ ?>
								returnData += "<td class='" + cssStyle + "'><button id='" + record.Id + "' class='editUser'>Edit</button></td>";
								returnData += "<td class='" + cssStyle + "'><button id='" + record.Id + "' class='deleteUser'>Delete</button></td>";
							<?php } else { ?>
								returnData += "<td class='" + cssStyle + "'><button id='" + record.Id + "' class='selectUser'>Select</button></td>";
							<?php }	?>
							returnData += "</tr>";
							return returnData;
						}
					}, 
					});
					<?php if($callbackPage == ""){ ?>
						$('.editUser').on('click', function(){
							window.location = 'editUser.php?id=' + $(this).attr('id');
						});
						$('.deleteUser').on('click', function(){
							window.location = 'deleteUser.php?id=' + $(this).attr('id');
						});	
					<?php } else { ?>
						$('.selectUser').on('click', function(){
							window.location = '<?php echo($callbackPage); ?>?id=' + $(this).attr('id');
						});	
					<?php }	?>
				});
		});
	</script>
<?php
	require_once('../includes/footer.php');
?>
