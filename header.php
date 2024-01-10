<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Hello, world!</title>

  <style>
    table,
    th,
    td {
      border: 1px solid black;
      border-radius: 10px;
    }

    #f_nameErr {
      color: Tomato;
    }

    #l_nameErrr {
      color: Tomato;
    }

    #genderErr {
      color: Tomato;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
	 <script type="text/javascript" src="certificate_validation.js"> 
   </script>
   <script type="text/javascript" src="js/acts_form.js"> </script> 
   <script type="text/javascript" src="js/valid_state.js"> </script> 
<script type="text/javascript" src="js/valid_industry_name.js"> </script>   
    <script type="text/javascript" src="js/valid_category_name.js"> </script>
   <script type="text/javascript" src="js/interest_validate.js"> 
   </script>
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
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="certificate.php" id="navbarDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Certificate
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="certificate.php">Upload Certificate</a></li>
              <li><a class="dropdown-item" href="display2.php">Display 2</a></li>
              <li><a class="dropdown-item" href="text.php">Expire Certificate</a></li>
              <li><a class="dropdown-item" href="text2.php"> Date Expire Certificate</a></li>
            </ul>
          </li>
		            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Acts
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="add_acts_index.php">Acts Form</a></li>
              <li><a class="dropdown-item" href="acts_display.php">Display Acts</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="add_interest.php" id="navbarDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Interest
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="add_interest.php">Add Interest</a></li>
              <li><a class="dropdown-item" href="interest_display.php">Display Interest</a></li>

            </ul>
        </ul>
		
        <div class="form">
          <p>
            <?php echo $_SESSION['username']; ?>
          </p>
          <p><a href="logout.php">Logout</a></p>
        </div>
      </div>
    </div>
  </nav>