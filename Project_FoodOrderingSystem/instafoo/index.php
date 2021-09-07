<!DOCTYPE html>
<html>
<head>
	<title>Instant Ordering</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h3>InstaOrder</h3>
	</div>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">InstaOrder</a>
			</div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="index.php">Home</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Contact</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right adminnav">
				<li>
					<form name="adminform" id="adminform" class="adminform" method="POST" action="admin.php">
						<input type="text" placeholder="Username" class="uname" style="margin-top: 10px;">
						<input type="text" placeholder="Password" class="pass" style="margin-top: 10px;">
					</form>
				</li>
				<li> &nbsp; <input type="submit" form="adminform" name="adminlogin" value="Admin Login" class="btn btn-info btn-sm" style="margin-top: 8px;"> &nbsp; </li>
			</ul>
		</div>
	</nav>
	
	<div class="container-fluid">
		<div class="content">
			<br>
			<div class="instaorder">
			</div>
			<br>
		</div>
		<br>
	</div>
</body>
<script type="text/javascript" src="bootstrap/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</html>