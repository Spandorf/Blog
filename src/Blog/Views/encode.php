


	<body>
		Enter text to encrypt
		<form method="post" action="/Blog/rot">
			<input name="text" type="text" style="height: 100px; width: 800px;" value="<?php echo(htmlspecialchars($encoded)); ?>">
			<br>
			<input type="submit" value="Submit">
		</form> 				
	</body>