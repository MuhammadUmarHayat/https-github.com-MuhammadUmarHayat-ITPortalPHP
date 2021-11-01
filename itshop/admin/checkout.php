<?php include '../config.php'; 

//session_start();
$customerID="";
$customerID=$_SESSION["userid"] ;
echo "<h1> Welcome : ".$customerID."</h1>";

if(isset($_POST['order']))
{
	header('Location:http://localhost/itshop/admin/CustomerPayments.php');
}
?>



<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../s1.css">

    <title> Cart </title>
</head>
<body>
<h1> Shoping Cart Check out</h1>
<br>
<br>
<a href="index.php">  Customer Pannel!</a>


<a href="../logout.php"> Logout!</a>
<div >

                <form method="POST" action="checkout.php">
				<br>
<br> 
<br>
<table border=1>
<tr><th>ID</th><th>customerID</th><th>Product Number</th><th>unitPrice</th><th>Quantity</th><th>TotalPrice</th></tr>
<?php
// Get image data from database 
$result = $con->query("SELECT * FROM `cart` WHERE customerID='$customerID'"); 
 if($result->num_rows > 0)
 { 
 while($row = $result->fetch_assoc()){
	 //`cartID`, `customerID`, ``, `unitPrice`, `Quantity`, `TotalPrice`
	 
	echo"<tr><td>".$row['cartID']."</td><td>".$row['customerID']."</td><td>".$row['productid']."</td><td>".$row['unitPrice']."</td><td>".$row['Quantity']."</td><td>".$row['TotalPrice']."</td></tr>";
	     
 }
 }
 else{
	 
	 
	  echo "No orders are found!";
 }
 
 
 //////////////////////////
 $result = mysqli_query($con, 'SELECT SUM(`TotalPrice`) AS value_sum FROM cart'); 
$row = mysqli_fetch_assoc($result); 
$sum = $row['value_sum'];
echo "<br> <h2>Total Amount : ".$sum."</h2>";
 ?>
<br>
                    <button type="submit" name="order">Place Order</button>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>