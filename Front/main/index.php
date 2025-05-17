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
						<h4 class="page-title">Dashboard</h4>
						<div class="row " >
							<div class="col-6 mx-auto">
           						 <h5>Area</h5>
       					 	</div>
						</div>
						<div class="container">
                          <canvas id="areaChart" width="400" height="200"></canvas>
                        </div>
						<div class="row">
								<div class="col-6 mx-auto">
           						 	<h5>Type</h5>
       					 		</div>
									<div class="container">
                          <canvas id="reportTypeChart" width="400" height="200"></canvas>
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
<script src="../Resource/vendor/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="../Resource/vendor/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../Resource/vendor/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="../Resource/vendor/js/plugin/chart-circle/circles.min.js"></script>
<script src="../Resource/vendor/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../Resource/js/ready.js"></script>
<script src="../Resource/js/demo.js"></script>

<!-- Include the Chart.js library -->
<script src="../Resource/js/chart.min.js"></script>


<script>
  
// Function to fetch data from the backend
function fetchChartData(reportType = 'all') {
    return new Promise((resolve, reject) => {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../../Back/chartdash.php?reportType=' + reportType, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                resolve(JSON.parse(xhr.responseText)); // Parse and resolve the JSON response
            } else {
                reject('Error fetching data');
            }
        };
        xhr.onerror = function() {
            reject('Request failed');
        };
        xhr.send();
    });
}

// Initialize the report type chart (Bar Chart)
var ctxReportType = document.getElementById('reportTypeChart').getContext('2d');
var reportTypeChart = new Chart(ctxReportType, {
    type: 'bar',
    data: {
        labels: [], // Placeholder for report types
        datasets: [{
            label: 'Number of Reports by Type',
            data: [], // Placeholder for report counts by type
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Initialize the area chart (Bar Chart)
var ctxArea = document.getElementById('areaChart').getContext('2d');
var areaChart = new Chart(ctxArea, {
    type: 'bar',
    data: {
        labels: [], // Placeholder for areas
        datasets: [{
            label: 'Number of Reports by Area',
            data: [], // Placeholder for area report counts
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Function to update the charts with fetched data
function updateCharts(reportType) {
    fetchChartData(reportType).then(data => {
        // Update reportTypeChart with data
        reportTypeChart.data.labels = data.reportTypes;
        reportTypeChart.data.datasets[0].data = data.reportCounts;
        reportTypeChart.update();

        // Update areaChart with data
        areaChart.data.labels = data.areas;
        areaChart.data.datasets[0].data = Object.values(data.areaCounts); // Use the summed area counts
        areaChart.update();
    }).catch(error => {
        console.error(error);
    });
}

// Initial chart update with 'all' report type
updateCharts('all');

// Event listener for filtering by report type
document.getElementById('search-type').addEventListener('change', function() {
    var selectedType = this.value || 'all';  // If nothing selected, default to 'all'
    updateCharts(selectedType); // Update charts based on selected report type
});


</script>

	<script>

		
	</script>
</html>