<?php  
 $connect = mysqli_connect("localhost", "khubaib", "13102", "Khubaib");  
 $sql = "DELETE FROM SALESORDER_13102 WHERE ORDER_NO = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>
