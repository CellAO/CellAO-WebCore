<?php 
    require_once('includes/config.php');
    require_once('includes/header.php');
?>
<div style="text-align: center; : 10px;">
    <form id="loginForm" name="loginForm" method="post" action="register-exec.php" style="clear: both;">
      <!-- <table border="0" align="center" cellpadding="2" cellspacing="0"> -->
        <!-- <tr> -->
          <!-- <td> -->
            <div style="border: 1px solid black; margin-top: 20px;"><input class="registerForm" value="First Name" name="fname" type="text" class="textfield" id="fname" alt="First Name"/></div>
        <!-- </td> -->
        <!-- </tr> -->
        <!-- <tr> -->
          <!-- <td> -->
            <div style="border: 1px solid black; margin-top: 2px;"><input class="registerForm" value="Last Name" name="lname" type="text" class="textfield" id="lname" alt="Last Name"/></div>
        <!-- </td> -->
        <!-- </tr> -->
        <!-- <tr> -->
          <!-- <td> -->
            <div style="border: 1px solid black; margin-top: 2px;"><input class="registerForm" value="Email Address" name="email" type="text" class="textfield" id="email" alt="Email Address"/></div>
        <!-- </td> -->
        <!-- </tr> -->
        <!-- <tr> -->
          <!-- <td> -->
            <div style="border: 1px solid black; margin-top: 2px;"><input class="registerForm" value="Username" name="login" type="text" class="textfield" id="login" alt="Username"/></div>
        <!-- </td> -->
        <!-- </tr> -->
        <!-- <tr> -->
          <!-- <td> -->
            <div style="border: 1px solid black; margin-top: 2px;"><input class="registerForm" value="Password" name="password" type="text" class="textfield" id="password" alt="Password"/></div>
        <!-- </td> -->
        <!-- </tr> -->
        <!-- <tr> -->
          <!-- <td> -->
            <div style="border: 1px solid black; margin-top: 2px;"><input class="registerForm" value="Password Again" name="cpassword" type="text" class="textfield" id="cpassword" alt="Password Again"/></div>
        <!-- </td> -->
        <!-- </tr> -->
      <!-- </table> -->
      <input type="submit" class="registerForm" style="margin-top: 5px;" name="Submit" value="Register" />
      <input type="button" id="cancelButton" class="registerForm" style="margin-top: 5px;" name="Submit" value="Cancel" />
    </form>
</div>
<script>
    $('.registerForm').on('focusin focusout', function(event){
        if($(this).attr('name') == 'password' || $(this).attr('name') == 'cpassword'){
            if($(this).val() != $(this).attr('alt')){
                if($(this).val() == ''){
                    $(this).attr('type', 'text');
                    $(this).val($(this).attr('alt'));
                }
            } else {
                $(this).attr('type', 'password');
                $(this).val('');
            }
        } else if($(this).attr('type') == "text"){
            if($(this).val() != $(this).attr('alt')){
                if($(this).val() == '')
                    $(this).val($(this).attr('alt'));
            } else {
                $(this).val('');
            }
        }
    });

    $('#cancelButton').on('click', function(event){
        window.location = 'index.php';
    });
</script>
<?php require_once('includes/footer.php'); ?>