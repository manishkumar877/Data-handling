
<?php
include "config.php";
   $m_mode = $_REQUEST['m_mode'];
   $id = $_REQUEST['id'];
   $category_name = $_REQUEST['category_name'];
    echo $m_mode;

 if($m_mode=="add")
{ 
    if (isset($_REQUEST['submit']))
	{	

 echo $category_name = $_REQUEST['category_name'];
 
$sql = "INSERT INTO acts_category (category_name) VALUES 
    ('$category_name')";
	
    $result = $conn->query($sql);
    if ($result == TRUE) {
    
   	?>
	 <script>
	 alert("Record add successfully.");
	 window.location.href="category_display.php";
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
        $category_name = $_REQUEST['category_name'];
        $id = $_REQUEST['id'];
       
		
   
   $sql = "UPDATE `acts_category` SET `category_name`='$category_name'WHERE `id`='$id'";
	   
        $result = $conn->query($sql); 
        if ($result == TRUE) {		
	?>
	 <script>
	 alert("Record updated successfully.");
	 window.location.href="category_display.php";
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
	 
     $sql="DELETE FROM acts_category WHERE NOT EXISTS (SELECT category_name FROM acts WHERE FIND_IN_SET(acts_category.id, acts.category_name))and `id`='$id'";
     
      $result = $conn->query($sql);
	
     if ($result == TRUE){
		 ?>
	 <script>
	 alert("Record delete successfully.");
	 window.location.href="category_display.php";
	 </script>
	 <?
		//echo "Record delete successfully.";
    }else{      
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
  }

?>    
 