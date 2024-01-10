	 <?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
	<?
	 include 'config.php';
	 $flag = $_REQUEST['flag'];
	 $sel_countries = $_REQUEST['sel_countries'];
	 $sel_state = $_REQUEST['sel_state'];
	 if($flag=="country")
	 {
		 ?>
   <select name="sel_state" id="sel_state_id" class="form-select" <?=$onchange;?>> 
   <option value="">Select State</option>
   <?	          
     if(!empty($sel_countries))
	 {
		 $stmt3 = " where country_id ='$sel_countries'";
     }
      $sql_state = "SELECT * FROM states $stmt3";
	 $result1 = mysqli_query($conn,$sql_state);       
	  while($row1 = mysqli_fetch_array($result1)) 
	  {
		$id = $row1['id'];
		$name = $row1['name'];	
	?>
	<option value="<?php echo $id;?>"><?php echo $name;?></option>		
	<?php
	}
	?>
    </select>

		 <?
	 }
	 
	 if($flag == "state")
	 {
		 ?>
		 <select name="sel_city" id="sel_city_id" class="form-control" <?=$onchange?>>
	<option value="">Select City</option>
	<?
	if(!empty($sel_state))
	{
		$stmt4 = " where state_id = $sel_state"; 
	}  
	echo $sql_city = "SELECT * FROM cities $stmt4";
    $result = mysqli_query($conn,$sql_city);
    while($row2 = mysqli_fetch_array($result)) {
		$id = $row2['id'];
   ?>
    <option value="<?php echo $row2["id"];?>"><?php echo $row2["name"];?></option>
    <?php
   }
   ?>
    </select><br>
		 <?
	 }
	 
	?>