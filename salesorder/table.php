<?php
   $db = mysqli_connect(null, "root", "", "Khubaib",null,"/cloudsql/khubaib13102:asia-south1:khubaib13102");
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select USERNAME from USER_13102 where USERNAME='$user_check'");
   
   $row1 = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row1['USERNAME'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:/main/login.php");
   }
?>
<html>  
      <head>  
           <title>SalesOrder</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      </head>  
      <body>  
           <div class="container">  
                <div class="table-responsive">
		     <div class="page-header">  
                     <h1 align="center">Salesorder Table</h1><br />
		     </div>  
	<h3>Select Customer ID:</h3>
	<?php
	$dsn = getenv('MYSQL_DSN');
    	$user = getenv('MYSQL_USER');
    	$password = getenv('MYSQL_PASSWORD');
    	$con = new PDO($dsn, $user, $password);
	$stmt = $con->prepare("select Shop_ID from CUSTOMER_13102");
	$stmt->execute();
    	echo "<select id='CUSTOMER_ID' class='form-control'>";
	echo '<option value="">None</option>';
    	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                  echo '<option value="'.$row["Shop_ID"].'">'.$row["Shop_ID"].'</option>';                
	}
    	echo "</select>";
	?>
	<br />
                     <div id="live_data"></div>
	<br />
	<div align="center" style="margin: 20px">
	<a href='/main/welcome.php' class='btn btn-primary m-r-1em'>Home</a>
	<a href = '/main/logout.php' class='btn btn-danger'>Sign Out</a>
	</div>            
                </div>  
           </div>  
      </body>  
</html>  
<script>  
 $(document).ready(function(){  
	var CUSTOMER_ID = $('#CUSTOMER_ID').val();
      $("#CUSTOMER_ID").change(function(){
       CUSTOMER_ID = $('#CUSTOMER_ID').val();
	fetch_data();
      });
      function fetch_data()  
      {  
           $.ajax({  
                url:"retrieve.php",  
                method:"POST",  
		data:{CUSTOMER_ID:CUSTOMER_ID},  
                dataType:"text",
                success:function(data){  
                     $('#live_data').html(data);  
                }  
           });  
      }  
      fetch_data();  
      $(document).on('click', '#btn_add', function(){  
           var ORDER_NO = $('#ORDER_NO').text();  
           var CUSTOMER = CUSTOMER_ID;
	   var DATE = $('#DATE').text();
	   var SALESPERSON = $('#SALESPERSON').val();
	   var PRODUCT = $('#PRODUCT').val();
	   var QUANTITY1 = $('#QUANTITY').text(); 
	   var QUANTITY = parseInt(QUANTITY1);
	   var RATE = 0;
	   var AMOUNT = 0;
           if(ORDER_NO == '')  
           {  
                alert("Enter ORDER NUMBER");  
                return false;  
           }    
           if(DATE == '')  
           {  
                alert("Enter DATE");  
                return false;  
           }   
           if(QUANTITY == '')  
           {  
                alert("Enter QUANTITY");  
                return false;  
           }  
           $.ajax({  
                url:"create.php",  
                method:"POST",  
                data:{ORDER_NO:ORDER_NO, CUSTOMER:CUSTOMER, DATE:DATE, SALESPERSON:SALESPERSON, PRODUCT:PRODUCT, QUANTITY:QUANTITY, RATE:RATE, AMOUNT:AMOUNT},  
                dataType:"text",  
                success:function(data)  
                {  
                     //alert(data); 
                     fetch_data();  
                }  
           })  
      });  
      function edit_data(id, text, column_name)  
      {  
           $.ajax({  
                url:"edit.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:column_name},  
                dataType:"text",  
                success:function(data){  
                     //alert(data);  
	             fetch_data();
                }  
           });  
      }  
      $(document).on('blur', '.ORDER_NO', function(){  
           var id = $(this).data("id1");  
           var ORDER_NO = $(this).text();  
           edit_data(id, ORDER_NO, "ORDER_NO");  
      });   
      $(document).on('blur', '.DATE', function(){  
           var id = $(this).data("id3");  
           var DATE = $(this).text();  
           edit_data(id, DATE, "DATE");  
      });  
      $(document).on('blur', '.SALESPERSON', function(){  
           var id = $(this).data("id4");  
           var SALESPERSON = $(this).val();  
           edit_data(id, SALESPERSON, "SALESPERSON");  
      });
      $(document).on('blur', '.PRODUCT', function(){  
           var id = $(this).data("id5");  
           var PRODUCT = $(this).val();  
           edit_data(id, PRODUCT, "PRODUCT");  
      });  
      $(document).on('blur', '.QUANTITY', function(){  
           var id = $(this).data("id6");  
           var QUANTITY = $(this).text();  
           edit_data(id, QUANTITY, "QUANTITY");  
      });
      $(document).on('blur', '.RATE', function(){  
           var id = $(this).data("id7");  
           var RATE = $(this).text();  
           edit_data(id, RATE, "RATE");  
      });   
      $(document).on('click', '.btn_delete', function(){  
           var id=$(this).data("id9");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"delete.php",  
                     method:"POST",  
                     data:{id:id},  
                     dataType:"text",  
                     success:function(data){  
                          //alert(data);  
                          fetch_data();  
                     }  
                });  
           }  
      });  
 });  
</script>
