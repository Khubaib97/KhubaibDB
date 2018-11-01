<?php  
 $connect = mysqli_connect("localhost", "root", "", "Khubaib");  
 $sql = "DELETE FROM SALESORDER_13102 WHERE ORDER_NO = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>
