
<?php
include "config.php";
   $m_mode = $_REQUEST['m_mode'];
   $id = $_REQUEST['id'];
   $industry_name = $_REQUEST['industry_name'];
    echo $m_mode;

 if($m_mode=="add")
{ 
    if (isset($_REQUEST['submit']))
	{	

 echo $industry_name = $_REQUEST['industry_name'];
 
$sql = "INSERT INTO acts_industry (industry_name) VALUES 
    ('$industry_name')";
	
    $result = $conn->query($sql);
    if ($result == TRUE) {
    
   	?>
	 <script>
	 alert("Record add successfully.");
	 window.location.href="industry_display.php";
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
        $industry_name = $_REQUEST['industry_name'];
        $id = $_REQUEST['id'];
       
		
   
   $sql = "UPDATE `acts_industry` SET `industry_name`='$industry_name'WHERE `id`='$id'";
	   
        $result = $conn->query($sql); 
        if ($result == TRUE) {		
	?>
	 <script>
	 alert("Record updated successfully.");
	 window.location.href="industry_display.php";
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
	 
     $sql="DELETE FROM acts_industry WHERE NOT EXISTS (SELECT interest FROM acts WHERE FIND_IN_SET(interest.id, form.interest))and `id`='$id'";
     
      $result = $conn->query($sql);
	
     if ($result == TRUE){
		 ?>
	 <script>
	 alert("Record delete successfully.");
	 window.location.href="industry_display.php";
	 </script>
	 <?
		//echo "Record delete successfully.";
    }else{      
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
  }

?>    
 