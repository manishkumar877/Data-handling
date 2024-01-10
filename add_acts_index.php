 <?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?php
   include 'config.php';
   include("header.php");
   
   echo $m_mode;
   
   $m_mode = $_REQUEST['m_mode'];
   $id = $_REQUEST['id'];
   $category_name = $_REQUEST['category_name'];
   $short_title = $_REQUEST['short_title'];
   $description = $_REQUEST['description'];
   $applicabillity = $_REQUEST['applicabillity'];
   $wef = $_REQUEST['wef'];
   $state = $_REQUEST['state'];
   $industry_name = $_REQUEST['industry_name'];
   $target_file = $_REQUEST['file_name'];
   $act_type = $_REQUEST['act_type'];

  if($m_mode==''){
	$m_mode="add";
  }

  //echo $m_mode;
  if($m_mode=="edit")	 
  {
    $sql = "SELECT * FROM `acts` WHERE `id`='$id'";
    $result = $conn->query($sql); 
    $row = mysqli_fetch_array($result);
    if($result)
	{		
   $category_namee = $row['category_name'];
   $short_title = $row['short_title'];
   $description = $row['description'];
   $applicabillity = $row['applicabillity'];
   $wef = $row['wef'];
   $state = $row['state'];
   $industry_name = $row['industry_name'];
   $m_industry_name  = rtrim($industry_name,",");
   $target_file = $row['file_name'];
   $act_type = $row['act_type'];		
	
	}            	
 }
 
 if($m_mode == "add")
 {
	 $onchange = "onchange='form.submit()'";
 }
else if($m_mode == "edit")
{
	$onchange = "";
}

?>
<!---------------------- NAN END--------------------------------->
<section class="container">
  <h1>ACTS FORM</h1>
  <form method="POST" name="actsForm" enctype="multipart/form-data">
    <input type="hidden" name="m_mode" value="<?=$m_mode;?>">
    <input type="hidden" name="id" value="<?=$id;?>">

	<!-----------------------Act Category------------------->
    <label class="form-label" value="<?php echo $category_name;?>" for="category_name">Act Category:-</label>
	<select name="category_name"  class="form-select" > 
	   <option value="">Select Category</option>
	   <?	
		 $sql_act = "SELECT * FROM acts_category ";
		 $result_act = mysqli_query($conn,$sql_act);       
		  while($row1 = mysqli_fetch_array($result_act)) {
			$id = $row1['id'];
			$category_name = $row1['category_name'];	
		?>
				<option value="<?php echo $id;?>" <?if($id == $category_namee){?>selected<?}?>><?php echo $category_name;?></option>
		<?php
		}
		?>
		</select>
   <!---------------------Short Title-------------------------->
    <label class="form-label">Short Title:-</label>
    <input type="text" class="form-control" name="short_title"  placeholder="Enter the Title" value="<?php echo $short_title; ?>">
    <!---------------------------------------------->
	<label class="form-label">Description:-</label>
    <input type="text" class="form-control" name="description" placeholder="Enter the Description" value="<?php echo $description; ?>">
	<!------------------------------------------->
	<label class="form-label">Application (Only Number):-</label>
    <input type="text" class="form-control" pattern="[0-9]" name="applicabillity" placeholder="Enter the Application" value="<?php echo $applicabillity; ?>">
    <!------------------------------W.E.F--------------------------------->
    <label class="form-label">W.E.F :-</label>
    <input type="date" class="form-control" name="wef"  value="<?php echo $wef; ?>">

    <!-------------------------------------W.E.F end------------------------>
<!------------state--------------------->
	<label class="form-label" for="state">State:-</label>
		<select name="state"  class="form-select" > 
	   <option value="">Select State</option>
	   <?	
		 $sql_state = "SELECT * FROM states ";
		 $result1 = mysqli_query($conn,$sql_state);       
		  while($row1 = mysqli_fetch_array($result1)) {
			$id = $row1['id'];
			$name = $row1['name'];	
		?>
		<option value="<?php echo $id;?>" <?if($state==$id){?>selected<?}?>><?php echo $name;?></option>		
		<?php
		}
		?>
		</select>
    <!-----------------------------Industry------------------>
    <label class="form-label" >Industry:-</label>
		<select name="industry_name[]" id="industry_name"  class="form-select" multiple > 
	   <option value="">Select Industry</option>
	   <?php
	   echo $sports = explode(",","$m_industry_name");
		 $sql = "SELECT * FROM acts_industry ";
		 $result = mysqli_query($conn,$sql);       
		  while($row = mysqli_fetch_array($result)) {
			$id = $row['id'];	
		?>
		<option value="<?php echo $id;?>" <?if (in_array($id,$sports)==$id){?>selected<?}?>><?php echo $row["industry_name"];?></option>		
		<?php
		}
		?>
		</select>
    <!-----------------------------Industry end --------------->

    <!-----------------------------Upload------------------>
    <label class="form-label">File:-</label><br>
    <input type="file" class="form-control" name="file_name" value = "<? echo $target_file ?>"><? echo $target_file?><br>
    
    <!-----------------------------upload end --------------->
    <!--------------------Type of Act-------------------->
    <label class="form-label">Type of Act:-</label><br>
<select class="form-select" value="<?php echo $act_type;?>" name="act_type" >
<option value="" > select </option>
<option value="Static" <? if($act_type=="Static"){?>selected<?} ?>>Static </option>
<option value="Domestic" <? if($act_type=="Domestic"){?>selected<?} ?> > Domestic </option>

</select>
    <br>
    <!-----------------------------Button--------------------------------------->
    <button type="submit" class="btn btn-primary" name="btn_submit" onclick="return acts_form();"> Save </button>
  </form>
  </fieldset>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="js/acts_form.js"> </script>
</body>
</html>