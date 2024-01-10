<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">	  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hello, world!</title>
  
    <style>
    #f_nameErr{ 
   color:Tomato;
    }
    #l_nameErrr{ 
   color:Tomato;
    }
   #genderErr{ 
    color:Tomato;
   }
  </style>

   <script type="text/javascript" src="js/valid.js"> 
   </script>
  <script type="text/javascript" src="js/jquery-3.6.3.min.js"> 
  </script>
  </head>
<body>
<!-----------------------NAV------------------------------->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="first.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="first.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="display.php">Display</a>
        </li>
		 </li>
		        <li class="nav-item">
          <a class="nav-link active" href="certificate.php">Certificate</a>
        </li>
		 <li class="nav-item">
          <a class="nav-link active" href="display2.php">Display 2</a>
        </li>
      </ul>
	  <div class="form">
        <p><?php echo $_SESSION['username']; ?></p>
        <p><a href="logout.php">Logout</a></p>
    </div>
    </div>
   </div>
   </nav>
<!---------------------- NAN END--------------------------------->
  <section class="container" >
    <h1>FORM</h1>
	<form method="POST"  name="contactForm" enctype="multipart/form-data">
	<input type="hidden" name="m_mode" value="<?=$m_mode;?>">
	<input type="hidden" name="id" value="<?=$id;?>"> 
	<label>First name:-</label><br>
	<input type="text" pattern="[a-zA-Z ]*$" name="f_name" id="f_name" placeholder="Enter the First Name" 
	value= "<?php echo $f_name; ?>" ><br>
	<label>Middle name:-</label><br>
	<input type="text" name="m_name"  id="m_name" placeholder="Enter the Middle Name" 
	value= "<?php echo $m_name; ?>" ><br>
	<label>Last name:-</label><br>
	<input type="text" name="l_name"  id="l_name" placeholder="Enter the Last Name" 
	value= "<?php echo $l_name; ?>" ><br>
	<!--------------------Gender-------------------------------------->
	<label>Gender:-</label><br>
	<input type="radio" name="gender" value="male" <?php  if($gender=='male'){?>checked<?}?>>Male
	<input type="radio" name="gender" value="female" <?php if($gender=='female'){?>checked<?}?>>Female
	<input type="radio" name="gender" value="other" <?php if($gender=='other'){?>checked<?}?>>Other
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
<label>Date Of Birth:-</label> <br>
<input type="date" name="dob" max="<?echo date('Y-m-d');?>" value="<?php echo $dob; ?>" >
<br>
<!-------------------------------------DOB end------------------------>

<!-----------------------------Pdf------------------>
<label>PDF:-</label><br>
<input type="file" name="fileToUpload">
<br>
<!-----------------------------PDf end --------------->

<!-----------------------------Upload------------------>
<label>Upload:-</label><br>
<input type="file" name="file_name" value="<?=$target_file?>"><?=$target_file?>
<br>
<!-----------------------------upload end --------------->

<!----------------------------Mul-Upload----------------------->
<label> Multiple Files Upload:-</label><br>
<input type="file" name="mul_file_name[]" multiple value="<?=$target_files?>">
<br>
<!----------------------------- mul --upload end --------------->
	    <!--------------------INTEREST--------------------> 
   <label>Interest:-</label><br>
  <?php
    //echo $m_interest;  
	$sports = explode(",","$m_interest");  
	$interest= mysqli_query($conn,"SELECT distinct * from interest");
	while($i= mysqli_fetch_array($interest)){
	$name = $i['name'];		
	$id = $i['id'];  
	
	?>
   <input type="checkbox" name="interest[]" value="<?php echo $id;?>"
   <?if (in_array($id,$sports)== $id){?>checked<?}?>><?php echo $i['name']?>
   &nbsp;
	<?php                           
	}
	?>
   <br><br>
		<!-----------------------------Button--------------------------------------->
  <button type="submit" name="btn_submit" onclick="return validateForm();"> Save </button>
   </form>
   </fieldset>
   </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <script>
   $(document).ready(function() {
	   var mode = "<?=$m_mode;?>";
	   //alert(mode);
	   if(mode == "edit")
	   {
		  // alert("wedesdf");
		  $("#sel_countries_id").change(function(){
			  var sel_countries = $("#sel_countries_id").val();
			  //alert(sel_countries);
			  //alert("wsdesd");
			  $("#sel_state_id").load("select.php?flag=country&sel_countries="+sel_countries);
		  })
		  
		  $("#sel_state_id").change(function(){
			  var sel_state = $("#sel_state_id").val();
			  $("#sel_city_id").load("select.php?flag=state&sel_state="+sel_state);
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

