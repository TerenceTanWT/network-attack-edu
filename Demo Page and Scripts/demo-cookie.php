<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Educational Tool</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <!-- Input size increase -->
  <style>
      input{width: 500px}
  </style>
</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">Educational Tool: Insecure Networks</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="spoofing.html">
          <i class="fas fa-fw fa-user-secret"></i>
            <span>DNS Spoofing</span></a></li>
      <li class="nav-item">
        <a class="nav-link" href="sniffing.html">
          <i class="fas fa-fw fa-rss"></i>
            <span>Password Sniffing</span></a></li>
      <li class="nav-item active">
        <a class="nav-link" href="cookie.html">
          <i class="fas fa-fw fa fa-edit"></i>
            <span>Session Stealing</span></a></li>
      <li class="nav-item">
        <a class="nav-link" href="detection.html">
          <i class="fas fa-fw fa fa-certificate"></i>
            <span>Certificate Detection</span></a></li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">Home</a>
          </li>
          <li class="breadcrumb-item">
            <a href="cookie.html">Session Cookie Stealing</a>
          </li>
          <li class="breadcrumb-item active">Demonstration</li>
        </ol>



        <!-- Start of Page Content -->
        <?php 
        	session_start();
        	
        	// Checks if user submitted the form
        	$execute = false;
        	if (isset($_POST['name'])) {
        		if (isset($_SESSION['token'])) {
        			if ($_POST['token'] == $_SESSION['token']) {
        				$execute = true;
        			}
        		}
        	}
        	
        	// Generate new token
        	$_SESSION['token'] = md5(uniqid(rand(), true));
        	$token = $_SESSION['token'];
        ?>
        
        <h1>Demo - Session/Cookie Hijacking</h1>
        <hr>
        <h2> What is happening? </h2>
        <img style="width:60%;" src="/demo-cookie.png"> </img>
        </p>
        
        <p>
        <h2> Instructions </h2>
        This cookie hijacking is designed to work with <a href="www.focebook.org">facebook</a> only. <br>
        Visit <a href="www.focebook.org">facebook</a> by clicking on the URL below and login to your Facebook account! <br>
        This demo will be able to capture your Facebook session cookies after you click "Get Cookie". <br>
        Keep a lookout for the following 3 cookies: <b> c_user </b>, <b> sb </b>, and <b> xs </b>. <br>
        On a new browser, use Google Chrome's "EditThisCookie" extension to add the captured facebook cookies and visit facebook. <br>
        Viola, you have logged in and bypassed 2FA! <br>
        <h2> <a href="https://www.focebook.org/login" target="_blank"> Visit Facebook Here </a> </h2>
        </p>
        <br>
        
		<form name="cookie" action="/demo-cookie.php" method="post">
			Click to get cookie: <input type="text" name="getcookie" value="getcookie" readonly hidden>
			<input type="text" name="name" value="getcookie" readonly hidden>
			<input type="text" name="token" value="<?php echo $token; ?>" readonly hidden>
			<input type="submit" value="Get Cookie">
		</form>
		
		<div style="overflow:auto;">
			<?php
				// Prints output
				//var_dump($_POST);
				if ($execute == true) {
					if (isset($_POST["name"])) {
						if ($_POST["name"] == "getcookie") {
							exec("sudo /var/www/html/cs3235/scripts/evilginxcookie.sh 2>&1", $output, $return_var);
							print_r($output);
						}
					}
				}
			?>
		</div>
        
      </div>
      <!-- End of Page Content -->
       <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

</body>

</html>