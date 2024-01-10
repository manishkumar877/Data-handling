<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?
   include 'config.php';
   $m_mode = $_REQUEST['m_mode'];
   $id = $_REQUEST['id'];
   $sel_countries = $_REQUEST['sel_countries'];
   $target_file = $_REQUEST['file_name'];
   $sel_state = $_REQUEST['sel_state'];
   $sel_city = $_REQUEST['sel_city'];
   $f_name = $_REQUEST['f_name'];
   $m_name = $_REQUEST['m_name'];
   $l_name = $_REQUEST['l_name'];
   $gender = $_REQUEST['gender'];
   $dob = $_REQUEST['dob'];
   $interest = $_REQUEST['interest'];

  if($m_mode==''){
	$m_mode="add";
  }

  //echo $m_mode;
  if($m_mode=="edit")	 
  {
    $sql = "SELECT * FROM `form` WHERE `id`='$id'";
    $result = $conn->query($sql); 
    $row = mysqli_fetch_array($result);
    if($result)
	{		
            $f_name = $row['f_name'];
            $m_name = $row['m_name'];
			$l_name = $row['l_name'];
		    $gender = $row['gender'];
            $sel_countries = $row['countries'];
			$exp = explode(',',$sel_countries);			
			$sel_state = $row['state']; 
            $sel_city = $row['city']; 	
            $dob = $row['dob'];
            $target_file = $row['file_name'];			
			$interest1 = $row['interest'];
            $m_interest  = rtrim($interest1,",");
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
<?
include("header.php");
?>
<!---------------------- NAN END--------------------------------->
<section class="container">
  <h1>FORM</h1>
  <form method="POST" name="contactForm" enctype="multipart/form-data">
    <input type="hidden" name="m_mode" value="<?=$m_mode;?>">
    <input type="hidden" name="id" value="<?=$id;?>">
    <label class="form-label">First name:-</label><br>
    <input type="text" class="form-control" pattern="[a-zA-Z ]*$" name="f_name" id="f_name" placeholder="Enter the First Name"
      value="<?php echo $f_name; ?>">
    <label class="form-label">Middle name:-</label><br>
    <input type="text" class="form-control" name="m_name" id="m_name" placeholder="Enter the Middle Name" value="<?php echo $m_name; ?>">
    <label class="form-label">Last name:-</label><br>
    <input type="text" class="form-control" name="l_name" id="l_name" placeholder="Enter the Last Name" value="<?php echo $l_name; ?>">
    <!--------------------Gender-------------------------------------->
    <label class="form-label">Gender:-</label><br>
    <input type="radio" class="form-check-input" name="gender" value="male" <?php if($gender=='male' ){?>checked
    <?}?>>Male
    <input type="radio" class="form-check-input" name="gender" value="female" <?php if($gender=='female' ){?>checked
    <?}?>>Female
    <input type="radio" class="form-check-input" name="gender" value="other" <?php if($gender=='other' ){?>checked
    <?}?>>Other
    <br>
    <!----------------------Gender End------------------------------>
	<!--------------------------Country------------------------>
	<label >Country:-</label>
   <select name="sel_countries" id="sel_countries_id" class="form-select" <?=$onchange;?>>
   <option  value="">Select Country</option>
    <?php
    $sql_country = "SELECT * FROM countries ";
    $countries1 = mysqli_query($conn,$sql_country);
    while($row5 = mysqli_fetch_array($countries1))
   {
		$id=$row5['id'];
    ?>
    <option  value="<?php echo $id?>" <?if($sel_countries == $id){?>selected<?} ?>><?php echo $row5["name"];?></option>
     <?php
   }
      ?>                     
     </select>
 	 
  <!----------------------------State------------------------------->
	<label for="state">State:-</label>
	
		<select name="sel_state" id="sel_state_id" class="form-select" <?=$onchange;?>> 
	   <option value="">Select State</option>
	   <?	
		 if(!empty($sel_countries))
		 {
			 $stmt3 = " where country_id ='$sel_countries'";
		 }
		 echo $sql_state = "SELECT * FROM states $stmt3";
		 $result1 = mysqli_query($conn,$sql_state);       
		  while($row1 = mysqli_fetch_array($result1)) {
			$id = $row1['id'];
			$name = $row1['name'];	
		?>
		<option value="<?php echo $id;?>" <?if($sel_state==$id){?>selected<?}?>><?php echo $name;?></option>		
		<?php
		}
		?>
		</select>
	<!--------------------City------------------------------>     
    <label for="city">City:-</label>
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
    <option value="<?php echo $row2["id"];?>" <?if($sel_city==$id){?>selected<?}?>><?php echo $row2["name"];?></option>
    <?php
   }
   ?>
    </select><br>
	
    <!------------------------------DOB--------------------------------->
    <label class="form-label">Date Of Birth:-</label> <br>
    <input type="date" class="form-control" name="dob" max="<?echo date('Y-m-d');?>" value="<?php echo $dob; ?>">
   
    <!-------------------------------------DOB end------------------------>

    <!-----------------------------Pdf------------------
    <label>PDF:-</label><br>
    <input type="file" name="fileToUpload" value="
	//
    <br> -->
    <!-----------------------------PDf end --------------->

    <!-----------------------------Upload------------------>
    <label class="form-label">Upload:-</label><br>
    <input type="file" name="file_name" class="form-control" value = "<? echo $target_file ?>"><? echo $target_file?>
    <!-----------------------------upload end --------------->

    <!----------------------------Mul-Upload-----------------------
    <label> Multiple Files Upload:-</label><br>
    <input type="file" name="mul_file_name[]" multiple value="
    <br>-->
    <!----------------------------- mul --upload end --------------->
    <!--------------------INTEREST-------------------->
    <label class="form-label">Interest:-</label><br>
    <?php
    //echo $m_interest;  
	$sports = explode(",","$m_interest");  
	$interest= mysqli_query($conn,"SELECT distinct * from interest");
	while($i= mysqli_fetch_array($interest)){
	$name = $i['name'];		
	$id = $i['id'];  
	?>
    <input type="checkbox" class="form-check-input" name="interest[]" value="<?php echo $id;?>" <?if (in_array($id,$sports)==$id){?>checked
    <?}?>>
    <?php echo $i['name']?>
    &nbsp;
    <?php                           
	}
	?>
    <br> <br>
    <!-----------------------------Button--------------------------------------->
    <button type="submit" class="btn btn-primary" name="btn_submit" onclick="return validateForm();"> Save </button>
  </form>
  </fieldset>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
  $(document).ready(function () {
    var mode = "<?=$m_mode;?>";
    //alert(mode);
    if (mode == "edit") {
      // alert("wedesdf");
      $("#sel_countries_id").change(function () {
        var sel_countries = $("#sel_countries_id").val();
        //alert(sel_countries);
        //alert("wsdesd");
        $("#sel_state_id").load("select.php?flag=country&sel_countries=" + sel_countries);
      })

      $("#sel_state_id").change(function () {
        var sel_state = $("#sel_state_id").val();
        $("#sel_city_id").load("select.php?flag=state&sel_state=" + sel_state);
      })
    }
    //$("#sel_countries_id").change(fu  nction(){
    //var sel_count = $("#sel_countries_id").val();
    //alert(sel_count);
    //window.location.reload();
    //})
    // $('#country-dropdown').on('change', function() {
    // var country_id = this.value;
    // $.ajax({
    // url: "states-by-country.php",
    // type: "POST",
    // data: {
    // country_id: country_id
    // },
    // cache: false,
    // success: function(result){
    // $("#state-dropdown").html(result);
    // $('#city-dropdown').html('<option value="">Select State //First</option>'); 
    // }
    // });
    // });    

    // $('#state-dropdown').on('change', function() {
    // var state_id = this.value; 
    // $.ajax({
    // url: "cities-by-state.php",
    // type: "POST",
    // data: {
    // state_id: state_id
    // },
    // cache: false,
    // success: function(result){
    // $("#city-dropdown").html(result);
    // }
    // }); 
    // });
  });
</script>
</body>

</html>