 <?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?
   include 'config.php';
   
   $id = $_REQUEST['id'];
   $sel_name = $_REQUEST['sel_name'];   
   $sel_interest = $_REQUEST['sel_interest'];
   $certificate =$_REQUEST['certificate'];
   $sel_state = $_REQUEST['sel_state'];
  ?>	

<?
include("header.php");
?>
  <!----------------------------- NAN END --------------------------------->
  <section class="container" >
    <h1>FORM</h1>
	<form method="POST" name="contactForm1"  enctype="multipart/form-data"> 
	<label>First name:-</label><br>
	<select name="sel_name" onchange="form.submit()">
   <option value="">Select</option>
  <?php
    //echo $m_interest;  
	echo $sql = "SELECT * from form";
	$interest1= mysqli_query($conn,$sql);
	while($row= mysqli_fetch_array($interest1)){	
	$name = $row['f_name'];  
	$id = $row['id'];
	?>
    <option value="<?=$id;?>" <?if($sel_name==$id){?>selected<?}?>><?=$name;?></option>
   &nbsp;
	<?php                           
	}
	?>
	</select><br>
    <!--------------------INTEREST--------------------> 
   <label>Interest:-</label><br>
   <select name="sel_interest">
    <option value="">Select</option>
  <?php
  if(!empty($sel_name))
  {
	  $stmt  = " where  id='$sel_name'"; 
  }
   
	 echo $sql = "SELECT  * from form $stmt" ;
	$interest= mysqli_query($conn,$sql);
	while($i= mysqli_fetch_array($interest)){	
	$interest = $i['interest']; 
	$name =$i['name'];
    $m_interest= explode(",",$interest);
	 
     foreach($m_interest as $value)
	 {
		
       $sql_in = "select * from interest where id in($value)";
					  $res = mysqli_query($conn,$sql_in);
					  $myrow = mysqli_fetch_array($res);
					  $name = $myrow['name'];

		
		?>
		<option value="<?=$value?>"><?echo $name?></option>
        <?		
	 }	 
	?>
   &nbsp;
	<?php                           
	}
	?>
	</select>
   <br>
      <!-----------------------------Current Date------------------>
     <label>Current Date:-</label><br>
<input type="date" name="c_date"  max="<?echo date('Y-m-d');?>" value="<?php echo $c_date; ?>">
<br>
<!-----------------------------Current Date End --------------->
   <!---------------------Certificate------------------------->
   <label>Certificate:-</label><br>
   <input type="text" name="certificate" > 
   <br>
   <!--------------------------Certificate -- End----------------------------------->
   <!-----------------------------Upload------------------>
<label>Upload:-</label><br>
<input type="file" name="c_upload" value="<?=$target_file?>"><?=$target_file?> 
<br>
<!-----------------------------upload end --------------->
   <!-----------------------------Exp Date------------------>
     <label>Expire Date:-</label><br>
<input type="date" name="e_date" value="<?=$e_date?>">
<br>
<!-----------------------------Exp Date End --------------->
  <!----------------------------State------------------------------->
	<label for="state">State:-</label>
	 <input type="hidden" name="sel_state">
	   <?
	   if(!empty($sel_name))
      {
	  $stmt31  = "and b.id='$sel_name'"; 
       }
	   if(empty($sel_name))
      {
	    die; 
      }
		 $sql_state = "SELECT a.name from states a,form b where a.id=b.state $stmt31";   
		 $result1 = mysqli_query($conn,$sql_state);       
		  while($row1 = mysqli_fetch_array($result1)) {
		echo  $state = $row1['name'];
		
		?>
		<input  type="hidden" value="<?php echo $name;?>" <?if($state==$name){?>selected<?}?>>
		</input>
        		
		<?php
		}
		?>
		</label> <br>
		<!-----------------------------Button--------------------------------------->
     <button type="submit" name="bt_submit" onclick="return validate();"> Save </button>
   </form>
  
   </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
	
	</script>
	</body>
   </html>                         

