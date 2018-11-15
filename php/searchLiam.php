<html>
<head>
<title>test search</title>
</head>
<body>

	<form action="searchLiam.php" method="POST">
		<input type="text" name="keyword"><br/>
		<input type="text" name="country"><br/>
		<input type="submit">
	</form>

	<?php
		require("RestApi.php");

		function walk($k, $v) {
			if($v == "key") {
				echo("<br/><br/>FOUND: $k<br/><br/>");
			}
			echo("Key: $v - Val: $k<br/>");
		};

		$queries = array();
		$index = 0;

		function pull($k, $v) {
			$a = array("key","cpc","country_code");
			if(in_array($v,$a)) {
				//echo("Found $v $k<br/>");
				$new = array( $v => $k );
				$queries[$index] = $new;
				}
			if($v == "country_code") {
				$index++;
			}
			};

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$array = searchKeywords($_POST["keyword"], $_POST["country"]);
			$array_length = count($array);
			var_dump($array);

			echo("<br/>");
			echo("<br/>");
			echo("<br/>");

			$json_data = json_decode($array, true);

			var_dump($json_data);

			echo("<br/>");
			echo("<br/>");
			echo("<br/>");

			array_walk_recursive($json_data, "walk");

			echo("<br/>");
			echo("<br/>");
			echo("<br/>");

			array_walk_recursive($json_data, "pull");

			echo("<br/>");
			echo("FUCK THIS<br/>");
			echo("<br/>");

			var_dump($queries);
		}
	?>

</body>
</html>