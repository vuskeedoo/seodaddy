<html>
<head>
<style>
<?php include 'css/bootstrap.css'; ?>
<?php include 'css/bootstrap.min.css'; ?>
</style>
<title>Department View</title>
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
  $dno=$_GET['dno'];
  mysql_connect("localhost",$username,$password);
  @mysql_select_db($database) or die( "Unable to select database");
  $query="SELECT dname,mgrssn,mgrstartdate,lname,fname FROM
  department,employee where dnumber=$dno and mgrssn=ssn";
  $result=mysql_query($query);
  $num=mysql_numrows($result);
  $dname=mysql_result($result,0,"dname");
  $mssn=mysql_result($result,0,"mgrssn");
  $mstart=mysql_result($result,0,"mgrstartdate");
  $mlname=mysql_result($result,0,"lname");
  $mfname=mysql_result($result,0,"fname");
  echo "<b>Department: </b>", $dname;
  echo "<P>Manager: <a href=\"empView.php?mssn=", $mssn, "\">", $mlname, ",
  ", $mfname, "</a></BR>";
  echo "Manager Start Date: ", $mstart;
  echo "<h4>Department Locations:</h4>";
  $query="SELECT dlocation FROM dept_locations where dnumber=$dno";
  $result=mysql_query($query);
  $num=mysql_numrows($result);
  $i=0;
  while ($i < $num) {
    $dloc=mysql_result($result,$i,"dlocation");
    echo $dloc, "<BR>\n";
    $i++;
  }
  echo "<h4>Employees:</h4>";
  $query="SELECT ssn,lname,fname FROM employee where dno=$dno";
  $result=mysql_query($query);
  $num=mysql_numrows($result);
?>
<table class="info" border="2" cellspacing="2" cellpadding="2">
<tr class="table-info">
<th>
     Employee SSN</font></th>
<th>
     Last Name</font></th>
<th>
     First Name</font></th>
</tr>

<?php
  $i=0;
  while ($i < $num) {
    $essn=mysql_result($result,$i,"ssn");
    $elname=mysql_result($result,$i,"lname");
    $efname=mysql_result($result,$i,"fname");
?> <tr class="table-light">
  <td>
  <a href="empView.php?ssn=<? echo $essn; ?>">
     <? echo $essn; ?></a></font></td>
<td>
     <? echo $elname; ?></font></td>
<td>
     <? echo $efname; ?></font></td>
</tr>
<? $i++;
} ?>
</table>
<?php
  echo "<h4>Projects:</h4>";
  $query="SELECT pnumber,pname,plocation FROM project where
  dnum=$dno";
  $result=mysql_query($query);
  $num=mysql_numrows($result);
?>
<table border="2" cellspacing="2" cellpadding="2">
<tr class="table-info">
<th>Project
Number</font></th>
<th>Project
Name</font></th>
<th>Location</font></th>
</tr>
<?php
  $i=0;
  while ($i < $num) {
    $pnum=mysql_result($result,$i,"pnumber");
    $pname=mysql_result($result,$i,"pname");
    $ploc=mysql_result($result,$i,"plocation");
?>

<tr class="table-light">
  <td>
  <a href="projView.php?pnum=<? echo $pnum; ?>"><? echo $pnum;
?></a></font></td>
<td><? echo $pname;
?></font></td>
<td><? echo $ploc;
?></font></td>
</tr>
<?php
  $i++; }
  mysql_close();
?>

</body>
</html>