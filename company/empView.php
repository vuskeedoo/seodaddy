<html>
<head>
<style>
<?php include 'css/bootstrap.css'; ?>
<?php include 'css/bootstrap.min.css'; ?>
</style>
<title>Employee View</title>
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
<?php
  $username="root";
  $password="mysql";
  $database="company";
  if ($ssn = $_GET['ssn']) {
  	$query="SELECT * FROM employee WHERE ssn = $ssn;";
  }

  if ($mssn = $_GET['mssn']) {
  	$query="SELECT * FROM employee WHERE ssn = $mssn;";
  }
  $ssn=$_GET['ssn'];
  $mssn=$_GET['ssn'];
  mysql_connect("localhost",$username,$password);
  @mysql_select_db($database) or die( "Unable to select database");

  $result=mysql_query($query);
  $fname=mysql_result($result,0,"fname");
  $minit=mysql_result($result,0,"minit");
  $lname=mysql_result($result,0,"lname");
  $ssn=mysql_result($result,0,"ssn");
  $bdate=mysql_result($result,0,"bdate");
  $address=mysql_result($result,0,"address");
  $sex=mysql_result($result,0,"sex");
  $salary=mysql_result($result,0,"salary");
  $superssn=mysql_result($result,0,"superssn");
  echo "<h4>Employee Information </h4><br>";
?>
<table class="table-info" border="2" cellspacing="2" cellpadding="2">
<tr>
<th>
     Employee SSN</font></th>
<th>
     First Name</font></th>
<th>
     Middle Name</font></th>
<th>
     Last Name</font></th>
<th>
     Birthdate</font></th>
<th>
     Address</font></th>
<th>
     Sex</font></th>
<th>
     Salary</font></th>
<th>
     Supervisor SSN</font></th>
</tr>
<tr class="table-light">
  <td>
  <a href="empView.php?ssn=<? echo $ssn; ?>">
     <? echo $ssn; ?></a></font></td>
<td>
     <? echo $fname; ?></font></td>
<td>
     <? echo $minit; ?></font></td>
<td>
     <? echo $lname; ?></font></td>
<td>
     <? echo $bdate; ?></font></td>
<td>
     <? echo $address; ?></font></td>
<td>
     <? echo $sex; ?></font></td>
<td>
     <? echo $salary; ?></font></td>
<td>
     <? echo $superssn; ?></font></td>
</tr>
</table>
</body>
</html>