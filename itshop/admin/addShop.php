<?php include '../config.php';
 
// If file upload form is submitted 
$status = $statusMsg = ''; 
if(isset($_POST["submit"])){ 
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
         //title,adminId,address
		$title= $_POST['title'];
		$adminId= $_POST['adminId'];
		 $address=$_POST['address'];
		 
		 
            // Insert image content into database //////////////////////////////////////////////////////////////INSERT INTO `shop`( `image`, `uploaded`, `adminId`, `address`, `title`)
            $insert = $con->query("INSERT INTO `shop`( `image`, `uploaded`, `adminId`, `address`, `title`) VALUES ('$imgContent', NOW(),'$adminId','$address','$title')"); 
             if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
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


<form action="addShop.php" method="post" enctype="multipart/form-data">

<br><br>
Enter shop name: <input type="text" name="title">
<br><br>
Enter shop admin Id: <input type="text" name="adminId">
<br><br>
Enter shop address: <input type="text" name="address">
<br><br>
    <label>Select Image File:</label>
    <input type="file" name="image">
	<br><br>
	
	
    <input type="submit" name="submit" value="Upload">
</form>