<?php include '../config.php'; 

$customerID=$_SESSION["userid"] ;
echo "<h1> Welcome : ".$customerID."</h1>";

$_SESSION["cartid"]="";
	$cartID="";
 
	$result = mysqli_query($con, 'SELECT SUM(`TotalPrice`) AS value_sum FROM cart'); 
$row = mysqli_fetch_assoc($result); 
$sum = $row['value_sum'];
echo "<br> <h2> Total Amount : ".$sum."</h2>";
	$result="";
if(isset($_POST['checkout']))
{
	header('Location:http://localhost/itshop/admin/checkout.php');
}

else if(isset($_POST['btnviewAll']))
{
	$result = $con->query("SELECT * FROM products"); 
}
else if(isset($_POST['btnSearch']))
{
	$title = $_POST['title'];
	$subCategory=$_POST['subCategory'];
	$category=$_POST['category'];
//dresstype,category //,search,	
$result = $con->query("SELECT * FROM products where subCategory='$subCategory' or category='$category' or title='$title' "); 
}
else
{
// Get image data from database 
$result = $con->query("SELECT * FROM products"); 	
	
}
 ?> 
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
<link rel="stylesheet" href="../s1.css">
    <title>Customer Pannel</title>
</head>
<body>
<h1> IT SHOP </h1>
<a href="index.php">  Customer Pannel!</a>

<a href="displayOrder.php">  History!</a>
<a href="../logout.php"> Logout!</a>
<br>
<br>
<hr>
<div class="gallery">
<h1> Our Products!</h1>
	<form method="POST" action="ProductList.php">
	<button type="submit" name="checkout"> check out </button>
	<table>
	<tr>
	<td>
<select name="category">
    <option disabled selected>-- Select Category--</option>
    <?php
	//mysqli_query($con,$q1);
        include "../config.php";  // Using database connection file here
        $records = mysqli_query($con, "SELECT `category` FROM `category`");  // Use select query here 

        while($data = mysqli_fetch_array($records))
        {
            echo "<option value='". $data['category'] ."'>" .$data['category'] ."</option>";  // displaying data in option menu
        }	
    ?>  
  </select>
  </td>
  <td>
	<select id="subCategory" name="subCategory">
  <option disabled selected>-- Select sub Category--</option>
    <?php
	//mysqli_query($con,$q1);
        include "../config.php";  // Using database connection file here
        $records = mysqli_query($con, "SELECT `subcategory` FROM `category`");  // Use select query here 

        while($data = mysqli_fetch_array($records))
        {
            echo "<option value='". $data['subcategory'] ."'>" .$data['subcategory'] ."</option>";  // displaying data in option menu
        }	
    ?></select>
</td>

  <td><input type="text" name="title"></td>
  <td> <button type="submit" name="btnSearch"> search </button>  </td>
  <td> <button type="submit" name="btnviewAll"> view All</button>  </td>
  </tr>
  </table>
        <?php 
		if($result->num_rows > 0)
 {
while($row =$result->fetch_assoc())
		{ ?> 
	<div style="float:left; padding:10px; margine:10px;">
		<br>
		Product Number:<?php echo $row['productid']?>
		<br>
				Category:<?php echo $row['category']?>
				<br>
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" width=100px height=100px /> 
      <br>
	  sub category:<?php echo $row['subCategory']?>
	   <br>
	  Price:<?php echo $row['price']?>
	   <br>
	 
	  
 

<?php 

echo '<br><a href="ViewProduct.php?id=' . $row['productid'].'">Add to Cart Now !</a>';
	
//$con->close();
?>
</div>	
<?php 
		}
		}
		else{
			
			echo "No record is found!";
		}
	 
                    
?>					
</div> 
 </form>
</body>
</html>