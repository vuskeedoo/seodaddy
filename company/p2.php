<html>
<head>
<style>
<?php include 'css/bootstrap.css'; ?>
<?php include 'css/bootstrap.min.css'; ?>
</style>
<title>Simple Database Access</title>
</head>
<body>
<?php
	$username="root";
	$password="mysql";
	$database="company";
	$dno=$_GET['dno'];
	mysql_connect("localhost",$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	$query="SELECT lname,salary FROM employee where dno=$dno";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
?>
<table class="table-info" border="2" cellspacing="2" cellpadding="2">
<tr>
<th>Last Name</th>
<th>Salary</th>
</tr>
<?php
	echo "<h4>Employees in Department $dno</h4>";
	$i=0;
	while ($i < $num) {
	  $lname=mysql_result($result,$i,"lname");
	  $salary=mysql_result($result,$i,"salary");
?>
<tr class="table-light">
<td>
<? echo $lname; ?>
</font></td>
<td>
<? echo $salary; ?>
</font></td>
</tr>
<?php $i++;
} ?>
</table>
</body>
</html>