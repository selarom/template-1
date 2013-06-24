<html>
<head>
	<title>CSS Training</title>
	<style>
		
		body {font-family: helvetica, arial, sans-serif;font-size:1em; background-color:#caebff;}
		
		div#outer {position:relative;width:250px; margin:50px 40px; border-top:3px solid red;}

		div#inner {position:absolute;top:10px; left:20px; background:#ccc;}

	</style>
<body>
	<div id="outer">
		<div id="inner">
			This is text for a paragraph to demonstrate contextual positioning. Here are two divs, one nested in the other. The outer div has a red top border and the inner div has a gray background. Both elements have default static positioning.
		</div>
	</div>
</body>
</html>