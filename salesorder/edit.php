<?php  
 $connect = mysqli_connect(null, "root", "", "Khubaib",null,"/cloudsql/khubaib13102:asia-south1:khubaib13102");
 $id = $_POST["id"];  
 $text = $_POST["text"];  
 $column_name = $_POST["column_name"];  
 $sql = "UPDATE SALESORDER_13102 SET ".$column_name."='".$text."' WHERE ORDER_NO='".$id."'"; 
 if($column_name=='PRODUCT'){
	$res = mysqli_query($connect, "SELECT PRICE FROM PRODUCT_13102 WHERE CODE='".$text."'");
	$row = mysqli_fetch_array($res);
	mysqli_query($connect, "UPDATE SALESORDER_13102 SET RATE='".$row['PRICE']."' WHERE ORDER_NO='".$id."'");
 } 
 if(mysqli_query($connect, $sql))  
 {  
      mysqli_query($connect, "UPDATE SALESORDER_13102 SET AMOUNT=RATE*QUANTITY WHERE ORDER_NO='".$id."'");
      echo 'Data Updated';  
 }  
 ?>
