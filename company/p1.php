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
        <a class="nav-link" href="companyBrowse.php">companyBrowse<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="p1post.php">p1post</a>
      </li>
    </ul>
</nav>
</head>
<body>
<h4>Employee Information</h4>
<?php
	$username="root";
	$password="mysql";
	$database="company";
	$ssn=$_POST['ssn'];
	mysql_connect("localhost",$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	$query="SELECT * FROM employee where ssn=$ssn";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	echo "<br><br>";
	mysql_close();
	if ($num == 1) {
	  $fname=mysql_result($result,$i,"fname");
	  $minit=mysql_result($result,$i,"minit");
	  $lname=mysql_result($result,$i,"lname");
	  echo "<b>$fname $minit, $lname</b>";
	}
?>
</body>
</html>