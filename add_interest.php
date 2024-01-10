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
  
<body >
<section class="container">
<h2>Add Interest</h2>
<form name="interestform" method="POST">
<input type="hidden" name="m_mode" value="<?=$m_mode;?>">
	<input type="hidden" name="id" value="<?=$id;?>"> 
  <label >Interest name:-</label><br>
  <input type="text" name="name" value= "<?php echo $interest; ?>" ><br><br>
  <button type="submit" name="submit" onclick="return valid_interest();"> Save </button>
</form>
<section> 
</body>
</html>