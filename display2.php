<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?php
 include 'config.php';
  $ids = $_REQUEST['id'];
 
 ?>
<?
include("header.php");
?>
<div class="container">
  <form action="" method="POST">

    <!----------------- First Name-END------------------------>
    <table>
      <tr>
        <th>Id</th>
        <th>First Name</th>
        <th>Interest</th>
        <th>Create Date </th>
        <th>Certificate</th>
        <th>Certificate Image</th>
        <th>Expire Date </th>
        <th>Current Date/Time </th>
      </tr>
      <!---------- populate table from mysql database -- ------->
      <?php 
		if(!empty($ids))
				{
					$stmt1 = " and sel_name='$ids'";
				}
	$sql = "SELECT a.*,b.f_name as sel_name ,c.name  FROM certificate a,form b,interest c where 
	a.sel_name = b.id and a.sel_interest = c.id   $stmt1";		
				$search_result = mysqli_query($conn,$sql); 
				$p = 1;
				while($row = mysqli_fetch_array($search_result))
				{
					
				 $id = $row['id'];
				
					?>


      <tr>
        <td>
          <?php echo $p;?>
        </td>
        <td>
          <?php echo $row['sel_name'];?>
        </td>
        <td>
          <?php echo $row['name']; ;?>
        </td>
        <td>
          <?php echo $row['c_date'];?>
        </td>
        <td>
          <?php echo $row['certificate'];?>
        </td>
        <td><a href="<?php echo $row['c_upload'];?>" target="_blank">
            <img src="<?php echo $row['c_upload'];?>" width="100px" height="50px"></a></td>
        <td>
          <?php echo $row['e_date'];?>
        </td>
        <td>
          <?php echo $row['current_date'];?>
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