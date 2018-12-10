<html>
<head>
<style>
<?php include 'css/bootstrap.css'; ?>
<?php include 'css/bootstrap.min.css'; ?>
</style>
<title>Simple Database Access</title>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Company Database</a>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="companyBrowse.php">companyBrowse</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="p1post.php">p1post</a>
      </li>
    </ul>
</nav>
</head>
<body>
<?php
	$username="root";
	$password="mysql";
	$database="company";
	mysql_connect("localhost",$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	$query="SELECT ssn FROM employee";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
?>
<h4>Employee Details for:</h4>
<form method="post" action="p1.php">
<select name="ssn">
<?php
	$i=0;
	while ($i < $num) {
	  $ssn=mysql_result($result,$i,"ssn");
	  echo "<option>",$ssn,"\n";
	  $i++;
	}
?>
</select>
<input type="submit" value="Get Employee Details">
</form>
</body>
</html>
