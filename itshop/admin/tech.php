	   <?php include '../config.php'; 
	   
	  $shopid= $_GET["id"];
	  
	  
	  
	   $sql ="SELECT * FROM shop_staff WHERE shopid='$shopid'";
$result = $con->query($sql);

 $totalRows=$result->num_rows;
	   ?>
	   
	   
	   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="assets/css/style.css">
    <title> All Technicians</title>
</head>
<body>
<h1> All Technicians!</h1>
<a href="index.php">Home</a>|<a href="Logout.php">Logout</a>

<div >

                <form method="POST" action="tech.php">
				<table>
				<tr>
				 <th> Shop Name </th><th> Technician Name</th><th> Mobile Number</th><th> Designation</th>
				</tr>
				 <?php
				
if ($totalRows > 0) 
{
  // output data of each row
  while($row = $result->fetch_assoc())//fetch data row wise 
  {
    echo  "<tr><td>".$row["shopId"]. "</td><td>" . $row["name"]. "</td><td>" . $row["mobile"]."</td><td>" . $row["designation"]. "</td></tr>";
	
  }
} 
else 
{

}	

				 

?>  
<br>
				<br> 
 
                                  
                    
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>