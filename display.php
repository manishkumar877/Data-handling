 <?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
 <?php
 include 'config.php';
 $valueToSearch = $_REQUEST['valueToSearch'];
  $valueTooSearch = $_REQUEST['valueTooSearch'];
  $valueTSearch = $_REQUEST['valueTSearch'];
 $valueToo = $_REQUEST['valueToo'];
  $valueToname = $_REQUEST['valueToname'];

	if(!empty($valueToSearch))
	{
		$stmt = " and find_in_set('$valueToSearch',interest)";
	}
	if(!empty($valueTSearch))
	{
		$stmtt = " and countries='$valueTSearch'";
	}
	if(!empty($valueTooSearch))
	{
		$stmtt = " and state='$valueTooSearch'";
	}
	if(!empty($valueToo))
	{
		$stmt1 = " and gender='$valueToo'";
	}
	if(!empty($valueToname))
	{
		$stm = " and f_name='$valueToname'";
	}                                                                                        	
 ?> 
 <?
include("header.php");
?>
         <div class="container">
        <form action="" method="POST">
		 <!-------------Country---------------------->
		<lable>Country:-</lable>
	<select type="text" name="valueTSearch"  onchange="form.submit()">
	<option value="">select</option>
	<?php
	
	$sql = "select distinct b.name,b.id from form a,countries b where a.countries=b.id";
	$countrie = mysqli_query($conn,$sql);
	while($m= mysqli_fetch_array($countrie)){	
	$name = $m['name'];
	$id =$m['id'];
	

	?>
	
	<option  value="<?=$id?>" <?if($id==$valueTSearch){?>selected<?}?>><?=$name;?></option>
	<?php 
	}
	?>
	</select><br><br>  
         <!----------------Country-END-------------------------->	
         <!-------------State---------------------->
		<lable>State:-</lable>
	<select type="text" name="valueTooSearch"  onchange="form.submit()">
	<option value="">select</option>
	<?php
	//select distinct f_name from form
	$sql = "select distinct b.name,b.id from form a,states b where a.state=b.id ";
	$state1 = mysqli_query($conn,$sql);
	while($m= mysqli_fetch_array($state1)){	
	$id = $m['id'];
	$name = $m['name'];
	?>
	<option  value="<?=$id?>" <?if($id==$valueTooSearch){?>selected<?}?>><?=$name;?></option>
	<?php 
	}
	?>
	</select><br><br>  
         <!----------------State-END-------------------------->		
         <!-------------INTREST---------------------->
		<lable>Interest:-</lable>
	<select type="text" name="valueToSearch"  onchange="form.submit()">
	<option value="">select</option>
	<?php
	$sql = "select * from interest";
	$interest1 = mysqli_query($conn,$sql);
	while($i= mysqli_fetch_array($interest1)){	
	$name = $i['name'];
	$id =$i['id'];
	?>
	<option  value="<?=$id?>" <?if($id==$valueToSearch){?>selected<?}?>><?=$name;?></option>
	<?php 
	}
	?>
	</select><br><br>  
         <!----------------INTREST-END-------------------------->  
         <!-----------------GENDER-------------------------> 
        <lable>Gender:-</lable>
	<select type="text" name="valueToo" onchange="form.submit()">
	<option value="">select</option>
		<?php
	$sql = "select distinct gender from form";
	$form1 = mysqli_query($conn,$sql);
	while($i= mysqli_fetch_array($form1)){	
	$gender = $i['gender'];
	?>
	<option  value="<?=$gender?>" <?if($gender==$valueToo){?>selected<?}?>><?=$gender;?></option>
    <?php 
	}
	?>
	</select><br><br> 
   <!-----------------GENDER-END------------------------>	
   <!----------------- First Name -------------------------> 
        <lable>First Name:-</lable>
	<select type="text" name="valueToname"  onchange="form.submit()">
	<option value="">select</option>
   <?php 
	$sql = " select distinct f_name from form";
	$form2 = mysqli_query($conn,$sql);
	while($i= mysqli_fetch_array($form2)){
	$f_name = $i['f_name'];
	?>
   <option  value="<?=$f_name?>" <?if($f_name==$valueToname){?>selected<?}?>><?=$f_name;?></option>
   <?php 
	}
	?>
	</select><br><br> 
   <!----------------- First Name-END------------------------>	  
            <table>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
					<th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
					<th>Date Of Birth</th>
					<th>Upload</th>
					<th>Interest</th>
					<th>Countries</th>
					<th>State</th>
					<th>City</th>
					<th>Action</th>
                </tr> 
      <!---------- populate table from mysql database -- ------->        
                <?php 
				
	           $sql = "SELECT a.*,b.name ,c.name as state_name,d.name as city_name,e.name as in_nm 
				FROM form a,countries b,states c, cities d,interest e where
				a.countries=b.id and a.state=c.id and a.city=d.id and a.interest=e.id  $stmt $stmt1 $stm $stmtt ";
                
				
				$search_result = mysqli_query($conn,$sql); 
				$p = 1;
				while($row = mysqli_fetch_array($search_result))
				{
				$id = $row['id'];
				?>
					
					
                <tr>
                    <td><?php echo $p;?></td>
					<td><a href="display2.php?id=<?php echo $id?>"><?echo $row['f_name'] ?></a></td>
                    <td><?php echo $row['m_name'];?></td> 
                    <td><?php echo $row['l_name'];?></td> 					
                    <td><?php echo $row['gender'];?></td>
					<td><?php echo $row['dob'];?></td> 
                    <td><a href="<?php echo $row['upload_file'];?>"  target="_blank">
					<img src="<?php echo $row['upload_file'];?>" width="100px" height="50px" ></a></td>
					<?
					$n = $row['interest'];
					$im = explode(',',$n);
			
					$show = array();
					foreach($im as $value)
					{
					  $sql_in = "select * from interest where id in($value)";
					  $res = mysqli_query($conn,$sql_in);
					  $myrow = mysqli_fetch_array($res);
					  $show[] = $myrow['name'];
					}
					
					$imp = implode(',',$show);
					//echo $imp = rtrim(",",$imp);
					?>
					<td><?php echo $imp ;?></td>
					<td><?php echo $row['name'];?></td> 
                    <td><?php echo $row['state_name'];?></td>
					<td><?php echo $row['city_name'];?></td>
					 <td>
	        <a class="btn btn-warning" href="first.php?m_mode=edit&id=<?php echo $row['id']; ?>">Edit</a>&nbsp;   
			<a class="btn btn-danger" href="process.php?m_mode=delete&id=<?php echo $row['id']; ?>">Delete</a>
		            </td>
                </tr>
                <?php
                 $p++;
				}
				;?>
            </table>
        </form>
        </div>
    </body>
    </html>