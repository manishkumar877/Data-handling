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
    if (isset($_REQUEST['bt_submit']))
	{	
   $id = $_REQUEST['id'];
   $sel_name = $_REQUEST['sel_name'];
   $sel_interest = $_REQUEST['sel_interest'];
   $c_date =$_REQUEST['c_date'];
   $certificate =$_REQUEST['certificate'];
   $sel_state = $_REQUEST['sel_state'];
   $e_date = $_REQUEST['e_date'];
	

    $target_dir = "certificate/";
$target_file = $target_dir . basename($_FILES["c_upload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["c_upload"]["size"] > 500000) {
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
  if (move_uploaded_file($_FILES["c_upload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["c_upload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
   
   $sql = "INSERT INTO `certificate` ( `sel_name`, `sel_interest`,`c_date`,`certificate`,`c_upload`,`e_date`) 
   VALUES (  '$sel_name','$sel_interest','$c_date','$certificate','$target_file','$e_date')";
	
    $result = $conn->query($sql);
    if ($result == TRUE) {
    	 ?>
	 <script>
	 alert("Record add successfully.");
	 window.location.href="certificate.php";
	 </script>
	 <?
    //echo "Record add successfully.";

    }else{
      echo "Error:". $sql . "<br>". $conn->error;
    }
	}
	
	
	
	
	 
  
  if($m_mode=="edit")
  {
	    if (isset($_REQUEST['bt_submit'])) 
		{	
      $id = $_REQUEST['id'];
   $sel_name = $_REQUEST['sel_name'];
   $sel_interest = $_REQUEST['sel_interest'];
   $certificate =$_REQUEST['certificate'];
   $sel_state = $_REQUEST['sel_state'];
       
        $interest=""; 
		
    foreach($interest1 as $chk1)  
       {  
          $interest.= $chk1.",";  
       } 
	   
	   
	   
	   /////////////////////
	   
	 $rand = rand(1000,9999);
    $target_dir = 'certificate/' . ( $rand + 1) . '.jpeg';
    $tf = fopen($target_dir, 'w');
    fclose($tf);
   $target_name = move_uploaded_file($_FILES['file_name']['$target_dir'], $target_dir);

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
   
  echo $sql = "UPDATE `form` SET `f_name`='$f_name',`m_name`='$m_name',`l_name`='$l_name',
`gender`='$gender',`dob`='$dob',
`interest`='$interest',`countries`='$countries',`state`='$state',`city`='$city' $f WHERE `id`='$id'";
	   
        $result = $conn->query($sql); 
        if ($result == TRUE) {		
	?>
	 <script>
	 alert("Record updated successfully.");
	 window.location.href="display2.php";
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
	 $sql = "DELETE FROM `certificate` WHERE `id`='$id'";
     $result = $conn->query($sql);
     if ($result == TRUE){
		 ?>
	 <script>
	 alert("Record delete successfully.");
	 window.location.href="display2.php";
	 </script>
	 <?
		//echo "Record delete successfully.";
    }else{      
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
  }
//////////////////////////////////////////////////////////////

?>    

