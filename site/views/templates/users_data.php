<!DOCTYPE html>
<html>
<head>
    <?php require "site/views/templates/head.php"; ?>

	<title>Vrijwilligers</title>
</head>
<body>

<header>
    
    <?php require "site/views/templates/userSettings.php"; ?>
    
    <?php require "site/views/templates/menu.php"; ?>
    
    <?php require "site/views/templates/logo.php"; ?>

	<div id="userData">


		<div class="userDataForms">

			<div class="avatar_data">

				<img src="" alt="" id="usersAvatar">

				<div id="personalData">


				</div>

			</div>

			<hr>

			<form class="userDataForm" action="" method="" enctype="multipart/form-data">

				<p class="error">Pas je persoonlijk gegevens aan</p>

				<div class="inputs">

					<div class="inputSurunder">

						<label for="">Pas je profiel foto aan</label>
						<input type="file" name="profilFoto" id="profilFoto">

					</div>

					<div class="inputSurunder">

						<label for="">Pas je email aan</label>
						<input type="email" name="" class="usersDataUpdate" id="email" placeholder="Nieuw email">

					</div>


				</div>

				<div class="inputs">

					<div class="inputSurunder">

						<label for="">Pas je wachtwoord aan</label>
						<input type="password" name="" placeholder="Nieuw wachtwoord" class="usersDataUpdate">

					</div>

					<div class="inputSurunder">

						<label for="">Geef je huidig wachtwoord om de gegevens aan te passen</label>
						<input type="password" name="" placeholder="Je huidig wachtwoord" id="userCurrentPass">

					</div>

				</div>
				<input type="submit" name="" value="Aanpassen" id="updatePersonalData">

			</form>

			<hr>

			<form class="universelForm" action="" method="">

				<p class="error">Verandert de universeel wachtwoord...</p>

				<div class="passes">

					<input type="password" name="" id="universalPass" placeholder="Veranderd de universel wachtwoord">
					<input type="password" name="" placeholder="Administrator wachtwoord" id="SuPass">

				</div>
				<input type="submit" name="" id="sUserCurentPass" value="Veranderen">

			</form>

		</div>

	</div>

</header>

<footer></footer>

</body>

</html>


