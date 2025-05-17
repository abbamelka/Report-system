<?php
				session_start(); // Start the session
				$timeout_duration = 900;
				// Check if the last activity time exists
					if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
						// If the session has expired, destroy the session
						session_unset();  // Clear session variables
						session_destroy();  // Destroy the session
						header('Location: ../user/login.php');  // Redirect to login page
						exit;
					}

				// Update the last activity time
				$_SESSION['last_activity'] = time();
				// Check if the user is logged in
				if (isset($_SESSION['id'])) {
					// You can access session data like this
					$userId = $_SESSION['id'];
					$username = $_SESSION['username'];
					$userType = $_SESSION['usertype'];

					//echo "Welcome, $username!";  // Display username
				} else {
					// User is not logged in, redirect to login page
					header('Location: ../user/login.php');
					exit;
				}
				// Prevent page caching on this page
				header('Cache-Control: no-store, no-cache, must-revalidate');
				header('Cache-Control: post-check=0, pre-check=0', false);
				header('Pragma: no-cache');
				?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>SWIFT & TI weakly report</title>
	<link rel="icon" type="image/png" href="../Resource/images/icons/favicon.ico"/>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="../Resource/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="../Resource/css/ready.css">
	<link rel="stylesheet" href="../Resource/css/demo.css">

	<style>
        .pagination .active .page-link {
            background-color: blue; /* Change to your desired color */
            color: white; /* Change text color for contrast */
        }
    </style>
	
</head>
<body>

	<div class="wrapper">
		<div class="main-header">
			<div>
			
		
			</div>
			<div class="logo-header">
				<a href="index.html" class="logo">
					Ready Dashboard
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
						<div >
							<h6>SWIFT and TI weakly report</h> 
						</div>
					
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
					
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="../Resource/images/pp.png" alt="user-img" width="36" class="img-circle"><span ><?php echo "$username" ?></span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="../Resource/images/pp.png" alt="user"></div>
										<div class="u-text">
											<h4><?php echo "$username" ?></h4>
											<p class="text-muted">melkamud@awashbank.com</p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
										</div>
									</li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#"><i class="ti-user"></i> My Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#"><i class="ti-settings"></i> Account Setting</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="../user/logout.php"><i class="fa fa-power-off"></i> Logout</a>
								</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<div class="user">
						<div class="photo">
							<img src="../Resource/images/pp.png">
						</div>
						<div class="info">
							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
								<?php echo "$username" ?>
									<span class="user-level"><?php echo "$userType" ?></span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item active">
							<a href="index.php">
								
								<p>Dashboard</p>
								
							</a>
						</li>
						<li class="nav-item">
							<a href="Addrep.php">
								
								<p>Add Weakly Report</p>
								
							</a>
						</li>
						<li class="nav-item">
							<a href="exportReport.php">
								
								<p>Export report</p>
								
							</a>
						</li>
						<li class="nav-item">
							<a href="editPassword.php">
								
								<p>Edit Report</p>
								
							</a>
						</li>
						
						<li class="nav-item">
							<a href="changePassword.php">
								
								<p>Change Password</p>
								
							</a>
						</li>
						
						<li class="nav-item update-pro">
							<button  data-toggle="modal" data-target="#modalUpdate">
								
								<p>Reporting</p>
							</button>
						</li>
					</ul>
				</div>
			</div>
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Eport Report</h4>
					<!-- Search Form -->
						<div class="row mt-4">
							<h4>Search Reports</h4>       
                		</div>
						<form>
        <div class="form-row align-items-end">
            <!-- Area Dropdown -->
            <div class="form-group col-md-3">
                <label for="area" class="font-weight-bold">Area</label>
                <select id="area" class="form-control">
								<option value="">Select Area</option>
								<option value="SWIFT">SWIFT</option>
                                <option value="TI">TI</option>
								<option value="MMM">MMM</option>
								<option value="Corona">Corona</option>
								<option value="Filezilla">Filezilla</option>
								<option value="Femous">Femous</option>
                                <option value="Other">Other</option>
                </select>
            </div>

            <!-- Username Input -->
            <div class="form-group col-md-3">
                <label for="uname" class="font-weight-bold">Username</label>
                <input type="text" id="uname" class="form-control" placeholder="Enter Username">
            </div>

            <!-- Type Dropdown -->
            <div class="form-group col-md-3">
                <label for="type" class="font-weight-bold">Type</label>
                <select id="type" class="form-control">
                    <option value="">Select Type</option>
								<option value="troubleshoot">Troubleshoot</option>
								<option value="configuration">Configuration</option>
								<option value="Availability ">Availability</option>
								<option value="Monitoring">Monitoring</option>
								<option value="Deployment">Deployment</option>
								<option value="Capacity">Capacity and performance</option>
								<option value="COB Operation">COB Operation</option>
								<option value="Request Fulfilment">Request Fulfilment</option>
								<option value="Security Hardening">Security Hardening</option>
								<option value="other">Other</option>
                </select>
            </div>

            <!-- Date Input -->
            <div class="form-group col-md-3">
                <label for="date" class="font-weight-bold">Date</label>
                <input type="date" id="date" class="form-control">
            </div>
        </div>

        <!-- Button Group (Search and Clear buttons) -->
        <div class="form-row justify-content-start mt-3">
            <div class="form-group col-auto">
                <button id="serchBtn" type="button" class="btn btn-primary btn-lg">Search</button>
            </div>
            <div class="form-group col-auto ml-2">
                <button type="reset" class="btn btn-secondary btn-lg">Clear</button>
            </div>
        </div>

        <input type="text" id="Reportsubject" style="display:none">

        <!-- Export Options -->
        <div class="btn-group mt-3" role="group" aria-label="Export Options">
            <button class="btn btn-success">Export to Excel</button>
            <button id="exportBtn" type="button" class="btn btn-primary">Export to PDF</button>
        </div>
    </form>
  </div>
                 
						<!-- Report Table -->
						<div class="row mt-4">
							<div class="col-md-12">
                           <table class="table table-bordered table-striped table-sm" id="resultsTable">
									<thead>
										<tr>
										<th>Type</th>
										<th>Area</th>
										<th>Subject</th>
										<th>Detail</th>
										<th>Username</th>
										<th>Date</th>
										</tr>
									</thead>
									<tbody>
										<!-- Data will be populated here by AJAX -->
									</tbody>
								</table>
							</div>
							<!-- Pagination Controls -->
							<nav aria-label="Page navigation">
								<ul class="pagination" id="pagination">
									<!-- Pagination buttons will be dynamically added here -->
								</ul>
							</nav>
						</div>
					</div>
					
					</div>
				</div>
				<footer class="footer">
					<div class="container-fluid">
						<nav class="pull-left">
							<ul class="nav">
								<li class="nav-item">
									<a class="nav-link" href="http://www.awashbank.com">
										Awash Bank
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">
										Help
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">
										Swift and TI report
									</a>
								</li>
							</ul>
						</nav>
						<div class="copyright ml-auto">
							2024, made by <a href="#">Application Managment Division</a>
						</div>				
					</div>
				</footer>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"><i class="la la-frown-o"></i> What to report</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">									
					<p>Weekly Activity Report</p>
					<p>
						<b>cvcv</b></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="../Resource/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="../Resource/vendor/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="../Resource/js/core/popper.min.js"></script>
<script src="../Resource/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="..//Resource/vendor"></script>
<script src="../Resource/vendor/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="script.js"></script>
</html>