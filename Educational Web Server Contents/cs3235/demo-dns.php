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
      <li class="nav-item active">
        <a class="nav-link" href="spoofing.html">
          <i class="fas fa-fw fa-user-secret"></i>
            <span>DNS Spoofing</span></a></li>
      <li class="nav-item">
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
            <a href="spoofing.html">DNS Spoofing</a>
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
        
        <h1>Demo - DNS Hijacking</h1>
        <hr>
        <p>
        <h2> What is happening? </h2>
        <img style="width:60%;" src="/demo-dns.png"> </img>
        </p>
        
        <p>
        <h2> Instructions </h2>
        Enter any URL that you want to hijack, and click "hijack". <br>
        Visit the hijacked URL on your web browser to learn more about how it works! <br>
        Note: You may have to flush your DNS cache so that your computer will use the latest DNS. <br>
        <br>
        <b> Flushing DNS Cache: </b> <br>
        <b> Windows: </b> ipconfig /flushdns <br>
        <b> MacOS: </b> sudo killall -HUP mDNSResponder && sudo killall mDNSResponderHelper && sudo dscacheutil -flushcache <br>
        <b> Android: </b> Restart phone / Reset network settings / chrome://net-internals/#dns <br>
        <b> iOS: </b> Restart phone / Set DNS to manual and back to auto again "Settings > Wifi > Info > Configure DNS" <br>
        </p>
        
        <form name="spoof" action="/demo-dns.php" method="post">
			URL to Spoof: <input type="text" name="url" value="www.nus.edu.sg">
			<input type="text" name="name" value="hijack" readonly hidden>
			<input type="text" name="token" value="<?php echo $token; ?>" readonly hidden>
		  	<input type="submit" value="Hijack">
		</form>
		<br>
		<form name="unspoof" action="/demo-dns.php" method="post">
			Undo Spoofing: <input type="text" name="undo" value="undo" readonly hidden>
			<input type="text" name="name" value="unhijack" readonly hidden>
			<input type="text" name="token" value="<?php echo $token; ?>" readonly hidden>
			<input type="submit" value="Unhijack">
		</form>
		
		<div>
			<?php
				// Prints output
				//var_dump($_POST);
				if ($execute == true) {
					if (isset($_POST["name"])) {
						if ($_POST["name"] == "hijack") {
							$url = $_POST["url"];
							exec("sudo /var/www/html/cs3235/scripts/bind.sh $url 192.168.1.2");
							echo "Successfully hijacked $url !";
						}
						if ($_POST["name"] == "unhijack") {
							exec("sudo /var/www/html/cs3235/scripts/delete.sh");
							echo "Successfully cleared all hijacked DNS entries!";
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