<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
<div class="container">
<div class="page-header">
	<h1 align="center">Customer Create</h1>
</div>
      
<?php
$host = "localhost";
$db_name = "Khubaib";
$username = "khubaib";
$password = "13102";
  
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}

if($_POST){
    try{
        $query = "INSERT INTO CUSTOMER_13102 SET Shop_ID=:Shop_ID, Shop_Name=:Shop_Name, Contact_Person=:Contact_Person, Contact_No=:Contact_No, Address=:Address, Area=:Area, Coordinates=:Coordinates";
 
        $stmt = $con->prepare($query);

	$shopid=htmlspecialchars(strip_tags($_POST['Shop_ID'])); 
        $shopname=htmlspecialchars(strip_tags($_POST['Shop_Name']));
        $contactperson=htmlspecialchars(strip_tags($_POST['Contact_Person']));
        $contactno=htmlspecialchars(strip_tags($_POST['Contact_No']));
	$address=htmlspecialchars(strip_tags($_POST['Address']));
	$area=htmlspecialchars(strip_tags($_POST['Area']));
	$coordinates=htmlspecialchars(strip_tags($_POST['Coordinates']));
 
	$stmt->bindParam(':Shop_ID', $shopid);
        $stmt->bindParam(':Shop_Name', $shopname);
        $stmt->bindParam(':Contact_Person', $contactperson);
        $stmt->bindParam(':Contact_No', $contactno);
	$stmt->bindParam(':Address', $address);
	$stmt->bindParam(':Area', $area);
	$stmt->bindParam(':Coordinates', $coordinates);
                  
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
	    header("refresh:1;url=table.php");
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
         
    }
     
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
	<tr>
            <td>Shop ID</td>
            <td><input type='text' name='Shop_ID' class='form-control' /></td>
        </tr>
        <tr>
            <td>Shop Name</td>
            <td><input type='text' name='Shop_Name' class='form-control' /></td>
        </tr>
        <tr>
            <td>Contact Person</td>
            <td><input type='text' name='Contact_Person' class='form-control' /></td>
        </tr>
        <tr>
            <td>Contact Number</td>
            <td><input type='text' name='Contact_No' class='form-control' /></td>
        </tr>
	<tr>
            <td>Address</td>
            <td><input type='text' name='Address' class='form-control' /></td>
        </tr>
	<tr>
            <td>Area</td>
            <td><input type='text' name='Area' class='form-control' /></td>
        </tr>
	<tr>
            <td>Coordinates</td>
            <td><input type='text' name='Coordinates' class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
	        <a href='table.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>
          
</div>
      
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>
