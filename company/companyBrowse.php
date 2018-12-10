<html>
<head>
<style>
<?php include 'css/bootstrap.css'; ?>
<?php include 'css/bootstrap.min.css'; ?>
</style>
<title>All Departments</title>
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
	mysql_connect("localhost",$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	$query="SELECT dnumber,dname FROM department order by dnumber";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
?>
<div class="card border-info mb-3" style="max-width: 20rem;">
  <div class="card-header">Departments of Company</div>
  <div class="card-body">
	<table class="table-info" border="2" cellspacing="2" cellpadding="2">
	<tr>
	<th scope="row">
	    Department Number</th>
	<th scope="row">
	    Department Name</th>
	</tr>
	<?php
		$i=0;
		while ($i < $num) {
			$dno=mysql_result($result,$i,"dnumber");
			$dname=mysql_result($result,$i,"dname");
	?>
	<tr class="table-light">
	<td>
	  <a href="deptView.php?dno=<?php echo $dno; ?>">
	  <?php echo $dno; ?></a></td>
	<td>
	  <?php echo $dname; ?></td>
	</tr>
	<?php
		$i++;
		}
	?>
	</table>
  </div>
</div>
</body>
</html>