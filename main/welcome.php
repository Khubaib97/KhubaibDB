<?php
   include('session.php');
   $action = isset($_GET['action']) ? $_GET['action'] : "";
   /*if($action=='rejected'){
    echo "<div class='alert alert-danger'>Only the admin may access the user table.</div>";
   }*/
?>
<html>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
   <head>
      <title>Home Page</title>
   </head>
   <br />
   <br />
   <br />
   <br />
   <br />
   <body>
      <h1 align="center">Welcome, <?php echo $login_session; ?>!</h1>
	<table>
	<tr>
	<div align="center" style="margin: 20px">
	<a href='../customer/table.php' class='btn btn-primary'>Customer</a>
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 20px">
	<a href='../salesperson/table.php' class='btn btn-primary'>Salesperson</a>
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 20px">
	<a href='../product/table.php' class='btn btn-primary'>Product</a>
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 20px">
	<a href='../salesorder/table.php' class='btn btn-primary'>Salesorder</a>
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 20px">
	<a href='../user/table.php' class='btn btn-primary'>User</a>
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 20px">
	<a href='../survey/table.php' class='btn btn-primary'>Field Survey</a>
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 20px">
	<a href = "logout.php" class="btn btn-danger">Sign Out</a>
	</div>
	</tr>
	</table> 
   </body>
</html>
