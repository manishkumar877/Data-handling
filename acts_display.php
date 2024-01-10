 <?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
 <?php
 include 'config.php';
  $valueToSearch = $_REQUEST['valueToSearch'];
  $valueTooSearch = $_REQUEST['valueTooSearch'];
  $valueToo = $_REQUEST['valueToo'];

	if(!empty($valueToSearch))
	{
   $stmt = " and act_type = '$valueToSearch'";
	}

	if(!empty($valueTooSearch))
	{
		$stmtt = " and state='$valueTooSearch'";
	}
  	if(!empty($valueToo))
	{
		$stm = " and b.id='$valueToo'";
	}
	
  include("header.php");
?>
         <div class="container">
        <form action="" method="POST">

         <!-------------State---------------------->
		<lable>State:-</lable>
	<select type="text" name="valueTooSearch"  onchange="form.submit()">
	<option value="">select</option>
	<?php
	//select distinct f_name from form
	$sql = "select distinct b.name,b.id from acts a,states b where a.state=b.id ";
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
  
         <!-----------------Category-------------------------> 
        <lable>Category:-</lable>
	<select type="text" name="valueToo"  onchange="form.submit()">
	<option value="">select</option>
		<?php
		if(!empty($valueTooSearch)){
			$stn = " AND a.state='$valueTooSearch'";
		}

	 $sql = "select distinct b.category_name,  a.*,b.category_name,b.id from acts a,acts_category b where a.category_name=b.id $stn";

	$form1 = mysqli_query($conn,$sql);
	while($i= mysqli_fetch_array($form1)){
     $id = $i['id'];		
	$category_name = $i['category_name'];
	?>
	<option  value="<?=$id?>" <?if($id==$valueToo){?>selected<?}?>><?=$category_name;?></option>
    <?php 
	}
	?>
	</select><br><br> 
   <!-----------------Category-END------------------------>	
            <!-----------------act_type-------------------------> 
        <lable>Type Acts:-</lable>
	<select type="text" name="valueToSearch" value="<? echo $act_type;?>" onchange="form.submit()">
	<option value="">select</option>
			<?php
		if(!empty($valueTooSearch)){
			$st = " AND a.category_name='$valueToo'";
		}
		
		
	echo $sql = "select distinct act_type from acts $st ";
	$form = mysqli_query($conn,$sql);
	while($i= mysqli_fetch_array($form)){
     $act_type = $i['act_type'];		
	
	?>
	<option  value="<?=$act_type?>" <?if($act_type==$valueToSearch){?>selected<?}?>><?=$act_type;?></option>
    <?php 
	}
	?>
	</select><br><br> 
   <!-----------------act_type-END------------------------>
 	 
            <table>
                <tr>
                    <th>Id</th>
                    <th>Category Name</th>
					<th>Short Title</th>
                    <th>Description</th>
                    <th>Applicabillity</th>
					<th>W.E.F</th>
					<th>Upload</th>
					<th>Industry Name</th>
					<th>State</th>
					<th>Type Acts</th>
					<th>Action</th>
                </tr> 
      <!---------- populate table from mysql database -- ------->        
                <?php 
				
	$sql = "SELECT a.*,b.category_name, d.name as state FROM  acts a, acts_category b, states d where
       a.category_name=b.id  and a.state=d.id  $stmtt $stmt $stm";
                
				
				$search_result = mysqli_query($conn,$sql); 
				$p = 1;
				while($row = mysqli_fetch_array($search_result))
				{
				$id = $row['id'];
				?>	
                <tr>
                    <td><?php echo $p;?></td>
					<td><?php echo $row['category_name'] ;?></td>
                    <td><?php echo $row['short_title'];?></td> 
                    <td><?php echo $row['description'];?></td> 					
                    <td><?php echo $row['applicabillity'];?></td>
					<td><?php echo $row['wef'];?></td> 
                    <td><a href="<?php echo $row['file_name'];?>"  target="_blank">
					<img src="<?php echo $row['file_name'];?>" width="100px" height="50px" ></a></td>
					<td><?
					$im = explode(",",$row['industry_name']);
					
				    $imm = implode(",",$im);
					 
					 $sql_in = "select industry_name from acts_industry where id in($imm)";
					  $result = mysqli_query($conn,$sql_in);
					 
					  $myrow = mysqli_fetch_all($result,MYSQLI_ASSOC);
					  $myrow = array_column($myrow,'industry_name');
					
			      	echo  implode(",",$myrow);
				
					?>
					</td> 
                    <td><?php echo $row['state'];?></td>
					<td><?php echo $row['act_type'];?></td>
					 <td>
	        <a class="btn btn-warning" href="add_acts_index.php?m_mode=edit&id=<?php echo $row['id']; ?>">Edit</a>&nbsp;   
			<a class="btn btn-danger" href="acts_process.php?m_mode=delete&id=<?php echo $row['id']; ?>">Delete</a>
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