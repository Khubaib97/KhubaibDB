<?php
   include("dbconn.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM USER_13102 WHERE USERNAME='$username' and PASSWORD='$password'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['ACTIVE'];
		
      if(mysqli_num_rows($result) == 1) {
         $_SESSION['login_user'] = $username;
         mysqli_query($db, "UPDATE USER_13102 SET ACTIVE='Y' WHERE USERNAME='$username'");
         header("location: welcome.php");
      }else {
         echo "<div class='alert alert-danger'>Username or password was invalid</div>";
      }
   }
?>
<html>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
   <head>
      <title>Login Page</title>
      
      <div class="page-header">
	<h1 align="center">Login</h1>
      </div>
      
   </head>
<body bgcolor = "#FFFFFF">	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">				
            <div style = "margin:30px">
               <form action = "" method = "post">
                  <label>Username</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = "Submit" class='btn btn-primary'/><br />
               </form>               					
            </div>				
         </div>			
      </div>
</body>
<style>
head, body{
	animation: colorchange 20s infinite;
}
@keyframes colorchange {
     0%  {background: #FFFF00;}
    25%  {background: #FF0000;}
    50%  {background: #00FF00;}
    75%  {background: #00BFFF;}
    100% {background: #FFA500;}
}
</style>
</html>
