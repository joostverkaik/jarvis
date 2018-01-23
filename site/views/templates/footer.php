<footer id="footer">

	<p>Copyright 2017 Podium DE FLUX. All Rights Reserved.</p>

	<!--<div class="foot">
  
       <div class="footElems">
  
         <a href="#">vrijwilligersbeleid </a>
          <a href="#">contract</a>
  
       </div>
  
       <div class="footElems">
  
         <a href="#">functie omschrijvingen</a>
          <a href="#">huisregels </a>
  
       </div>
  
       <div class="footElems">
  
         <a href="#">werkdagen kantoor </a>
          <a href="#">gastvrijheid</a>
  
       </div>
  
    </div>-->

</footer>


<style media="screen" type="text/css">

	footer {

		width: 100%;
		height: auto;
		padding-top: 10px;
		padding-bottom: 10px;
		background-color: #030303;
		position: relative;
		opacity: 0;
		/*margin-top: -250px;*/

	}

	footer p {

		color: white;
		font-size: 20px;
		text-align: center;

	}

	.foot {

		width: 100%;
		height: 100%;
		display: flex;
		flex-direction: row;
		justify-content: center;
		align-items: center;
		z-index: 0;

	}

	.footElems {

		width: auto;
		height: auto;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		align-items: flex-start;
		margin-left: 50px;
		margin-right: 50px;

	}

	.footElems a {

		text-decoration: none;
		color: white;
		font-size: 20px;
		margin-top: 10px;
		margin-bottom: 10px;

	}

	.footElems a:hover {

		color: #F59C00;

	}


</style>


<script type="text/javascript">

	window.addEventListener("load", function () {

		var footer = document.getElementById("footer");
		footer.style.transition = "opacity 1.0s linear 1s";
		footer.style.opacity = "0.7";

	})

</script>
