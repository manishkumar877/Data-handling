
<?php
include "config.php";
   $m_mode = $_REQUEST['m_mode'];
   $id = $_REQUEST['id'];
 echo$name = $_REQUEST['name'];
    echo $m_mode;

 if($m_mode=="add")
{ 
    if (isset($_REQUEST['submit']))
	{	

 echo $name = $_REQUEST['name'];
 $country_id = $_REQUEST['country_id'];
 
 
$sql = "INSERT INTO `states` ( `country_id`, `name`, `status`) VALUES ( '$country_id', '$name', '1')";
	
    $result = $conn->query($sql);
    if ($result == TRUE) {
    
   	?>
	 <script>
	 alert("Record add successfully.");
	 window.location.href="state_display.php";
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
        $name = $_REQUEST['name'];
        $id = $_REQUEST['id'];
		$country_id = $_REQUEST['country_id'];
       
		
   
   $sql = "UPDATE `states` SET  `country_id`='$country_id',`name`='$name'WHERE `id`='$id'";
	   
        $result = $conn->query($sql); 
        if ($result == TRUE) {		
	?>
	 <script>
	 alert("Record updated successfully.");
	 window.location.href="state_display.php";
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

 $sql ="DELETE FROM states WHERE NOT EXISTS ( SELECT 1 FROM form WHERE states.id = SUBSTRING_INDEX(form.state, ',', 1) UNION SELECT 1 FROM acts WHERE states.id = SUBSTRING_INDEX(acts.state, ',', 1) ) AND  id = '$id'";
    
      $result = $conn->query($sql);
 		
     if ($result == TRUE){
		 ?>
	 <script>
	
	 window.location.href="state_display.php";
	 </script>
	 <?
		//echo "Record delete successfully.";
    }else{      
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
  }

?>    
 