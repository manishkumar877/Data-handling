
<?php
include "config.php";
   $m_mode = $_REQUEST['m_mode'];
   $id = $_REQUEST['id'];
 echo$interest = $_REQUEST['name'];
    echo $m_mode;

 if($m_mode=="add")
{ 
    if (isset($_REQUEST['submit']))
	{	

 echo $interest = $_REQUEST['name'];
 
$sql = "INSERT INTO interest (name) VALUES 
    ('$interest')";
	
    $result = $conn->query($sql);
    if ($result == TRUE) {
    
   	?>
	 <script>
	 alert("Record add successfully.");
	 window.location.href="interest_display.php";
	 </script>
	 <?

    }else{
      echo "Error:". $sql . "<br>". $conn->error;
    }
	}
}
	/////////////////////////////////////////////////
	  
  if($m_mode=="edit")
  {
	    if (isset($_REQUEST['submit'])) 
		{	
        $interest = $_REQUEST['name'];
        $id = $_REQUEST['id'];
       
		
   
   $sql = "UPDATE `interest` SET `name`='$interest'WHERE `id`='$id'";
	   
        $result = $conn->query($sql); 
        if ($result == TRUE) {		
	?>
	 <script>
	 alert("Record updated successfully.");
	 window.location.href="interest_display.php";
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
	 
     $sql="DELETE FROM interest WHERE NOT EXISTS (SELECT interest FROM form WHERE FIND_IN_SET(interest.id, form.interest))and `id`='$id'";
     
      $result = $conn->query($sql);
	
     if ($result == TRUE){
		 ?>
	 <script>
	 alert("Record delete successfully.");
	 window.location.href="interest_display.php";
	 </script>
	 <?
		//echo "Record delete successfully.";
    }else{      
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
  }

?>    
 