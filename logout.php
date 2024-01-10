<?php
    session_start();
    // Destroy session
    if(session_destroy()) {
		
        // Redirecting To Home Page
				 ?>
	 <script>
	 alert("logout successfully");
	 window.location.href="login.php";
	 </script>
	 <?
	
    }
?>