<style media="screen" type="text/css">

	html, body {

		padding: 0px;
		margin: 0px;

	}

	.allMenus {

		top: 0px;
		z-index: 6;

	}

	#settingContainer {

		margin-bottom: -135px;
		z-index: 8;
		/*margin-left: 1050px;*/

	}

	#userData {

		width: 100%;
		height: auto;
		margin-top: 100px;
		margin-bottom: 50px;

	}

	.userDataForms {

		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		width: 100%;
		height: 100%;

	}

	.avatar_data {

		width: 50%;
		height: auto;
		display: flex;
		flex-direction: row;
		justify-content: center;
		align-items: center;
		margin-top: 20px;
		margin-bottom: 15px;

	}

	#usersAvatar {

		width: 150px;
		height: 150px;
		background-color: #030303;
		border: 2px solid #F7A61A;
		border-radius: 100%;
		margin-bottom: 5px;
		z-index: 4;

	}

	#personalData {

		width: 50%;
		height: auto;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-items: flex-start;
		margin-left: 15px;
		position: relative;
		bottom: 20px;

	}

	.userDatas {

		font-size: 22px;
		color: #030303;
		text-align: left;
		margin-bottom: -10px;

	}

	#userData hr {

		width: 90%;
		border: 1px solid #030303;
		margin-top: 5px;
		margin-bottom: 10px;
		margin-top: 10px;

	}

	#userData form {

		width: 90%;
		height: auto;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;

	}

	#userData form p {

		color: #030303;
		font-size: 18px;
		text-align: center;
		margin-bottom: 10px;

	}

	.inputs {

		width: 100%;
		height: auto;
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		justify-content: center;
		align-items: center;

	}

	.inputSurunder {

		width: 50%;
		height: auto;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-items: flex-start;

	}

	.inputSurunder label {

		color: #030303;
		text-align: left;
		font-size: 18px;
		margin-bottom: 5px;
		margin-top: 20px;

	}

	.inputSurunder input {

		width: 90%;
		height: 40px;
		padding-left: 20px;
		color: #030303;
		background-color: white;
		border: 1px solid #030303;
		border-radius: 3px;
		margin-bottom: 10px;
		margin-right: 10px;
		margin-left: 10px;
		font-size: 18px;

	}

	#userData form input[type="password"] {

		/*margin-left: 10px;*/

	}

	#userData form #userCurrentPass {

		/*  margin-left: 5px;*/

	}

	#userData form #updatePersonalData {

		width: 97%;
		height: 40px;
		text-align: center;
		cursor: pointer;
		color: white;
		border: 1px solid #F59C00;
		border-radius: 3px;
		background-color: #F59C00;
		font-size: 20px;
		margin-right: 30px;
		margin-bottom: 20px;

	}

	#userData form #updatePersonalData:hover {

		background-color: #905F08

	}

	#userData .universelForm {

		width: 90%;
		height: auto;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		opacity: 0;
		margin-top: 20px;

	}

	#userData .universelForm p {

		margin-top: 0px;

	}

	.passes {

		width: 100%;
		height: auto;
		display: flex;
		flex-direction: row;
		justify-content: center;
		align-items: center;

	}

	#userData .universelForm input {

		width: 50%;
		height: 40px;
		padding-left: 10px;
		color: #030303;
		background-color: white;
		border: 1px solid #C40606;
		border-radius: 3px;
		font-size: 18px;
		margin-left: 5px;
		margin-right: 5px;

	}

	#userData .universelForm input[type="submit"] {

		padding-left: 0px;
		text-align: center;
		color: white;
		background-color: #C40606;
		border: 1px solid #C40606;
		cursor: pointer;
		width: 100%;
		height: 40px;
		margin-top: 10px;
		font-size: 18px;

	}

	#userData .universelForm input[type="submit"]:hover {

		background-color: #E21B1B;

	}

	@media screen and (max-width: 1050px) {

		.inputs {

			flex-direction: column;

		}

		.inputSurunder {

			width: 90%;

		}

		.passes {

			flex-direction: column;

		}

		#userData .universelForm input {

			width: 90%;
			margin-bottom: 20px;

		}

		#userData .universelForm input[type="submit"] {

			width: 92%;

		}

	}

	@media screen and (max-width: 500px) {

		.inputSurunder input {

			width: 100%;
			margin-right: 0px;
			margin-left: 0px;

		}

	}

	@media screen and (max-width: 600px) {

		.avatar_data {

			flex-direction: column;

		}

		#personalData {

			margin-left: 0px;
			justify-content: center;
			align-items: center;

		}

	}


</style>


<script type="text/javascript">

	/* window.addEventListener("load", function(){
  
        $(function(){
  
          $(".universelForm").hide();
  
             var profile = document.getElementById("profile");
             var userData = document.getElementById("userData");
             var closeUserDataForm = document.getElementById("closeUserDataForm");
             var usersDataUpdate = document.querySelectorAll(".usersDataUpdate");
             var userCurrentPass = document.getElementById("userCurrentPass");
             var error = document.querySelector(".error");
             var profilImg = document.getElementById("profilFoto");
  
             var universalPass = document.getElementById("universalPass");
             var sUserCurentPass = document.getElementById("sUserCurentPass");
             var universalError = document.querySelector(".universelForm .error");
  
  
  
             closeUserDataForm.addEventListener("click", function(){
  
               $(userData).animate({
  
                  bottom: 700,
  
               },{
  
                 duration: 700,
                 easing: 'easeInOutBack',
  
               })
  
               $("#userData").hide("slow");
  
               usersDataUpdate[0].value = "";
               usersDataUpdate[1].value = "";
               userCurrentPass.value = "";
               profilImg.value = "";
               universalPass.value = "";
               sUserCurentPass.value = "";
  
  
               error.innerHTML = "Pas je persoonlijk gegevens aan";
               universalError.innerHTML = "Verandert de universeel wachtwoord...";
  
             })
  
  
        })
  
     })*/

</script>
