<?
      
session_start();
include "conn.php";							
include "userchk.php";
include "functlib.php";						//To access functions
$p_f=$m_color="";
$cust_id=$_SESSION['Client'];
$m_type=$_SESSION['user_type'];
$is_updt=$_REQUEST['is_updt'];
$m_clnt=$_REQUEST['sel_client'];
$m_nature=$_POST["org_nature"];
$page_name="view_org.php";	
$user_id=$_SESSION['uid'];

//$start=$_GET['start'];

?>


<!DOCTYPE html>

<html lang="en">

	<? include "head.php";?>
	
<body>

  <section id="container">
	<? include "header.php";?>
	<? include "sidebar.php";?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row mb">
          <!-- page start-->
          <div class="content-panel">
 
 <!--//===========================//-->
<?php

//include "header_n.php"; //To show header & menus in the page
// include "header_new1.php";
require "./request/req_city.php";

if ($m_mode == 'edit') {$m_state_id = $_REQUEST['state_id'];
    $m_state_name = get_val("select * from state_master where state_id='$id'", "f_name");
    echo $m_city = $_REQUEST['sel_city'];
    $city = get_val("select * from city_master where city_id='$m_city'", "city_name");
}
if (!$m_mode) {
    $m_mode = "add";
}?>

<HTML>
<head></head>
<BODY>
  <div id="page-wrapper">
	<div class="row">
		<!-- page header -->
			<div class="col-lg-12">
				<!-- <h2 class="page-header">Add Organization</h2> -->
			</div>
		<!--end page header -->
	</div>
 <div class="row">
  <div class="col-lg-12">
   <div class="panel panel-default">
	 <div class="panel-heading"><font size=3><b>Add City</b></font>
		&nbsp;
     </div>
    <div class="panel-body">
     <div class="row">
	  <form name="add_city" method="POST">
		<table border="0"  width="95%" height=150>
			<tr>
				<td width=5%></td>
				<td width=20%>Select State</th>&nbsp;<font color=red size=2>*</font>
				<?if($m_mode=="edit"){?>
					<td>
						<input type="text" name="sel_state" required readonly value="<?=$m_state_name;?>" class="form-control">
					</td>
				<?}else{
						$sql="select * from state_master order by state_name";?>
						<td><? showselectsize("sel_state",$sql,"state_id","state_name",$m_state_id,"1","200");
				}?>
						</td>
			</tr>
			<tr>
				<td width=5%></td>
				<td width=15%>City Name</th>&nbsp;<font color=red size=2>*</font>
				<td><input type="text" name="txt_cityname" required value="<?=$city;?>" class="form-control"></td>
			</tr>
		</table><br><br>
		<table align="center" border=0 width="25%">
		  <tr>
			<td>
				<input type="submit" value="&nbsp;Save&nbsp;" onclick='return chk1()' class="btn btn-primary">
			</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" value="&nbsp;Cancel&nbsp;" onClick="location='view_city.php'" class="btn btn-primary">
			</td>
		  </tr>
		</table>
		<input type="hidden" name="mode" value="<?=$m_mode;?>">
		<input type="hidden" name="m_city" value="<?=$m_city;?>">
		</form>
	   </div>
     </div>
	</div>
    </div>
   </div>
  </div>
</BODY>
</HTML>
<br><br><br><br><br><br>
<script src="./js/add_city.js">
</script>
<? //footer_n(); ?>
 <!--//===========================//-->
 
          </div>
          <!-- page end-->
        </div>
        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
   <? 
   require "footer.php";
   ?>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script type="text/javascript">
    /* Formating function for row details */
    function fnFormatDetails(oTable, nTr) {
      var aData = oTable.fnGetData(nTr);
      var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
      sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
      sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
      sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
      sOut += '</table>';

      return sOut;
    }

    $(document).ready(function() {
      /*
       * Insert a 'details' column to the table
       */
      var nCloneTh = document.createElement('th');
      var nCloneTd = document.createElement('td');
      nCloneTd.innerHTML = '<img src="lib/advanced-datatable/images/details_open.png">';
      nCloneTd.className = "center";

      $('#hidden-table-info thead tr').each(function() {
    //    this.insertBefore(nCloneTh, this.childNodes[0]);
      });

      $('#hidden-table-info tbody tr').each(function() {
    //    this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
      });

      /*
       * Initialse DataTables, with no sorting on the 'details' column
       */
      var oTable = $('#hidden-table-info').dataTable({
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [0]
        }],
        "aaSorting": [
          [1, 'asc']
        ]
      });

      /* Add event listener for opening and closing details
       * Note that the indicator for showing which row is open is not controlled by DataTables,
       * rather it is done here
       */
      $('#hidden-table-info tbody td img').live('click', function() {
        var nTr = $(this).parents('tr')[0];
        if (oTable.fnIsOpen(nTr)) {
          /* This row is already open - close it */
       //   this.src = "lib/advanced-datatable/media/images/details_open.png";
          oTable.fnClose(nTr);
        } else {
          /* Open this row */
       //   this.src = "lib/advanced-datatable/images/details_close.png";
     //     oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
        }
      });
    });
  </script>

  
</body>

</html>
