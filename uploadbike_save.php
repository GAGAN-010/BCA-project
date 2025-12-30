<?php 
include 'conn.php';
session_start();

	
//photo code	
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["btnupload"])) 
{
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }

//photo code ended



	


	$image=test_input($_POST['image']);
	$bno=test_input($_POST['bno']);
	$insure=test_input($_POST['insure']);
	$bname=test_input($_POST['bikename']);
	$company=test_input($_POST['cname']);
  $uid=$_SESSION['EMAIL'];


	$mysqli=connectdb();

	
	{
				
				{	
					$query = "INSERT INTO uploadbike(photo,bno,insure,bname,bcompany,uemail) VALUES(?,?,?,?,?,?)";
					$statement = $mysqli->prepare($query);
					//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
					$statement->bind_param('ssssss',$target_file,$bno,$insure,$bname,$company,$uid);
					if($statement->execute())
					{
						//sending mail
						
						
						
					echo '<script type="text/javascript">alert("bike successfully uploaded!!!") ;   window.location="viewownbike.php";;</script>';	
					}
					else
					{
					   echo '<script type="text/javascript">alert("Error... in uploading try again!") ;  window.history.back();</script>';
					}
					
					$statement->close();
					
				}	
	}
//} 
//else
//{
//	echo  '<script type="text/javascript">alert("Confirm Password Does not Match"); window.history.back();</script>';
//}

}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>
