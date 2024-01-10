

<?php
include "config.php";
$m_mode = $_REQUEST['m_mode'];
$id = $_REQUEST['id'];
echo $m_mode;


 if($m_mode=="add")
{ 
    if (isset($_REQUEST['btn_submit']))
	{	

   $category_name = $_REQUEST['category_name'];
   $short_title = $_REQUEST['short_title'];
   $description = $_REQUEST['description'];
   $applicabillity = $_REQUEST['applicabillity'];
   $wef = $_REQUEST['wef'];
   $state = $_REQUEST['state'];
    $act_type = $_REQUEST['act_type'];
   $industry_name = $_REQUEST['industry_name'];
    $industry_string= implode(",", $industry_name);  


 
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

 
 $sql = "INSERT INTO `acts` (`category_name`, `short_title`, `description`, `applicabillity`, `wef`, `state`, `industry_name`, `file_name`, `act_type`) 
   VALUES ('$category_name', '$short_title', '$description', '$applicabillity', '$wef', '$state', '$industry_string', '$target_file', '$act_type')";
	
	
    $result = $conn->query($sql);
    if ($result == TRUE) {
    
   	?>
	 <script>
	 alert("Record add successfully.");
	 window.location.href="acts_display.php";
	 </script>
	 <?

    }else{
      echo "Error:". $sql . "<br>". $conn->error;
    }
	}
}
	
	
	
	
	 
  if($m_mode=="edit")
  {
	    if (isset($_REQUEST['btn_submit'])) 
		{	
	   $category_name = $_REQUEST['category_name'];
	    $id = $_REQUEST['id'];
   $short_title = $_REQUEST['short_title'];
   $description = $_REQUEST['description'];
   $applicabillity = $_REQUEST['applicabillity'];
   $wef = $_REQUEST['wef'];
   $state = $_REQUEST['state'];
    $act_type = $_REQUEST['act_type'];
   $industry_name = $_REQUEST['industry_name'];
   echo $industry_string= implode(",", $industry_name);  

	   
	   
	   //////////////////////////////////////////////////////////////////////////
	 
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["file_name"]["name"]);
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


   
   $sql = "UPDATE `acts` SET `category_name`='$category_name',`short_title`='$short_title',`description`='$description',
`applicabillity`='$applicabillity',`wef`='$wef',`file_name`='$target_file',`industry_name`='$industry_string',
`state`='$state',`act_type`='$act_type' $f WHERE `id`='$id'";
	   
        $result = $conn->query($sql); 
        if ($result == TRUE) {		
	?>
<script>
  alert("Record updated successfully.");
  window.location.href = "acts_display.php";
</script>
<?
           // echo "Record updated successfully.";
        }else{
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }
  }
  

	
	/////////////////////////////////////////////
  if($m_mode=="delete")
  {  
	 
     $sql="DELETE FROM acts where `id`='$id'";
     
      $result = $conn->query($sql);
	
     if ($result == TRUE){
		 ?>
	 <script>
	 alert("Record delete successfully.");
	 window.location.href="acts_display.php";
	 </script>
	 <?
		//echo "Record delete successfully.";
    }else{      
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
  }

?>