<html>
<head>
	<title>Tests</title>
</head>
<body>
	<form action="test.php" method="POST">
		<input type="text" name="keyword"><br/>
		<input type="text" name="country"><br/>
		<input type="submit" name="submit_btn"><br/>
	</form>
	<?php
		require("RestAPI.php");

		function walk($v,$k) {
			echo("Key: $k -> Value: $v<br/>");
		}

		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$data = searchKeywords($_POST["keyword"], $_POST["country"]);

			$json = json_decode($data,true);

			var_dump($json);

			echo("<br/><br/><br/>");

			$results = $json["results"];

			echo("<br/><br/><br/>");

			var_dump($results);

			$key = array_keys($results);

			$key = $key[0];

			echo("<br/><br/><br/>");

			var_dump($results[$key]);

			echo("<br/><br/><br/>");

			var_dump($results[$key]["related"]);

			$related = $results[$key]["related"];

			echo("<br/><br/><br/>");

			print_r($related[0]["key"]);
		}
	?>
</body>
</html>