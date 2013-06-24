<html>
<head>
	<title>CSS Training</title>
	<style>
		body {font-family: helvetica, arial, sans-serif;font-size:1em; margin:0px; background-color:#caebff;}
		
		/* EXAMPLE 1 ----------------------------------------------------
		p {margin:0; border:1px solid red;}*/
		/*p {float: left; margin:0; width:200px; border:1px solid red;}*/
		/*img {float:left; margin:0 4px 4px 0;}
		END EXAMPLE 1 --------------------------------------------------*/
	
		section {border:1px solid blue;} /*Can add Overflow Hiddent */
		
		img {float:left;}

		p {margin: 0;}
		
		.clear_me {clear:left;}

		footer {border:1px solid red;}
	</style>
<body>
	<section>

		<img src="<?php base_url();?>assets/img/dsp-logo.png">
		
		<p>It's fun to float.</p>
		
		<div class="clear_me"></div>
	</section>

	<footer>
		Here is the footer element that runs across the bottom of the page.
	</footer>
	<!-- <p>This is the text that wraps around the floated image. You usually want to add a small right and bottom margin to the image so that the text does not touch it. Once the text passes the bottom of the image it returns to its normal state and flows full width across its parent element. The text border is displayed red here to show that only the text reflows. The element box behaves as if the image is not there at all.</p> -->
</body>
</html>