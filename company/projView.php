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
  $pnum=$_GET['pnum'];
  mysql_connect("localhost",$username,$password);
  @mysql_select_db($database) or die( "Unable to select database");
  $query="SELECT * FROM project WHERE pnumber = $pnum;";
  $result=mysql_query($query);
  $pname=mysql_result($result,0,"pname");
  $pnumber=mysql_result($result,0,"pnumber");
  $plocation=mysql_result($result,0,"plocation");
  $dnum=mysql_result($result,0,"dnum");
  echo "<h4>Project Information </h4><br>";
?>
<table class="table-info" border="2" cellspacing="2" cellpadding="2">
<tr>
<th>
     Name</font></th>
<th>
     Number</font></th>
<th>
     Location</font></th>
<th>
     Dept. Number</font></th>
</tr>
<tr class="table-light">
<td>
     <? echo $pname; ?></a></font></td>
<td>
     <? echo $pnumber; ?></font></td>
<td>
     <? echo $plocation; ?></font></td>
<td>
     <? echo $dnum; ?></font></td>
</tr>
</table>
</body>
</html>