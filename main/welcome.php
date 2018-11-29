<?php
   include('session.php');
   $action = isset($_GET['action']) ? $_GET['action'] : "";
   $connect = mysqli_connect("localhost", "khubaib", "13102", "Khubaib");
   $row = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) FROM CUSTOMER_13102"));
   $row1 = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) FROM SALESPERSON_13102"));
   $row2 = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) FROM PRODUCT_13102"));
   $row3 = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) FROM USER_13102"));
   $row4 = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) FROM SALESORDER_13102"));
?>
<html>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
   <head>
      <title>Home Page</title>
   </head>
   <body style="background-color: #FFA500;">
      <h1 align="center">Welcome, <?php echo $login_session; ?>!</h1>
	<div id="chartContainer" style="height: 300px; width: 100%;"></div>
	<table>
	<tr>
	<div align="center" style="margin: 10px">
	<a href='../customer/table.php' class='btn btn-success'>Customer</a>
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 10px">
	<a href='../salesperson/table.php' class='btn btn-success'>Salesperson</a>
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 10px">
	<a href='../product/table.php' class='btn btn-success'>Product</a>
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 10px">
	<a href='../salesorder/table.php' class='btn btn-success'>Salesorder</a>
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 10px">
	<a href='../user/table.php' class='btn btn-success'>User</a>
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 10px">
	<a href='../survey/table.php' class='btn btn-success'>Field Survey</a>
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 10px">
	<a href = "logout.php" class="btn btn-danger">Sign Out</a>
	</div>
	</tr>
	</table>
   </body>
<style>
#chart{
	height: 500px;
}
</style>
<script type="text/javascript">
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	backgroundColor: "#FFA500",
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Database Entry Info"
	},
	axisY: {
		title: "Entries"
	},
	data: [{        
		type: "column",  
		dataPoints: [      
			{ y: <?php echo $row[0]; ?>, label: "Customer" },
			{ y: <?php echo $row1[0]; ?>,  label: "Salesperson" },
			{ y: <?php echo $row2[0]; ?>,  label: "Product" },
			{ y: <?php echo $row3[0]; ?>,  label: "User" },
			{ y: <?php echo $row4[0]; ?>,  label: "Salesorder" }
		]
	}]
});
chart.render();

}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</html>
