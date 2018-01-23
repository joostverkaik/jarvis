<div id="heads">

	<a href="index.php?page=vrijwilligers&id=<?php echo $_SESSION['id']; ?>" class="logoCont">

		<img src="public/media/podiumDeFluxLogo.png" id="logo" alt="">

		<!--<p id="willigers">vrijwilligers</p>-->

	</a>


	<div class="sidebarContainer">

		<!--<div class="sidebarController">
   
           <img src="public/media/images/eraser.svg" alt="" id="editModeIcon">
           <p id="editModeText">Bewerkingsmodus</p>
   
        </div>-->

		<!--<img src="public/media/menuIcon/svg/004-x-button.svg" alt="" id="closeSidebar">-->

	</div>


</div>

<style media="screen" type="text/css">

	#heads {

		width: auto;
		height: auto;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-items: flex-start;
		margin-top: 40px;
		margin-left: 5%;
		z-index: 5;

	}

	.logoCont {

		display: flex;
		flex-direction: column;
		justify-content: center;
		align-content: center;
		width: auto;
		height: auto;
		padding-bottom: 0px;
		margin-bottom: -120px;
		text-decoration: none;

	}

	#logo {

		/*width: 70%;*/
		height: 90px;
		border-radius: 3px;
		cursor: pointer;

	}

	/*#logoText
    {
    
       display: flex;
       flex-direction: column;
       justify-content: flex-start;
       align-items: flex-start;
       width: auto;
       height: 90px;
       margin-left: 20px;
    
    }
    
    
    #logoText h1
    {
    
       text-align: center;
       color: #030303;
       margin-bottom: 0px;
       margin-top: -5px;
    
    }
    
    
    #logoText h1:nth-child(2)
    {
    
       position: relative;
       top: 3px;
    
    }
    
    
    #logoText p
    {
    
      text-align: center;
      font-size: 17px;
      color: #030303;
      margin-top: 3px;
    
    }*/

	#willigers {

		text-align: center;
		font-size: 17px;
		color: #030303;
		margin-top: -20px;
		margin-left: 50px;

	}

	.sidebarContainer {

		width: auto;
		height: auto;
		display: flex;
		flex-direction: row;
		justify-content: center;
		align-items: center;

	}

	/*.sidebarController
    {
    
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        display: none;
    
    }
    
    
    .sidebarController img
    {
    
       width: 30px;
       height: 30px;
    
    }
    
    
    .sidebarController p
    {
    
        text-align: center;
        color: #006DF0;
        font-size: 20px;
        margin-left: 5px;
    
    }
    
    
    .sidebarController p:hover
    {
    
      color: #EA9501;
    
    }
    
    
    #closeSidebar
    {
    
       width: 35px;
       height: 35px;
       margin-left: 5px;
       opacity: 0;
       cursor: pointer;
       display: none;
    
    }
    
    
    #closeSidebar:hover
    {
    
       width: 30px;
       height: 30px;
    
    }*/

</style>
