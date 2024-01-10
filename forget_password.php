<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Forget Password</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('bgg.jpg');
        }

        .form {
            margin: 50px auto;
            width: 300px;
            padding: 30px 25px;
            background: white;
        }

        h1.login-title {
            color: #666;
            margin: 0px auto 25px;
            font-size: 25px;
            font-weight: 300;
            text-align: center;
        }

        .login-input {
            font-size: 15px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 25px;
            height: 25px;
            width: calc(100% - 23px);
        }

        .login-input:focus {
            border-color: #6e8095;
            outline: none;
        }

        .login-button {
            color: #fff;
            background: #55a1ff;
            border: 0;
            outline: 0;
            width: 100%;
            height: 50px;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
        }

        .link {
            color: #666;
            font-size: 15px;
            text-align: center;
            margin-bottom: 0px;
        }

        .link a {
            color: #666;
        }

        h3 {
            font-weight: normal;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    require('config.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $create_datetime = date("Y-m-d H:i:s");
         
		 
		 
        $check_query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $check_query);
		
		 if(empty($username)){
			 echo '<script> alert("Please Enter username");
			 window.location.href = "forget_password.php";
			 </script>';
		 }
		 elseif(empty($password)){
			 echo '<script> alert("Please Enter password ");
			 window.location.href = "forget_password.php";</script>';
		 } else {
		
		 if (mysqli_num_rows($result) > 0) {

            $sql = "UPDATE `users` set  `password`= '" . md5($password) . "' ,`create_datetime`='$create_datetime'
                    WHERE `username`='$username'";
            $query = mysqli_query($conn, $sql);

            ?>
            <script>
                alert("You are Password Update successfully.");
                window.location.href = "login.php";
            </script>
        <?

        } else {

            ?>
            <script>
                alert("Username is Not Exist.");
                window.location.href = "forget_password.php";
            </script>
        <?
        }	
	}
    } else {
        ?>
        <form class="form" action="" method="post">
            <h1 class="login-title">Forget Password</h1>
            <input type="text" class="login-input" name="username" placeholder="Username" />
            <input type="password" class="login-input" name="password" placeholder=" New Password" >
            <input type="submit" name="submit" value="SAVE" class="login-button">
            <p class="link">Try to Login:- <a href="login.php">Login here</a></p>
        </form>
        <?php
    }
    ?>
</body>

</html>