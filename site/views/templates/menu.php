<div class="allMenus">

	<div id="headContainer">


		<div id="menuItems">

			<div class="sidebarController">

				<img src="public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeSidebar">
				<img src="public/media/images/eraser.svg" alt="" id="editModeIcon">
				<!--<p id="editModeText">Bewerkingsmodus</p>-->

			</div>

			<!--<a href="vrijwilligers.php?page=vrijwilligers&id=<?php //echo $_SESSION['id'];?>" class="primairyMenu">HOME</a>-->
			<a href="index.php?page=blog&id=<?php echo $_SESSION['id']; ?>" class="primairyMenu">BLOG</a>
			<a href="index.php?page=smoelenboek&id=<?php echo $_SESSION['id']; ?>" class="primairyMenu">SMOELENBOEK</a>
			<a href="index.php?page=jaarOverzicht&id=<?php echo $_SESSION['id']; ?>" class="primairyMenu">JAAR
				OVERZICHT</a>
			<a href="index.php?page=tabblad&id=<?php echo $_SESSION['id']; ?>" class="primairyMenu">MEER</a>

			<!--<div class="allTabs">

                <div class="tabsContainer">

                    <p id='moreMenu'>Meer...</p>
                    <div class="MenuUpDoewnIcon">

                       <img src="public/media/menuIcon/svg/002-up-arrow.svg" alt="" id="tabUp">
                       <img src="public/media/menuIcon/svg/001-angle-arrow-down.svg" alt="" id="tabDown">

                    </div>

                </div>

                <div class="tabsLink">

                    <a href="vrijwilligers.php?page=tabblad&tab=vrijwilligersbeleid&id=<?php //echo $_SESSION['id'];?>"><p>RIJWILLIGERSBELEID</p></a>
                    <a href="vrijwilligers.php?page=tabblad&tab=contract&id=<?php //echo $_SESSION['id'];?>"><p>CONTRACT</p></a>
                    <a href="vrijwilligers.php?page=tabblad&tab=functieOmschrijvingen&id=<?php echo $_SESSION['id']; ?>"><p>FUNCTIE OMSCHRIJVING</p></a>
                    <a href="vrijwilligers.php?page=tabblad&tab=werkdagenKantoor&id=<?php //echo $_SESSION['id'];?>"><p>WERKDAGEN kANTOOR</p></a>
                    <a href="vrijwilligers.php?page=tabblad&tab=gastvrijheid&id=<?php //echo $_SESSION['id'];?>"><p>GASTVRIJHEID</p></a>

                </div>

          </div>-->


		</div>


		<div id="sideBar">


			<div class="menu" id="add">

				<img src="public/media/menuIcon/svg/001-add-button.svg" alt="">
				<p>Toevoegen</p>

			</div>


			<div class="menu" id="update">

				<img src="public/media/menuIcon/svg/004-bar-chart-reload.svg" alt="">
				<p>Aanpassen</p>

			</div>


			<div class="menu" id="delete">

				<img src="public/media/menuIcon/svg/003-rubbish.svg" alt="">
				<p>Verwijderen</p>

			</div>

			<!--<div class="menu">
    
                <img src="public/media/menuIcon/svg/003-rubbish.svg" alt="">
                <p>Calender</p>
    
            </div>-->

			<a href="index.php?page=userManager&id=<?php echo $_SESSION['id']; ?>" class="newUsers">

				<img src="public/media/menuIcon/svg/executive-manager.svg" alt="">
				<p>Gebruikers beheren</p>

			</a>

		</div>


		<img src="" alt="" id="profile">

	</div>

	<div class="openCloseMenu">

		<!--<img src="public/media/menuIcon/closeburgermenu.svg" alt="" id="closeBmenu">-->
		<img src="public/media/menuIcon/burgerMenu.svg" alt="" id="burgerMenu">

	</div>


	<div class="mobileMenu">


		<div class="menuBack">

		</div>

		<div class="menuFront">

			<div class="profileClose">

				<img src="public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeBmenu">

				<img src="" alt="" id="profile">

			</div>

			<div class="mobileMenuItems">

				<a href="index.php?page=jaarOverzicht&id=<?php echo $_SESSION['id']; ?>" id="mobileCalenda"><p>
						Agenda</p></a>


				<a href="index.php?page=vrijwilligers&id=<?php echo $_SESSION['id']; ?>"><p>Home</p></a>
				<a href="index.php?page=blog&id=<?php echo $_SESSION['id']; ?>"><p>Blog</p></a>
				<a href="index.php?page=smoelenboek&id=<?php echo $_SESSION['id']; ?>"><p>Smoelenboek</p></a>
				<a href="index.php?page=tabblad&id=<?php echo $_SESSION['id']; ?>"><p>Meer</p></a>
				<!--<a href="vrijwilligers.php?page=userManager&id=<?php echo $_SESSION['id']; ?>"><p>Gebruikers beheerder</p></a>-->
				<div id="tabsReceiver">

				</div>
				<!--<a href="vrijwilligers.php?page=tabblad&tab=vrijwilligersbeleid&id=<?php //echo $_SESSION['id'];?>"><p>Vrijwilligersbeleid</p></a>
        <a href="vrijwilligers.php?page=tabblad&tab=contract&id=<?php //echo $_SESSION['id'];?>"><p>Contract</p></a>
        <a href="vrijwilligers.php?page=tabblad&tab=functieOmschrijvingen&id=<?php //echo $_SESSION['id'];?>"><p>Functie omschrijvingen</p></a>
        <a href="vrijwilligers.php?page=tabblad&tab=werkdagenKantoor&id=<?php //echo $_SESSION['id'];?>"><p>Werkdagen kantoor</p></a>
        <a href="vrijwilligers.php?page=tabblad&tab=gastvrijheid&id=<?php //echo $_SESSION['id'];?>"><p>Gastvrijheid</p></a>-->

			</div>

			<div class="settingsLogout">

				<a href="index.php?page=instellingen&id=<?php echo $_SESSION['id']; ?>" class="settings"
				   id="userSettings">Instellingen</a>
				<a href="index.php?page=uitloggen" class="settings">Loguit</a>

			</div>

		</div>

	</div>

