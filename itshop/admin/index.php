

<?php include '../config.php'; 

$customerID=$_SESSION["userid"] ;
echo "<h1> Welcome : ".$customerID."</h1>";
// Get image data from database 

$result = $con->query("SELECT * FROM shop ORDER BY uploaded DESC"); 
if(isset($_POST["submit"]))
{
	
	$title=$_POST["title"];
	$result = $con->query("SELECT * FROM shop  where title='$title'");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Admin Pannel</title>
</head>
<body>
<h1> Online IT Hardware Products & Services Portal</h1>
<a href="index.php"> Home</a>|
<a href="addShop.php"> Add Shop information</a>|
<a href="addStaff.php">Add staff to shop</a>|

<a href="categoryManagement.php">Category Management</a>|
<a href="addProducts.php">Add shop Products</a>|
<a href="ProductList.php">Show Product List</a>|
<a href="display.php">Show list of all hardware shops</a>|
<a href="logout.php"> Logout</a>

<br>
<br>

<div >

                <form method="POST" action="index.php">
				<div>
				
			
		
			
			
			
			<table>
<tr><th>Enter Shop name:</th><th>	<input type="text" name="title"></th><td><input type="submit" name="submit" value="Upload"></td><td></td></tr>
<tr><td></td><td></td></tr>
</table>

			</div>
			
<br>
<br> 


<?php if($result->num_rows > 0){ ?> 
    <div style="float:left; padding:10px; margine:10px;">

        <?php while($row = $result->fetch_assoc()){ ?> 
		<br>
				Title:<?php echo $row['title']?>
				<br>
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" width=100px height=100px /> 
      <br>
	  Address:<?php echo $row['address']?>
	   <br>
	 
	   
	   <?php

echo '<a href="tech.php?id=' . $row['shopid'] . '">Show Technicians</a>';

	   } ?> 
    </div> 
<?php }else{ ?> 
    <p class="status error"> No result found</p> 
<?php } ?>


<br>
<br>
                    
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>