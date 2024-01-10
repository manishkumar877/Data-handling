
<?
include("header.php");
?>
<br>
<br>
<?
   include 'config.php'; 
   $m_mode = $_REQUEST['m_mode'];
   $id = $_REQUEST['id'];   
   $interest = $_REQUEST['name'];

  if($m_mode==''){
	$m_mode="add";
  }
  //echo $m_mode;
  if($m_mode=="edit")	 
  {
    $sql = "SELECT * FROM `interest` WHERE `id`='$id'";
    $result = $conn->query($sql); 
    $row = mysqli_fetch_array($result);
    if($result)
	{		
            $interest = $row['name'];  
	}            	
 }

  ?>


<!DOCTYPE html>
<html>
<script type="text/javascript" src="js/interest_validate.js"> 
   </script>
  <script type="text/javascript" src="js/jquery-3.6.3.min.js"> 
  </script>
<body >
<section class="container">
<h2>Add City</h2>
<form name="add_city" method="POST" >
<input type="hidden" name="m_mode" value="<?=$m_mode;?>">
	<input type="hidden" name="id" value="<?=$id;?>">
    <label> State Name:-</label><br>
	<select name="state" onchange="form.submit()">
   <option value="">Select</option>
  <?php
    //echo $m_interest;  
	echo $sql = "SELECT * from states";
	$interest1= mysqli_query($conn,$sql);
	while($row= mysqli_fetch_array($interest1)){	
	$name = $row['name'];  
	$id = $row['id'];
	?>
    <option value="<?=$id;?>" <?if($name==$id){?>selected<?}?>><?=$name;?></option>
   &nbsp;
	<?php                           
	}
	?>
	</select><br>	
  <label >City Name:-</label><br>
  <input type="text" name="name" value= "<?php echo $interest; ?>" ><br><br>
  <button type="submit" name="submit1" > Save </button>
</form>
<section> 
</body>
</html>