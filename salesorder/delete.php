<?php  
 $connect = mysqli_connect(null, "root", "", "Khubaib",null,"/cloudsql/khubaib13102:asia-south1:khubaib13102");  
 $sql = "DELETE FROM SALESORDER_13102 WHERE ORDER_NO = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>
