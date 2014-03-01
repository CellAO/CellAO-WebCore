<?php
	require_once('configs/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>CellAO</title>
    <link rel="stylesheet" href="<?php echo THEME; ?>/css/style.css" type="text/css" />
</head>

<body>
<!-- Master Container: Centered and 700px wide -->
<div id="container">
    <!-- The topmost bar -->
    <div id="topbar">
	[<?php echo date('Y-m-d'); ?>] &nbsp;&nbsp;&nbsp;&nbsp; .:Cell AO - Serving the AO Community:.
    </div>
    <!-- End of top bar -->

    <!-- This holds the main header -->
    <div id="headerwrapper">

        <!-- This is the site title -->
        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cell AO</h1>
        <div>
            <!-- This is the site slogan -->
            <h6>
                &nbsp;
            </h6>
            <br />
        </div>
	</div>
	<!-- End of headerwrapper -->

    <!-- This hold the navigation tabs -->
    <div id="tabholder">
        <div id="tabs8">
            <ul>		
                <!-- CSS Tabs -->
        <?php require_once(THEME."/tabs.php");?>
            </ul>
        </div>
    </div>
    <!-- End of the tabs holder -->

    <!-- Here's the box for the main article -->
    <div class="articleboxouter">

    <!-- This is the login controls holder -->
        <div class="userform">
	<form id="loginForm" name="loginForm" method="post" action="process-login.php">
	<a href="/register-exec.php" class="userreg">Register</a>

            <!-- Lots of whitespace -->
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <!-- Here's your login controls -->
            Username
            <input type="text" name="login" id="login" size="15"/>
            Password
            <input type="password" name="password" id="password" size="15" />
            <input type="submit" name="Submit" value="Login" />
	</form>
        </div>
    <!-- End of the login controls holder -->

        <!-- Here's where you can place ur content -->
        <div class="articleboxinner2">
	<?php include "inc/articals.php" ?>
        </div>
        <!-- End of content holder -->
    </div>
    <!-- End of main article -->

    <!-- Here's the box for some pics, remove if not a photo gallery -->
    <div class="picboxouter">

        <!-- Here's where you can place ur thumbnails -->
        <!-- All should be uniformly sized ;-) -->
        <div class="picbox">

            <img src="<?php echo THEME; ?>images/f1.jpg" alt="help" class="pickboxcontrol" />
            <img src="<?php echo THEME; ?>images/f2.jpg" alt="help" class="pickboxcontrol" />
            <img src="<?php echo THEME; ?>images/f3.jpg" alt="help" class="pickboxcontrol" />
            <img src="<?php echo THEME; ?>images/f6.jpg" alt="help" class="pickboxcontrol" />
            <img src="<?php echo THEME; ?>images/f7.jpg" alt="help" class="pickboxcontrol" />
        </div>
    </div>
    <!-- End of photogallery -->

    <!-- We love three columns, don't we? -->
    <!-- Holder for three columns -->
    <div class="articleboxouterx">
        <div id="newsContainer2">

            <!-- Column 1 -->
    		<div class="c1">
    			<div class="noteheader">
    				&nbsp;PLAY FOR FREE
    			</div>
    			<div class="spacy">
Download the free client following the instructions below!<br>
<u>THE FULL CLIENT w/ALL EXPANSIONS</u><br>
<a href="http://l3cdn.ageofconan.com/download/AnarchyOnline_18.1.1-Large.exe"><b>Download the Full Client Here</b></a> <br>
The full Anarchy Online client includes the original Anarchy Online, Notum Wars, Shadowlands and Alien Invasion. This means that if you download this large client you can have access to all expansions if you upgrade your account accordingly.<br>
<u>THE SMALL CLIENT</u><br>
<a href="http://l3cdn.ageofconan.com/download/AnarchyOnline_18.1.1-Small.exe"><b>Download the Small Client Here</b></a><br>
If you used to Play Anarchy Online in the past you can of course use your old install files, however you will need to create a new account to take advantage of the freeplay offer.

    			</div>
    		</div>

    		<!-- Column 2 -->
            <div class="c2">
                <div class="noteheader">
                    &nbsp;Gameplay
                </div>
                <div class="spacy">Step almost 30,000 years into the future, to an age where common surgical implants and microscopic nano-bots can relieve most forms of human suffering.<br>
On the planet of Rubi-Ka, a battle rages between the haves and have-nots in a time when the clans seek liberation from the all-powerful Omni-Tek corporation in the name of justice, voluntarily if possible; from the barrel of a gun if necessary. The leaders of both sides are desperately seeking a solution that can stop the violence ravaging the planet, against a backdrop of betrayal, military raids and conniving political games, cyborg assassins and modified humans.
                </div>
            </div>

            <!-- Column 3 -->
            <div class="c3">
                <div class="noteheader">
                    &nbsp;Battlestation Changes
                </div>
                <div class="spacy">
    			<!-- The content for this attention grabbing block -->
                    Means steps up and talks about about the incoming PvP playfield and some new changes to the Battlestations!<br>
Unfortunately we did not get a chance to complete the documentation for Crats this week...despite working on it pretty much the entire time. This is the first pet class we have touched and there is a significant amount of change and adjustment that was required and we wanted to make sure all the changes/improvements we wanted for the profession were considered carefully before they were released...unfortunately we ran out of time...but the work is going well. The document will be released to the professionals next week.

              </div>
            </div>
        </div>
    </div>
    <!-- End of the three columns holder -->

    <!-- This little whitespace will separate the page from the footer -->
    <div id="i_bar">



    </div>

    <!-- Finally, here's the footer -->
    <div id="footer">

            Development: Prodigy &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(c) Copyright-Free CELL AO.
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; XHTML 1.0 Strict | Pure CSS Layout (CSS level 2.1)

    </div>
    <!-- End of footer -->

</div>
<!-- End of master container -->

</body>
</html>
