<div class="parametersContainer">

	<div id="settingContainer">

		<img src="public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeUserSettings">

		<a href="index.php?page=instellingen&id=<?php echo $_SESSION['id']; ?>" class="settings" id="userSettings">Instellingen</a>
		<a href="index.php?page=uitloggen" class="settings">Loguit</a>

	</div>

</div>


<style media="screen" type="text/css">


	.parametersContainer {

		width: 97%;
		height: auto;
		display: flex;
		justify-content: flex-end;

	}

	#settingContainer {

		width: 250px;
		height: auto;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-items: flex-end;
		border: 1px solid #F59C00;
		background-color: #030303;
		z-index: 8;
		position: relative;
		bottom: 200px;
		/*  margin-left: 80%;*/

	}

	#closeUserSettings {

		width: 25px;
		height: 25px;
		margin-right: 10px;
		margin-top: 15px;
		margin-bottom: 15px;
		cursor: pointer;

	}

	#settingContainer .settings {

		color: white;
		width: 100%;
		height: auto;
		text-align: center;
		font-size: 20px;
		padding-top: 7px;
		padding-bottom: 7px;
		cursor: pointer;
		background-color: #030303;
		border: 0px;
		/* border-bottom: 1px solid #F59C00;*/
		border-top: 1px solid #F59C00;
		text-decoration: none;

	}

	#settingContainer .settings:hover {

		background-color: #F59C00;

	}


</style>


<script type="text/javascript">

	window.addEventListener("load", function () {

		$(function () {

			$("#settingContainer").hide();

			if (navigator.userAgent == "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0") {


				$("#settingContainer").css("margin-bottom", "-135px");

			}

			var profile = document.getElementById("profile");
			var closeUserSettings = document.getElementById("closeUserSettings");
			var settingContainer = document.getElementById("settingContainer");
			var userSettings = document.getElementById("userSettings");
			var userData = document.getElementById("userData");


			profile.addEventListener("click", function () {

				$("#settingContainer").show();

				$(settingContainer).animate({

					bottom: -60,

				}, {

					duration: 700,
					easing: 'easeOutBack',

				})

			})


			userSettings.addEventListener("click", function () {

				$(userData).css("opacity", "1");

				$(userData).animate({

					bottom: 0,

				}, {

					duration: 700,
					easing: 'easeOutBack',

				})

				$("#userData").show();

			})


			closeUserSettings.addEventListener("click", function () {

				$(settingContainer).animate({

					bottom: 200,

				}, {

					duration: 700,
					easing: 'easeInOutBack',

				})

			})


		})

	})

</script>