</div>


<style media="screen" type="text/css">


	.allMenus {

		width: 100%;
		height: auto;
		display: flex;
		flex-direction: row;
		justify-content: flex-end;
		align-items: center;
		position: relative;

	}

	#headContainer {

		width: 100%;
		height: 50px;
		opacity: 0;
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
		background-color: #030303;
		position: relative;
		z-index: 6;
		border-bottom: 1px solid white;

	}

	.openCloseMenu {

		width: auto;
		height: auto;
		opacity: 0;
		z-index: 12;
		margin-top: 70px;
		margin-left: -40px;
		position: fixed;
		right: 20px;

	}

	.openCloseMenu img {

		width: 40px;
		height: 40px;
		cursor: pointer;
		position: relative;
		z-index: 12;

	}

	.openCloseMenu #closeBmenu {

		opacity: 0;

	}

	#menuItems {

		width: auto;
		height: 100%;
		display: flex;
		flex-direction: row;
		justify-content: center;
		align-items: center;
		position: relative;
		top: 0px;
		margin-left: 0px;
		background-color: #111111;
		border-right: 1px solid white;

	}

	.sidebarController {

		display: flex;
		justify-content: center;
		align-items: center;
		cursor: pointer;
		display: none;
		width: auto;
		height: 35px;
		border-right: 1px solid white;
		padding-left: 30px;
		padding-right: 30px;

	}

	.sidebarController img {

		width: 30px;
		height: 30px;
		position: absolute;

	}

	#closeSidebar {

		opacity: 0;
		cursor: pointer;
		display: none;

	}

	#menuItems .primairyMenu {

		text-decoration: none;
		text-align: center;
		font-size: 17px;
		width: auto;
		height: 35px;
		padding-left: 20px;
		padding-right: 20px;
		padding-top: 15px;
		color: white;
		border-right: 1px solid white;

	}

	#menuItems .primairyMenu:hover {

		color: #F59C00;

	}

	#sideBar {

		width: auto;
		height: auto;
		display: flex;
		flex-direction: row;
		justify-content: center;
		align-items: center;
		opacity: 0;
		position: relative;
		display: none;
		/*top: 10px;*/

	}

	.allTabs {

		width: auto;
		height: auto;
		padding-left: 20px;
		padding-right: 35px;
		color: white;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-items: flex-start;

	}

	.tabsContainer {

		width: auto;
		height: 100%;
		color: white;
		display: flex;
		flex-direction: row;
		justify-content: center;
		align-items: center;

	}

	.tabsContainer:hover p {

		color: #EA9501;

	}

	.tabsContainer p {

		color: white;
		font-size: 18px;
		cursor: pointer;
		margin-right: 7px;
		position: relative;
		top: 2px;

	}

	.MenuUpDoewnIcon {

		width: auto;
		height: auto;

	}

	.MenuUpDoewnIcon img {

		width: 25px;
		height: 25px;
		top: 20px;
		color: #EA9501;
		cursor: pointer;

	}

	.MenuUpDoewnIcon img {

		position: absolute;

	}

	#tabUp {

		top: 15px;
		opacity: 0;

	}

	.tabsLink {

		width: auto;
		height: 300px;
		background-color: #030303;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		position: relative;
		top: 149px;
		right: 21px;
		border: 1px solid #030303;
		border-left: 3px solid #030303;
		overflow-y: scroll;
		opacity: 0;
		z-index: 12;

	}

	.tabsLink a:hover {

		background-color: #030303;

	}

	.tabsLink a:hover p {

		color: white;

	}

	.tabsLink a {

		width: 300px;
		height: auto;
		text-decoration: none;
		background-color: white;
		border-bottom: 1px solid #030303;
		display: flex;
		justify-content: flex-start;
		align-items: center;

	}

	.tabsLink a p {

		text-align: left;
		color: #030303;
		font-size: 18px;
		width: auto;
		height: auto;
		padding-left: 10px;
		padding-right: 10px;

	}

	.newUsers {

		width: auto;
		height: auto;
		text-decoration: none;
		display: flex;
		flex-direction: row;
		justify-content: center;
		align-items: center;
		margin-left: 10px;
		margin-right: 10px;

	}

	.newUsers img {

		width: 35px;
		height: 35px;

	}

	.newUsers p {

		text-align: center;
		color: white;
		font-size: 16px;
		margin-left: 3px;

	}

	.menu {

		width: auto;
		height: auto;
		display: flex;
		flex-direction: row;
		justify-content: center;
		align-items: center;
		margin-left: 25px;
		margin-right: 25px;
		cursor: pointer;
		z-index: 7;

	}

	.menu:hover img {

		width: 25px;
		height: 25px;

	}

	.menu img {

		width: 25px;
		height: 25px;

	}

	.menu p {

		text-align: center;
		color: white;
		font-size: 15px;
		margin-left: 3px;

	}

	#profile {

		width: 40px;
		height: 40px;
		border: 1px solid #F7A61A;
		border-radius: 100%;
		background-color: white;
		cursor: pointer;
		margin-right: 50px;

	}

	.mobileMenu {

		width: 70%;
		height: 100vh;
		margin-top: -1050px;
		/* margin-left: -539px;*/
		position: fixed;
		top: 1050px;
		z-index: 12;
		display: none;

	}

	.menuBack {

		width: 100%;
		height: 100%;
		background-color: #030303;
		position: absolute;

	}

	.menuFront {

		width: 100%;
		height: 100%;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		align-items: center;
		position: absolute;

	}

	.profileClose {

		width: 100%;
		height: 25%;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		background-color: #111111;
		border: 1px solid #111111;

	}

	#closeBmenu {

		width: 25px;
		height: 25px;
		margin-bottom: -20px;
		margin-top: 0px;
		margin-left: 70%;
		cursor: pointer;

	}

	.mobileMenu #profile {

		width: 70px;
		height: 70px;
		border: 1px solid #F7A61A;
		border-radius: 100%;
		background-color: white;
		cursor: pointer;
		margin-left: 30px;
		margin-top: 20px;
		/*  margin-bottom: 30px;*/

	}

	.mobileMenuItems {

		width: 100%;
		height: 70%;
		display: flex;
		flex-direction: column;
		/* justify-content: center;*/
		align-items: center;
		border: 1px solid #F59C00;
		border-left: 0px;
		background-color: white;
		overflow-y: scroll;

	}

	#mobileCalenda {

		color: white;
		font-size: 18px;
		cursor: pointer;
		background-color: #F59C00;
		width: 100%;
		height: auto;
		padding-top: 5px;
		padding-bottom: 5px;
		border-bottom: 2px solid white;
		text-align: center;
		margin-bottom: 0px;
		text-decoration: none;

	}

	#mobileCalenda:hover {

		background-color: #905F08;

	}

	#tabsReceiver {

		width: 100%;
		height: auto;
		display: flex;
		flex-direction: column;
		align-items: center;

	}

	.mobileMenuItems a {

		width: 99.5%;
		height: auto;
		text-decoration: none;
		color: white;
		border-bottom: 1px solid #F59C00;
		/*   margin-bottom: 2px;*/

		/*   border-right: 1px solid #F59C00;
           border-left: 1px solid #F59C00;*/
		font-size: 18px;
		text-align: center;
		display: flex;
		justify-content: flex-start;
		align-items: flex-start;
		background-color: white;

	}

	.mobileMenuItems a p {

		font-size: 18px;
		color: #030303;
		text-align: left;
		width: 98%;
		height: auto;
		padding-left: 20px;

	}

	.mobileMenuItems a:first-child {

		border-top: 1px solid #F59C00;

	}

	.mobileMenuItems :hover {

		background-color: #F59C00;

	}

	#tabsReceiver:hover {

		background-color: #F59C00;

	}

	.settingsLogout {

		width: 100%;
		height: 5%;
		display: flex;
		flex-direction: row;
		/*flex-wrap: wrap;*/
		justify-content: center;
		align-items: center;
		margin-bottom: 4px;
		margin-top: 15px;

	}

	.settings, #userSettings {

		width: 50%;
		height: 100%;
		padding-top: 15px;
		padding-bottom: 15px;
		/*  border-bottom: 1px solid #F59C00;
          border-top: 1px solid #F59C00;
          border-right: 1px solid #F59C00;
          border-left: 1px solid #F59C00;*/
		color: white;
		font-size: 17px;
		cursor: pointer;
		text-align: center;
		text-decoration: none;

	}

	#userSettings:hover, .settings:hover {

		background-color: #F59C00;

	}

	#userSettings {

		background-color: #3AC162;
		border: 1px solid #3AC162;

	}

	.settings {

		background-color: red;
		border: 1px solid red;
		color: white;

	}


