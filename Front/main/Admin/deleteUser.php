<?php
				session_start(); // Start the session
				$timeout_duration = 900;
				// Check if the last activity time exists
					if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
						// If the session has expired, destroy the session
						session_unset();  // Clear session variables
						session_destroy();  // Destroy the session
						header('Location:../../user/login.php');  // Redirect to login page
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
					header('Location: ../../user/login.php');
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
	<link rel="icon" type="image/png" href="../../Resource/images/icons/favicon.ico"/>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="../../Resource/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="../../Resource/css/ready.css">
	<link rel="stylesheet" href="../../Resource/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
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
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="../../Resource/images/pp.png" alt="user-img" width="36" class="img-circle"><span ><?php echo "$username" ?></span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="../../Resource/images/pp.png" alt="user"></div>
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
									<a class="dropdown-item" href="../../user/logout.php"><i class="fa fa-power-off"></i> Logout</a>
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
							<img src="../../Resource/images/pp.png">
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
								
								<p>Add User</p>
								
							</a>
						</li>
						<li class="nav-item">
							<a href="deleteUser.php">
								
								<p>Delete User</p>
								
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
						<h4 class="page-title">Create user</h4>
						<div class="row container mt-5 d-flex justify-content-center form-group text-center">
							<!-- Search form -->
                            <input type="text" id="searchQuery" class="form-control w-50 mx-auto" placeholder="Search by username" onkeyup="searchUsers()">
                            <button class="btn btn-primary mt-3"  onclick="searchUsers()">Search</button>
					    </div>
                        <div>
                            <?php
                            // Display success or error message if present in the URL
                            if (isset($_GET['message'])) {
                                echo "<div style='color: green; font-weight: bold;'>" . htmlspecialchars($_GET['message']) . "</div>";
                            }
                            ?>
                        </div>
                        <div>
                        <h4 class="text-center my-4">User List</h4>
                         <table class="table table-striped table-bordered text-center" border="1">
                            <thead class="thead-dark">
                              <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>User Type</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="userTableBody">
                                <!-- User list will be loaded here -->
                            </tbody>
                        </table>
                        </div>
				</div>
				<div>

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
							2024, made by <a href="#">Application Managment Devision</a>
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
<script src="../../Resource/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="../../Resource/vendor/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="../../Resource/js/core/popper.min.js"></script>
<script src="../../Resource/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../..//Resource/vendor"></script>
<script src="../../Resource/vendor/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="../../Resource/vendor/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../../Resource/vendor/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="../../Resource/vendor/js/plugin/chart-circle/circles.min.js"></script>
<script src="../../Resource/vendor/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../../Resource/js/ready.js"></script>
<script src="../../Resource/js/demo.js"></script>
<script src="../../Resource/vendor/tinymce/js/tinymce/tinymce.min.js"></script>


<script>
        // AJAX search function to dynamically fetch and display users
        function searchUsers() {
            var searchQuery = $('#searchQuery').val(); // Get the search query from input field
            
            $.ajax({
                url: '../../../Back/searchuserDelete.php',
                type: 'GET',
                data: { search: searchQuery },
                success: function(response) {
                    $('#userTableBody').html(response); // Update the table body with the response
                }
            });
        }

        // Confirm delete user
        function confirmDelete(id) {
            var confirmation = confirm("Are you sure you want to delete this user?");
            if (confirmation) {
                window.location.href = "../../../Back/deleteUser.php?id=" + id; // Redirect to delete user page
            }
        }
    </script>

</html>