<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?
include("header.php");
?>
<br>
<br>
<?
   include 'config.php'; 
   $m_mode = $_REQUEST['m_mode'];
   $id = $_REQUEST['id'];   
   $name = $_REQUEST['name'];
   $country_id = $_REQUEST['country_id'];
  if($m_mode==''){
	$m_mode="add";
  }
  //echo $m_mode;
  if($m_mode=="edit")	 
  {
    $sql = "SELECT * FROM states WHERE `id`='$id'";
    $result = $conn->query($sql); 
    $row = mysqli_fetch_array($result);
    if($result)
	{		
            $name = $row['name'];
 $country_id = $row['country_id'];			
	}            	
 }

  ?>
  
<body >
<section class="container">
<h2>Add State</h2>
<form name="addstate" method="POST">
<input type="hidden" name="m_mode" value="<?=$m_mode;?>">
	<input type="hidden" name="id" value="<?=$id;?>"> 
	<!-----------------------country-------------------------------------->
    <label class="form-label" value="<?php echo $country_id;?>" >Countries:-</label>
	<select name="country_id"  class="form-select" > 
	   <option value="">Select Countries</option>
	   <?	
		 $sql_act = "SELECT * FROM countries ";
		 $result_act = mysqli_query($conn,$sql_act);       
		  while($row1 = mysqli_fetch_array($result_act)) {
			$id = $row1['id'];
			$name = $row1['name'];	
		?>
				<option value="<?php echo $id;?>" <?if($id == $name){?>selected<?}?>><?php echo $name;?></option>
		<?php
		}
		?>
		</select>
		
  <label class="form-label" >Category Name:-</label><br>
  <input type="text"  class="form-control" name="name" placeholder="Enter the State"  ><br><br>
  <button type="submit" name="submit" onclick="return valid_state();"> Save </button>
</form>
<section> 
</body>
</html>