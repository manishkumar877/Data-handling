
<?
include("header.php");
?>
 <?php
 include 'config.php';                                                                   	
 ?> 
 <br>
 <br>
 
         <div class="container">
        <form action="" method="POST">
		
   <!----------------- First Name-END------------------------>	  
            <table>
                <tr>
                    <th>Id</th>
					 <th>State Name</th>
					<th>Action</th>
                </tr> 
      <!---------- populate table from mysql database -- ------->        
                <?php 
				
	           $sql = "SELECT * FROM states";       
				$search_result = mysqli_query($conn,$sql); 
				$p = 1;
				while($row = mysqli_fetch_array($search_result))
				{
				$id = $row['id'];
				?>	
                <tr>
                    <td><?php echo $p;?></td>
					<td><?echo $row['name'] ?></a></td>
					 <td>
	        <a class="btn btn-warning" href="add_state.php?m_mode=edit&id=<?php echo $row['id']; ?>">Edit</a>&nbsp;   
			<a class="btn btn-danger" href="state_process.php?m_mode=delete&id=<?php echo $row['id']; ?>">Delete</a>
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