<?php  
 $connect = mysqli_connect(null, "root", "", "Khubaib",null,"/cloudsql/khubaib13102:asia-south1:khubaib13102");  
 $res = mysqli_query($connect, "SELECT PRICE FROM PRODUCT_13102 WHERE CODE='".$_POST["PRODUCT"]."'");
 $row = mysqli_fetch_array($res);
 $sql = "INSERT INTO SALESORDER_13102 VALUES('".$_POST["ORDER_NO"]."', '".$_POST["CUSTOMER"]."', '".$_POST["DATE"]."', '".$_POST["SALESPERSON"]."', '".$_POST["PRODUCT"]."', '".$_POST["QUANTITY"]."', '".$row["PRICE"]."', '".$_POST["AMOUNT"]."')";  
 if(mysqli_query($connect, $sql))  
 {  
      mysqli_query($connect, "UPDATE SALESORDER_13102 SET AMOUNT=RATE*QUANTITY WHERE ORDER_NO='".$_POST["ORDER_NO"]."'");
      echo 'Data Inserted';  
 }  
 ?> 
