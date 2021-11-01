<?php include '../config.php';?>
<?php


$category = "";
 $totalRows="";//total rows from table
 $result ="";

  $sql ="SELECT * FROM category";
$result = $con->query($sql);

 $totalRows=$result->num_rows;
           

 

if(isset($_POST['done']))
{
if(!empty($_POST)) 
{
    if(!empty($_POST['category']))
	{
//insert data into table
			
            $category = $_POST['category'];
           $subcategory= $_POST['subcategory'];
   $query="INSERT INTO `category`(`category`,`subcategory`) VALUES ('$category','$subcategory')";
   
   $query1 = mysqli_query($con,$query);
 
 
 echo 'User is registered successfully';
 
 /////////////////////////////////////////get data///////////////////////////////
		
		$sql ="SELECT * FROM category";
$result = $con->query($sql);

 $totalRows=$result->num_rows;		
         
   
        
    } 
	else 
	{
        echo "field should not empty <br>";
    }
	
	
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
<link rel="stylesheet" href="../s1.css">
    <title>Category Management  </title>
</head>
<body>
<h1> Category Management </h1>
<a href="index.php"> Admin Pannel !</a>|
<a href="../logout.php"> Logout!</a>

<br>
<br>

<div >

                <form method="POST" action="categoryManagement.php">
				<table>
					<tr><td> Enter category name</td><td> <input type="text" name="category"></td></tr>
					<tr><td> Enter sub category name </td><td> <input type="text" name="subcategory"></td></tr>
					<tr><td> </td><td> <button type="submit" name="done">Submit</button></td></tr>
					
				
				</table>
                    
					
					
					
					
					
					<br>
					<table border=1>
					<tr><th> #</th><th>Category </th><th>Sub Category </th></tr>
					<?php 
					
					 if ($totalRows> 0) 
			{
				$usertype="";
				while($row = $result->fetch_assoc())
				{
					echo "<tr><td>".$row['id']."</td>";
					echo "<td>".$row['category']."</td>";
					echo "<td>".$row['subcategory']."</td></tr>";
				}
				
					
					
            }
   
   			
			else 
			{
                echo "No data is found";
            }
					
					
					?>
					
					</table>
					
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>