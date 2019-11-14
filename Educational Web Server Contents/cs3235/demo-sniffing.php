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
      <li class="nav-item active">
        <a class="nav-link" href="sniffing.html">
          <i class="fas fa-fw fa-rss"></i>
            <span>Password Sniffing</span></a></li>
      <li class="nav-item">
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
            <a href="sniffing.html">Password Sniffing</a>
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
        
        <h1>Demo - Password Sniffing</h1>
        <hr>
        <p>
        Enter any URL (<b>domain only</b> and must be in <a href="https://whynohttps.com"> HTTP </a>) that you want to start sniffing, and click "Sniff". <br>
        Visit the URL on your web browser and login. <br>
        Press "Stop Sniffing" and your login credentials will be captured and display below. <br>
        <br>
        <b> Some sample websites to sniff: </b> <br>
        <a href="http://testing-ground.scraping.pro/login"> testing-ground.scraping.pro </a> <br>
        <a href="http://www.babytree.com"> www.babytree.com </a> <br>
        <a href="http://passport.baike.com"> passport.baike.com </a> <br>
        <a href="http://www.canadian-pizza.com"> www.canadian-pizza.com </a> <br>
        <a href="http://www.bbqfactory.com.sg"> www.bbqfactory.com.sg </a> <br>
        </p>
        
        <form name="sniff" action="/demo-sniffing.php" method="post">
			URL to Sniff: <input type="text" name="url" value="testing-ground.scraping.pro">
			<input type="text" name="name" value="start-sniffing" readonly hidden>
			<input type="text" name="token" value="<?php echo $token; ?>" readonly hidden>
		  	<input type="submit" value="Start Sniffing">
		</form>
		<br>
		<form name="unspoof" action="/demo-sniffing.php" method="post">
			Stop Sniffing: <input type="text" name="stop" value="stop" readonly hidden>
			<input type="text" name="name" value="stop-sniffing" readonly hidden>
			<input type="text" name="token" value="<?php echo $token; ?>" readonly hidden>
			<input type="submit" value="Stop Sniffing">
		</form>
		
		<br>
		
		<div style="overflow:auto;">
			<?php
				// Prints output
				//var_dump($_POST);
				if ($execute == true) {
					if (isset($_POST["name"])) {
						if ($_POST["name"] == "start-sniffing") {
							$url = $_POST["url"];
							exec("sudo /var/www/html/cs3235/scripts/start-sniffing.sh $url");
							echo "Successfully started sniffing on $url !";
						}
						if ($_POST["name"] == "stop-sniffing") {
							exec("sudo /var/www/html/cs3235/scripts/stop-sniffing.sh 2>&1", $output, $return_var);
							echo "Sniffing Stopped! Credentials are:"
							?> <br><br><?php
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