<?php  
 $connect = mysqli_connect("localhost", "root", "", "Khubaib");  
 $output = '';  
 $sql = "SELECT * FROM SALESORDER_13102 WHERE CUSTOMER='".$_POST["CUSTOMER_ID"]."' ORDER BY ORDER_NO";  
 $sql1 = "SELECT * FROM CUSTOMER_13102 WHERE Shop_ID='".$_POST["CUSTOMER_ID"]."'";
 $sql2 = "SELECT SP_ID FROM SALESPERSON_13102";
 $sql3 = "SELECT CODE FROM PRODUCT_13102";
 $result = mysqli_query($connect, $sql);  
 $result1 = mysqli_query($connect, $sql1);
 $result2 = mysqli_query($connect, $sql2);
 $row = mysqli_fetch_array($result1);
 $output .= '  
	<h3>Invoice Header</h3>
	<table>
	 <tr>
	 <th style="background-color: 	#32CD32; padding: 20px;">Shop ID</th>
	 <th style="background-color: 	#32CD32; padding: 20px;">Shop_Name</th>
	 <th style="background-color: 	#32CD32; padding: 20px;">Contact_Person</th>
	 <th style="background-color: 	#32CD32; padding: 20px;">Contact_No</th>
	 <th style="background-color: 	#32CD32; padding: 20px;">Address</th>
	 <th style="background-color: 	#32CD32; padding: 20px;">Area</th>
	 <th style="background-color: 	#32CD32; padding: 20px;">Coordinates</th>
	 </tr>
	<tr>
	     <td style="background-color: #90EE90; padding: 20px;">'.$row["Shop_ID"].'</td>
	     <td style="background-color: #90EE90; padding: 20px;">'.$row["Shop_Name"].'</td>
	     <td style="background-color: #90EE90; padding: 20px;">'.$row["Contact_Person"].'</td>
	     <td style="background-color: #90EE90; padding: 20px;">'.$row["Contact_No"].'</td>
	     <td style="background-color: #90EE90; padding: 20px;">'.$row["Address"].'</td>
	     <td style="background-color: #90EE90; padding: 20px;">'.$row["Area"].'</td>
	     <td style="background-color: #90EE90; padding: 20px;">'.$row["Coordinates"].'</td>
	</tr>
	</table>
<h3>Invoice Lines</h3>
      <div class="table-responsive">  
           <table class="table table-bordered">  
                <tr>  
                     <th width="10%" style="padding: 20px;">Order No.</th>  
                     <th width="40%" style="padding: 20px;">Customer ID</th>  
                     <th width="40%" style="padding: 20px;">Date</th> 
                     <th width="40%" style="padding: 20px;">Salesperson ID</th>
                     <th width="40%" style="padding: 20px;">Product Code</th>
                     <th width="40%" style="padding: 20px;">Quantity</th>
                     <th width="40%" style="padding: 20px;">Rate</th>
                     <th width="40%" style="padding: 20px;">Amount</th> 
                     <th width="10%" style="padding: 20px;">Action</th>  
                </tr>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = mysqli_fetch_array($result))  
      {  
	   $result3 = mysqli_query($connect, $sql3);
	   $result2 = mysqli_query($connect, $sql2);
           $output .= '  
                <tr>  
                     <td class="ORDER_NO" data-id1="'.$row["ORDER_NO"].'" contenteditable>'.$row["ORDER_NO"].'</td>  
                     <td>'.$row["CUSTOMER"].'</td> 
                     <td class="DATE" data-id3="'.$row["ORDER_NO"].'" contenteditable>'.$row["DATE"].'</td>
                     <td>';
		     $output .= '<select class="SALESPERSON form-control" data-id4="'.$row["ORDER_NO"].'">';
			$output .= '<option value="">None</option>';
    			while ($row1 = mysqli_fetch_array($result2)) { 
                  	$output .= '<option value="'.$row1["SP_ID"].'"'.($row["SALESPERSON"]==$row1["SP_ID"]?'selected="selected"':"").'>'.$row1["SP_ID"].'</option>';                
			}
    			$output .= '</select>
			</td>
                     	<td>';
		     	$output .= '<select class="PRODUCT form-control" data-id5="'.$row["ORDER_NO"].'">';
			$output .= '<option value="">None</option>';
    			while ($row2 = mysqli_fetch_array($result3)) { 
                  	$output .= '<option value="'.$row2["CODE"].'"'.($row["PRODUCT"]==$row2["CODE"]?'selected="selected"':"").'>'.$row2["CODE"].'</option>';                
			}
    			$output .= '</select>
		     </td>
                     <td class="QUANTITY" data-id6="'.$row["ORDER_NO"].'" contenteditable>'.$row["QUANTITY"].'</td>
                     <td>'.$row["RATE"].'</td>
                     <td>'.$row["AMOUNT"].'</td> 
                     <td><button type="button" name="delete_btn" data-id9="'.$row["ORDER_NO"].'" class="btn btn-xs btn-danger btn_delete">Delete</button></td>  
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>  
                <td id="ORDER_NO" contenteditable></td>  
                <td id="CUSTOMER">'.$_POST["CUSTOMER_ID"].'</td>  
                <td id="DATE" contenteditable></td>  
                <td>';
		$output .= '<select id="SALESPERSON" class="form-control">';
		$output .= '<option value="">None</option>';
		$result2 = mysqli_query($connect, $sql2);
    		while ($row1 = mysqli_fetch_array($result2)) { 
                  $output .= '<option value="'.$row1["SP_ID"].'">'.$row1["SP_ID"].'</option>';                
		}
    		$output .= '</select>
		</td>  
                <td>';
		$output .= '<select id="PRODUCT" class="form-control">';
		$output .= '<option value="">None</option>';
		$result3 = mysqli_query($connect, $sql3);
    		while ($row2 = mysqli_fetch_array($result3)) { 
                  $output .= '<option value="'.$row2["CODE"].'">'.$row2["CODE"].'</option>';                
		}
    		$output .= '</select>
		</td>  
                <td id="QUANTITY" contenteditable></td>  
                <td> - </td>  
                <td> - </td>  
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">Create</button></td>  
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '
		<tr>  
                <td id="ORDER_NO" contenteditable></td>  
                <td id="CUSTOMER">'.$_POST["CUSTOMER_ID"].'</td>  
                <td id="DATE" contenteditable></td>  
                <td>';
		$output .= '<select id="SALESPERSON" class="form-control">';
		$output .= '<option value="">None</option>';
		$result2 = mysqli_query($connect, $sql2);
    		while ($row1 = mysqli_fetch_array($result2)) { 
                  $output .= '<option value="'.$row1["SP_ID"].'">'.$row1["SP_ID"].'</option>';                
		}
    		$output .= '</select>
		</td>  
                <td>';
		$output .= '<select id="PRODUCT" class="form-control">';
		$output .= '<option value="">None</option>';
		$result3 = mysqli_query($connect, $sql3);
    		while ($row2 = mysqli_fetch_array($result3)) { 
                  $output .= '<option value="'.$row2["CODE"].'">'.$row2["CODE"].'</option>';                
		}
    		$output .= '</select>
		</td>  
                <td id="QUANTITY" contenteditable></td>  
                <td> - </td>  
                <td> - </td>  
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">Create</button></td>  
           </tr>
<tr>  
                          <td colspan="4">Data not Found</td>  
                     </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>
