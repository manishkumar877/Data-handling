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
   $industry_name = $_REQUEST['industry_name'];

  if($m_mode==''){
	$m_mode="add";
  }
  //echo $m_mode;
  if($m_mode=="edit")	 
  {
    $sql = "SELECT * FROM acts_industry WHERE `id`='$id'";
    $result = $conn->query($sql); 
    $row = mysqli_fetch_array($result);
    if($result)
	{		
            $industry_name = $row['industry_name'];  
	}            	
 }

  ?>
  
<body >
<section class="container">
<h2>Add Industry</h2>
<form name="add_industry" method="POST">
<input type="hidden" name="m_mode" value="<?=$m_mode;?>">
	<input type="hidden" name="id" value="<?=$id;?>"> 
  <label >Category Name:-</label><br>
  <input type="text" name="industry_name" value= "<?php echo $industry_name; ?>" ><br><br>
  <button type="submit" name="submit" onclick="return valid_industry_name();"> Save </button>
</form>
<section> 
</body>
</html>