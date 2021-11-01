<?php include '../config.php'; ?>
<?php 

$adminId = "";
$name = "";
$password= "";
$secQues= "";
$secAns= "";
if(isset($_POST['done']))
{
	//INSERT INTO `shop_staff`( `name`, `designation`, `mobile`, `shopId`)
			//exit;
if(!empty($_POST)) 
{//adminId,name,password,secQues,secAns
    if(empty($_POST['adminId'])&& empty($_POST['name'])&& empty($_POST['designation'])&& empty($_POST['mobile'])&& empty($_POST['shopId']))
	{
		echo "Fields should not empty";
	}
    else
	{
		try{//
          $designation = $_POST['designation'];
            $name = $_POST['name'];
			$mobile = $_POST['mobile'];
			$shopId = $_POST['shopId'];
            
            
			
			$q1="INSERT INTO `shop_staff`( `name`, `designation`, `mobile`, `shopId`) VALUES ('$name','$designation','$mobile','$shopId')";
			//exit;
			 $query = mysqli_query($con,$q1);
 
 
 echo 'Record is saved successfully';	
		}
		catch(Exception $e) {
			
			 echo $ex->getMessage();	
			
		}
		
		
	}
}
else{
	
	
	
	echo "Please fill the form first";
}
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Add Staff information</title>
</head>
<body>
<h1>  Test Phase</h1>
<a href="index.php">Back</a>
<br>
				<br>
<div >

                <form method="POST" action="addStaff.php">
				
				<br>
				<br>
				Enter staff name: <input type="text" name="name">
				<br>
				<br>
 Enter Designation: <input type="text" name="designation" >
<br>
				<br> 
				Enter Mobile Number: <input type="text" name="mobile">
				<br>
				<br>
				Enter shop Id: <input type="text" name="shopId">
				<br>
				<br>
                    <button type="submit" name="done" >Submit</button>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>