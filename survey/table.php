<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
<div class="container">
<div class="page-header">
	<h1 align="center">Field Survey Form</h1>
</div>
      
<?php
	include('../main/session.php');
	require_once "../vendor/autoload.php";
	$m = new MongoDB\Client;
	$db = $m->selectDatabase('Khubaib');
	$collection = $db->selectCollection('Survey');
	if (isset($_POST['create']))
	{
		$data = [
			'CreatedOn' => new MongoDB\BSON\UTCDateTime,
			'Coordinates' => $_POST['Coordinates'],
			'ShopName' => $_POST['ShopName'],
			'Available' => $_POST['Available'],
			'Position' => $_POST['Position'],
			'Competitor' => $_POST['Competitor']
		];
		if (isset($_FILES['image']))
		{
			if (move_uploaded_file($_FILES['image']['tmp_name'], "upload/".$_FILES['image']['name'])){		
				$data['image'] = $_FILES['image']['name'];
				echo "<div class='alert alert-success'>File was moved</div>";
			}
			else
			{
				echo "<div class='alert alert-danger'>File was not moved</div>";
				echo '<br>';
				echo $_FILES['image']['tmp_name'];
				echo '<br>';
			    echo $_FILES['image']['name'];
			}
		}
		else
		{
			echo "<div class='alert alert-danger'>File was not found</div>";
		}
		$result = $collection->insertOne($data);
		if($result->getInsertedCount() > 0)
		{
			echo "<div class='alert alert-success'>Form submitted</div>";
			header("refresh:1;url=table.php");
		}
		else {
			echo "<div class='alert alert-danger'>Form was not submitted</div>";
			header("refresh:1;url=table.php");
		}
	}

	$forms = $collection->find();
	foreach($forms as $key => $form){
		$UTCDateTime = new MongoDB\BSON\UTCDateTime((string)$form['CreatedOn']);
		$DateTime = $UTCDateTime->toDateTime();
		echo '
		<div class = "row">
			<div class ="col-sm-6">
				<p>Shop Name: '.$form['ShopName'].'</p>
				<p>Coordinates: '.$form['Coordinates'].'</p>
				<p>Are my products available in shop? : '.$form['Available'].'</p>
				<p>Are my products positioned in front? : '.$form['Position'].'</p>
				<p>Are competitor products more prominent? : '.$form['Competitor'].'</p>
			</div>				
			<div class = "col-sm-3"><img src="upload/'.$form['image'].'" width="180"></div>
			<div class = "col-sm-3">Posted at: '.$DateTime->format('d/m/Y H:i:s').'</div>
		</div><br><br>';
	} 
?>

<form action = "table.php" method="post" enctype="multipart/form-data">
    <table class='table table-hover table-responsive table-bordered'>
	<tr>
            <td>Geographical Coordinates</td>
            <td><input type='text' name='Coordinates' class='form-control' /></td>
        </tr>
        <tr>
            <td>Shop Name</td>
            <td><input type='text' name='ShopName' class='form-control' /></td>
        </tr>
        <tr>
            <td>Are my products available?</td>
            <td>
	    <input type="radio" name="Available" value="Yes"> Yes </input>   
	    <input type="radio" name="Available" value="No"> No </input>
	    </td>
        </tr>
        <tr>
            <td>Are my products positioned in front?</td>
            <td>
	    <input type="radio" name="Position" value="Yes"> Yes </input>   
	    <input type="radio" name="Position" value="No"'> No </input>
	    </td>
        </tr>
	<tr>
            <td>Are competitor products more prominent?</td>
            <td>
	    <input type="radio" name="Competitor" value="Yes"> Yes </input>   
	    <input type="radio" name="Competitor" value="No"> No </input>
	    </td>
        </tr>
	<tr>
            <td>Picture</td>
            <td><input type="file" name="image" class='form-control' /></td>
        </tr>
	<tr>
            <td></td>
            <td>
                <input type='submit' name='create' value='Create' class='btn btn-primary' />
            </td>
        </tr>
    </table>
</form>
          
</div>
<div align="center" style="margin: 20px">
<a href='../main/welcome.php' class='btn btn-primary m-r-1em'>Home</a>
<a href = '../main/logout.php' class='btn btn-danger'>Sign Out</a>
</div>
      
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>
