<html>
<head>
<title>test search</title>
</head>
<body>

	<form action="searchKevin.php" method="POST">
		<input type="text" name="keyword"><br/>
		<input type="text" name="country"><br/>
		<input type="submit">
	</form>

	<?php
		require("phpfiles/RestApi.php");

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$array = searchKeywords($_POST["keyword"],$_POST["country"]);
			$array_length = count($array);
			echo("eat ass");
			//$json = json_encode($array);
			//$json = json_decode($json, true);
			print_r($array['results']);
		}

	?>

</body>
</html>