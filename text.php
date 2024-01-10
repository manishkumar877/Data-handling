<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<?
include("header.php");
?>
<br>
<br>
<?php
 include 'config.php';
  $ids = $_REQUEST['id'];
 

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current date
$c_date = date('Y-m-d');

// Calculate the date 10 days from now
$tenDaysFromNow = date('Y-m-d', strtotime($e_date . ' + 10 days'));

// SQL query to fetch records expiring within the next 10 days
$sql = "SELECT a.*,b.f_name as sel_name ,c.name as sel_interest FROM certificate a, form b ,interest c WHERE a.sel_name = b.id and a.sel_interest = c.id and e_date BETWEEN '$c_date' AND '$tenDaysFromNow'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
		
        echo "Name: " . $row["sel_name"] . " - Expiry Date: " . $row["e_date"] . "-Interest:". $row["sel_interest"] .""."<br>" ;
    }
} else {
    echo "No products are expiring within the next 10 days.";
}

$conn->close();
?>