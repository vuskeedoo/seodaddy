<html>
<head>
	<title>Tests</title>
</head>
<body>
	<form action="search.php" method="POST">
		<input type="text" name="keyword"><br/>
		<input type="text" name="country"><br/>
		<input type="submit" name="submit_btn"><br/>
	</form>
	<?php
		require("RestAPI.php");

		function walk($v,$k) {
			echo("Key: $k => Value: $v<br/>");
		}

		function insert($sql) {
			$db = new SQLite3("snowball.sqlite3");
			$ret = $db->exec($sql);
			if(!$ret) {
				echo $db->lastErrorMsg();
			} else {
				echo "Record entered.<br/><br/>";
			}
			$db->close();
		}

		function output() {
			$db = new SQLite3("snowball.sqlite3");
			$results = $db->query('SELECT * FROM results');
			while ($row = $results->fetchArray()) {
    			var_dump($row);
    			echo("<br/><br/>");
			}
			$db->close();
		}

		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$data = searchKeywords($_POST["keyword"], $_POST["country"]);

			$json = json_decode($data,true);

			//echo("json  ");
			//var_dump($json);

			//echo("<br/><br/><br/>");

			$results = $json["results"];

			//echo("<br/><br/><br/>");

			//cho("json results  ");
			//var_dump($results);

			$key = array_keys($results);

			$key = $key[0];

			//echo("<br/><br/><br/>");

			//echo("results key  <br/><br/>");
			//echo($results[$key]["meta"]["keyword"]);

			//echo("<br/><br/><br/>array walk<br/><br/><br/>");
			//array_walk_recursive($results[$key], "walk");

			//echo("<br/><br/><br/>");
			//echo("results key related  ");
			//var_dump($results[$key]["related"]);

			$related = $results[$key]["related"];
			/*
			echo("<br/><br/><br/>");

			print_r($results[$key]["meta"]["keyword"]);
			echo("<br/>");
			print_r($related[0]["key"]);
			echo("<br/>");
			print_r($related[0]["country_code"]);
			echo("<br/>");
			print_r($related[0]["search_volume"]);
			echo("<br/>");
			print_r($related[0]["cpc"]);
			echo("<br/>");
			print_r($related[0]["keyword"]);


			echo("<br/>");
			echo("<br/>");
			echo("<br/>");

			//print_r($results[$key]);
			*/
			$qu = $results[$key]["meta"]["keyword"];
			$kw = $related[0]["key"];
			$cc = $related[0]["country_code"];
			$sv = $related[0]["search_volume"];
			$cp = $related[0]["cpc"];
			$cm = $related[0]["competition"];

			$sql = "INSERT INTO results VALUES (\"$qu\", \"$kw\", \"$cc\", $sv, $cp, $cm);";
			insert($sql);

			output();
		}
	?>
</body>
</html>