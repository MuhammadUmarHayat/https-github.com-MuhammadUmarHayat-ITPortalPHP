<?php include '../config.php';?>
<?php 

	$customerID="";
$amount=0;
$customerID=$_SESSION["userid"] ;
echo "<h3> Welcome : ".$customerID."</h3>";
	
 
$result = mysqli_query($con, 'SELECT SUM(`TotalPrice`) AS value_sum FROM cart'); 
$row = mysqli_fetch_assoc($result); 
$sum = $row['value_sum'];
$amount=$sum ;
//echo "<br> <h2>Total Amount : ".$sum."</h2>";

if(isset($_POST['done']))
{
if(!empty($_POST)) 
{
	
	// echo "$fname Refsnes.<br>";
 	try 
	{ 
       //empty the cart when order is places
 
			
          $cusID = $customerID;
           
			 $status = "paid";
			 $bankname= $_POST['bankname'];
			          $accountNumber= $_POST['accountNumber'];
					  
		$method="";			  
				
	 if(isset($_POST['methods']))
{
	$method=$_POST['methods'];
	
	//save order////////////////
	
	$con = mysqli_connect('localhost','root');
mysqli_select_db($con,'autolinefdb');

$result = $con->query("SELECT * FROM `cart` WHERE customerID='$customerID'"); 
 if($result->num_rows > 0)
 { 
$orderid=rand(111,999);
 while($row = $result->fetch_assoc())
 {
	 //`cartID`, `customerID`, `pid`, `unitPrice`, `Quantity`, `TotalPrice`
	 
	echo $row['cartID']."-".$row['customerID']."-".$row['productid']."-".$row['unitPrice']."-".$row['Quantity']."-".$row['TotalPrice']."<br>";
	
	$cusId=$row['customerID'];
	
	$productid=$row['productid'];
	$price=$row['unitPrice'];
	$quantity=$row['Quantity'];
	$status="paid";
	$total=$row['TotalPrice'];
	
	
$q1="INSERT INTO `orders`(`cusId`, `productid`, `price`, `quantity`, `date`, `status`, `total`, `orderid`) VALUES ('$cusId', '$dressid', '$price','$quantity', NOW(), '$status', '$total','$orderid')";
			 $query = mysqli_query($con,$q1);	


$result1 = $con->query("SELECT * FROM `products` WHERE productid='$productid'"); 
 if($result1->num_rows > 0)
 { 

 while($row1 = $result1->fetch_assoc())
 {
$title=$row1['title'];
$productid12=$row1['productid'];
$quantity=-$quantity;
$status="sold";
//$q12="INSERT INTO `products`(`title`, `quantity`,`status`) VALUES('$title','$quantity','$status')";
 //$query12 = mysqli_query($con,$q12);	

 
 }
 }



	
 }//end loop
 
 
 
 
 
 
 }
 else
 {
	 
	 
	  echo "No orders are found!";
 }

	
	
	
	
	
	
	$q2="DELETE FROM `cart`";
			 $query = mysqli_query($con,$q2);	

 
}
else{
	
	
	echo "please select payment method first";
}
	
	
			$query="";
			
			if($method =="cod")
			{
				echo "cod";
			echo $q1="INSERT INTO `payments`( `cusID`, `method`, `amount`,`date`, `status`) VALUES ('$cusID', '$method`, '$amount',NOW(), '$status')";
			echo " result".$query = mysqli_query($con,$q1);	
			getData($customerID) ;
			header('Location:http://localhost/autoline/customer/ThankYou.php');
				echo 'Thank you for payment!';
				
				
				/////////////save order////////////////
			}
			else if ($method =="online")
			{
				echo " <br> Online Bankig <br>";
				 $q1="INSERT INTO `payments`( `cusID`, `method`, `amount`,`date`, `status`,`accountNumber`,`bankName`) VALUES ('$cusID', '$method', '$amount',NOW(), '$status','$accountNumber','$bankname')";
			 $query = mysqli_query($con,$q1);	
			 ////////////////////////////////Save order////////////////////////
			 
			//getData($customerID) ;
				echo 'Thank you for payment!';
				header('Location:http://localhost/itshop/admin/ThankYou.php');
				
			}
	}
	
	
 catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
 
		
	}
	

else
{
	
	
	
	echo "Please fill the form first";
}
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
   <link rel="stylesheet" href="../s1.css">
    <title>Customer Payments</title>
</head>
<body>
<h1> IT Portal</h1>
<a href="index.php">Back</a>
<br>
				<br>
<div >

                <form method="POST" action="CustomerPayments.php">
				
				  
				<table>
				
				<input type="radio" name="methods"
<?php if (isset($methods) && $methods=="cod") echo "checked";?>
 value="cod">Cash on Delivery<br>
  <input type="radio" name="methods"
  <?php if (isset($methods) && $methods=="online") echo "checked";?> value="online">Online Banking<br>
  <br>
				
				
				
				
				
				
				
				
				
				<tr><td> Enter cusID:</td><td> <?php  echo $customerID; //$amount?></td></tr>
				
		<tr><td> Enter  Bank Name(for online banking):</td><td> <input type="text" name="bankname"></td></tr>		
				
				 <tr><td> Enter  Account Number (for online banking):</td><td> <input type="text" name="accountNumber"></td></tr>
				
				
				
				
				<tr><td> Enter  payment amount:</td><td> <?php  echo $amount;?></td></tr>
				
				<tr><td> </td><td> <button type="submit" name="done" >Submit</button></td></tr>			


                    
					</table>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>