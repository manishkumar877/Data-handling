<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?php
include "config.php";
$m_mode = $_REQUEST['m_mode'];
$id = $_REQUEST['id'];
echo $m_mode;


 if($m_mode=="add")
{   
if (isset($_REQUEST['btn_submit']))
{
 
    $f_name = $_REQUEST['f_name'];
    $m_name = $_REQUEST['m_name'];
    $l_name = $_REQUEST['l_name'];
    $gender = $_REQUEST['gender'];
	$dob = $_REQUEST['dob'];
    $countries = $_REQUEST['sel_countries'];
	$state = $_REQUEST['sel_state'];
	$city = $_REQUEST['sel_city'];
	$interest1 = $_REQUEST['interest'];
    $interest="";  
    foreach($interest1 as $chk1)  
       {  
          $interest.= $chk1.",";  
       }  
  $target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["file_name"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check file size
if ($_FILES["file_name"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif"   ) {
  echo "Sorry, only JPG, JPEG, PNG , PDF & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["file_name"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}


/////////////////pdf/////////////////


// $target_dir = "testupload/";
// $target_filess = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $uploadOk = 1;

//Check if file is a DOC or PDF file
// $fileType = strtolower(pathinfo($target_filess, PATHINFO_EXTENSION));
// if ($fileType != "doc" && $fileType != "pdf") {
  // echo "Sorry, only DOC and PDF files are allowed.";
  // $uploadOk = 0;
// }

// if ($uploadOk == 0) {
  // echo "Sorry, your file was not uploaded.";
  //if everything is ok, try to upload file
// } else {
  // if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_filess)) {
    // echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
  // } else {
    // echo "Sorry, there was an error uploading your file.";
  // }
// }

	$sql_duplicate = "select * from form where f_name='$f_name' and m_name='$m_name' and l_name='$l_name'";
    $m_duplicate = mysqli_query($conn,$sql_duplicate);
    $res = mysqli_num_rows($m_duplicate);
		
	if($res == '0')	
	{	
	
   $sql = "INSERT INTO form ( `f_name`, `m_name`, `l_name`, `state`, `city`, `gender`,`dob`,`upload_file` ,`countries`, `interest`) 
   VALUES ('$f_name','$m_name','$l_name','$state','$city','$gender','$dob','$target_file','$countries','$interest')";
	
    $result = $conn->query($sql);
    if ($result == TRUE) {
     ?>
<script>
  alert("Record add successfully");
  window.location.href = "display.php";
</script>
<?
    //echo "Record add successfully.";

    }else{
      echo "Error:". $sql . "<br>". $conn->error;
    } 
 
	}
	else
	{
		// echo "Record Already Exists";
		   ?>
<script>
  alert("Record Already Exists");
  window.location.href = "display.php";
</script>
<?
	}
    $conn->close();
   }
  }
 
 
  
  if($m_mode=="edit")
  {
	    if (isset($_REQUEST['btn_submit'])) 
		{	
        $f_name = $_REQUEST['f_name'];
        $id = $_REQUEST['id'];
        $m_name = $_REQUEST['m_name'];
		$l_name = $_REQUEST['l_name'];
        $gender = $_REQUEST['gender'];
		$dob = $_REQUEST['dob'];
		$target_file = $_REQUEST['file_name'];
		$countries = $_REQUEST['sel_countries'];
	    $state = $_REQUEST['sel_state'];
	    $city = $_REQUEST['sel_city'];
        $interest1 = $_REQUEST['interest'];
       
        $interest=""; 
		
    foreach($interest1 as $chk1)  
       {  
          $interest.= $chk1.",";  
       } 
	   
	   
	   
	   //////////////////////////////////////////////////////////////////////////
	   
	 $rand = rand(1000,9999);
    $target_dir = 'upload/' .( $rand + 1) . '.jpeg';
    $tf = fopen($target_dir, 'w');
    fclose($tf);
   $target_name = $_FILES['file_name']['tmp_name'];

$target_file = $target_dir .$target_name; 
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check file size
if ($_FILES["file_name"]["size"] > 500000) {
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
  if (move_uploaded_file($_FILES["file_name"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["file_name"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}	   

if(!empty($_FILES["file_name"]["tmp_name"])){
echo "yes";
echo $f=",`upload_file`='$target_file' ";
}else{
	echo"no";
}
   
   $sql = "UPDATE `form` SET `f_name`='$f_name',`m_name`='$m_name',`l_name`='$l_name',
`gender`='$gender',`dob`='$dob',`upload_file`='$target_file',
`interest`='$interest',`countries`='$countries',`state`='$state',`city`='$city' $f WHERE `id`='$id'";
	   
        $result = $conn->query($sql); 
        if ($result == TRUE) {		
	?>
<script>
  alert("Record updated successfully.");
  window.location.href = "display.php";
</script>
<?
           // echo "Record updated successfully.";
        }else{
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }
  }
  

  if($m_mode=="delete")
  {  
	 $sql = "DELETE FROM `form` WHERE `id`='$id'";
     $result = $conn->query($sql);
     if ($result == TRUE){
		 ?>
<script>
  alert("Record delete successfully.");
  window.location.href = "display.php";
</script>
<?
		//echo "Record delete successfully.";
    }else{      
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
  }
//////////////////////////////////////////////////////////////

?>