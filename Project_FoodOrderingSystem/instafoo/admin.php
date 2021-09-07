<?php session_start();
if (!isset($_SESSION['admin']) || (isset($_SESSION['admin']) && $_SESSION['admin']!=true)) {
	header('location: index.php');
}
?>
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
			<ul class="nav navbar-nav navbar-right">
				<li><p style="color: #fff;padding-top: 15px;"><?php echo ucfirst($_SESSION['adminname']); ?> &nbsp; </p></li>
				<li><a href="logout.php" class="btn btn-danger btn-sm" style="color: #fff;">Logout</a></li>
			</ul>
		</div>
	</nav>
	
	<div class="container-fluid">
		<div class="admincontent">
			<br>
			<div class="adminpanel">
				<h2 align="center">Recent Orders</h2>
				<hr>
				<?php
					$link = mysqli_connect('localhost','root','','instantordering');
					if(!$link) die("Connection failed: " . mysqli_connect_error());

					$sql_orders = "SELECT oid,phoneno,pname,table_no,country,totalprice,message,served_status,paid_status FROM orders WHERE served_status=0 OR paid_status=0 order by ordered_date desc";
					$result_orders = mysqli_query($link, $sql_orders);
					$count=1;
					while ($row_orders = mysqli_fetch_assoc($result_orders)) {
						$oid = $row_orders['oid'];
						$pname = ucfirst($row_orders['pname']);
						$phoneno = $row_orders['phoneno'];
						$table = $row_orders['table_no'];
						$cname = ucfirst($row_orders['country']);
						$total = $row_orders['totalprice'];
						$message = $row_orders['message'];
						$served_status = $row_orders['served_status'];
						$paid_status = $row_orders['paid_status'];
						$foodsname=array();

						$sql_foods = "Select distinct food_qty,foodid,fname from orderedfoods inner join fooditem on orderedfoods.foodid=fooditem.fid where orderedfoods.oid='$oid'";
						$result_foods = mysqli_query($link,$sql_foods);
						?>
						<div class="">
							<br>
							<h3 align="center">Order: <?php echo $count; ?></h3>
							<br>
							<table class="table" style="text-align: left;">
								<tr>
									<td><h4><b>Name:</h4></b></td>
									<td><h4><b><?php echo $pname; ?></b></h4></td>
								</tr>
								<tr>
									<td><b>Phone No.: </b></td>
									<td><?php echo $phoneno; ?></td>
								</tr>
								<tr>
									<td><b>Table: </b></td>
									<td><?php echo $table; ?></td>
								</tr>
								<tr>
									<td><b>County Selection: </b></td>
									<td><?php echo ucfirst($cname); ?></td>
								</tr>
								<tr>
									<td><b>Foods: </b></td>
									<td><?php
										while ($row_foods = mysqli_fetch_assoc($result_foods)) {
											$foodname = $row_foods['fname'];
											$food_qty = $row_foods['food_qty'];
											echo ucfirst($foodname)." ( ".$food_qty." ) , ";
										}
										?>
										</td>
								</tr>
								<tr>
									<td><b>Total Price: </b></td>
									<td>Rs. <?php echo $total; ?> /-</td>
								</tr>
								<tr>
									<td><b>Message: </b></td>
									<td><?php echo $message; ?></td>
								</tr>
							</table>
							<div class="row">
								<div class="col-md-6"><button class="btn btn-default btn-block <?php echo ($served_status==0) ? "servedbtn" : "btn-success"; ?>" oid="<?php echo $oid; ?>" style="color: #000;"><?php if($served_status==0) echo "Mark as "; ?>Served</button></div><div class="col-md-6"><button class="btn btn-default btn-block <?php echo ($paid_status==0) ? "paidbtn" : "btn-success"; ?>" oid="<?php echo $oid; ?>" style="color: #000;"><?php if($paid_status==0) echo "Mark as "; ?>Paid</button></div>
							</div>
						</div>
						<hr>
					<?php $count++;} ?>
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