</style>


<script type="text/javascript">

	window.addEventListener("load", function () {

		$(function () {

			var screenWidth = screen.width;

			$(".mobileMenu").hide();
			$(".openCloseMenu").hide();
			//$("#mobileAgenda").hide();
			$(".tabsLink").hide();

			var headContainer = document.getElementById("headContainer");

			if (navigator.userAgent == "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0") {


				headContainer.style.top = "0px";
				$(".allMenus").css("top", "0px");

			}

			var screenWidth = screen.width;
			var w = window.innerWidth;


			if (w <= 800) {

				$(".openCloseMenu").css("opacity", "1");
				$("#agenda").hide();

			} else {

				$("#agenda").show("slow");
				$("#agenda").css("opacity", "0.95");

			}


			showHideBmenu();

			window.addEventListener("resize", showHideBmenu);

			function showHideBmenu() {

				$(".sidebarController").hide();

				var screenWidth = screen.width;
				var windowWidht = window.innerWidth;
				// alert(w);

				if (windowWidht <= 800) {

					//$(".allMenus").hide();alert();

					showBmenuIcon();
					$("#settingContainer").hide();
					//$("#userData").hide();
					$(".forms").hide();


				} else if (windowWidht > 800) {

					hideBmenuIcon();
					$(".mobileMenu").hide();
					// $("#settingContainer").show();
					// $("#userData").show();
					$(".forms").show();


				}


				if (windowWidht < 1100) {

					$("#editModeText").hide();
					$("#editModeIcon").hide();
					$("#closeSidebar").hide();
					$(".sidebarController").hide("slow");
					$("#sideBar").hide();
					$("#agenda").hide("slow");
					//  $("#mobileAgenda").show();
					//$("#mobileAgenda").css("display","block");

				} else {

					$("#editModeText").show("slow");
					$("#editModeIcon").show("slow");
					$(".sidebarController").show("slow");
					$("#agenda").show("slow");
					$("#agenda").css("opacity", "0.95");
					//$("#mobileAgenda").hide();
					//$("#mobileAgenda").css("display","none");
					//$("#closeSidebar").show("slow");
					//$("#sideBar").show("slow");

				}


			}


			$("#closeBmenu").click(hideBmenu);
			$("#burgerMenu").click(showBmenu);


			function showBmenu() {

				//  $("#burgerMenu").hide("slow");
				//  $("#closeBmenu").show("slow");
				$(".mobileMenu").show("slow");


			}


			function hideBmenu() {

				//  $("#burgerMenu").show("slow");
				//  $("#closeBmenu").hide("slow");
				$(".mobileMenu").hide("slow");


			}


			function showBmenuIcon() {

				$(".openCloseMenu").show("slow");
				$("#headContainer").hide("slow");

			}


			function hideBmenuIcon() {

				$(".openCloseMenu").hide("slow");
				$(".openCloseMenu").css("opacity", "1");
				$("#headContainer").show("slow");
				$("#headContainer").css("opacity", "1");

			}


			$("#tabUp").click(tabUp);
			$("#tabDown").click(tabDown);


			function tabDown() {

				$(".tabsLink").css("opacity", "1");
				$(".tabsLink").show("slow");
				$("#tabDown").hide("slow");
				$("#tabUp").css("opacity", "1");
				$("#tabUp").show("slow");

				$(".tabsContainer p").css("top", "152px");

			}


			function tabUp() {

				$(".tabsLink").hide("slow");
				$(".tabsLink").css("opacity", "0");
				$("#tabUp").css("opacity", "0");
				$("#tabUp").hide("slow");
				$("#tabDown").show("slow");

				$(".tabsContainer p").css("top", "2px");


			}


		})


	})

</script>
