<?php include '../config.php';
 
// If file upload form is submitted 

$status = $statusMsg = ''; 
if(isset($_POST["submit"]))
{ 
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) 
	{ 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
                                     // INSERT INTO `products`(`image`, `uploaded`, `subCategory`, `category`, `price`, `title`)
		// VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')
		$title= $_POST['title'];
		$subcategory= $_POST['subcategory'];
		$category= $_POST['category'];
		 $price=$_POST['price'];
		 
		 $quantity=$_POST['quantity'];
		 
		// `ShopID`, `Specifications`, `Remarks` 
		 		 $ShopID=$_POST['ShopID'];
				 		 $Specifications=$_POST['Specifications'];
						 		 $Remarks=$_POST['Remarks'];
		 
		 
		 $status="ok";
           // `ShopID`, `Specifications`, `Remarks` 
            $insert = $con->query("INSERT INTO `products`(`image`, `uploaded`, `subCategory`, `category`, `price`, `title`, `quantity`,`status`,`ShopID`, `Specifications`, `Remarks` ) VALUES ('$imgContent', NOW(),'$subcategory','$category','$price','$title','$quantity','$status','$ShopID', '$Specifications', '$Remarks' )"); 
             if($insert){ 
                $status = 'success'; 
                $statusMsg = "Product is added successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 
 
// Display status message 
echo $statusMsg; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
   <link rel="stylesheet" href="../s1.css">
    <title>Add Products</title>
</head>

<h1>Add Products</h1>
<form action="addProducts.php" method="post" enctype="multipart/form-data">

<table>
<tr><td><a href="index.php">Home</a></td><td><a href="../logout.php"> Logout!</a></td></tr>

 
<tr><td>Select category: </td><td>
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




</td></tr>
<tr><td>Select Sub category:</td><td>
<select name="subcategory">
    <option disabled selected>-- Select Sub Category--</option>
    <?php
	//mysqli_query($con,$q1);
        include "../config.php";  // Using database connection file here
        $records = mysqli_query($con, "SELECT `subcategory` FROM `category`");  // Use select query here 

        while($data = mysqli_fetch_array($records))
        {
            echo "<option value='". $data['subcategory'] ."'>" .$data['subcategory'] ."</option>";  // displaying data in option menu
        }	
    ?>  
  </select>


</td></tr>

<tr><td>Enter Product name:</td><td><input type="text" name="title"></td></tr>
<tr><td>Enter price:</td><td><input type="Number" name="price"></td></tr>
<tr><td>Enter Quantity:</td><td><input type="Number" name="quantity"></td></tr>
 
<tr><td><label>Select Image File:</label></td><td><input type="file" name="image"></td></tr>
    
<tr><td>Enter Product Details:</td><td><input type="text" name="Specifications"></td></tr>
<tr><td>Enter Remarks:</td><td><input type="text" name="Remarks"></td></tr>
<tr><td>Enter Shop ID:</td><td><input type="Number" name="ShopID"></td></tr>
  
	
<tr><td></td><td><input type="submit" name="submit" value="Add Product"></td></tr>	
	
    
	<tr><td></td><td></td></tr>
	
	</table>
</form>
</body>
</html>