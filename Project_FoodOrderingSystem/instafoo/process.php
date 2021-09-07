<?php
session_start();
$link = mysqli_connect('localhost','root','','instantordering');
if(!$link) die("Connection failed: " . mysqli_connect_error());

if (isset($_POST["loginform"])) { ?>
	<div class="login">
		<br>
		<h3>Enter Your Info</h3>
		<hr>
		<form method="post" class="loginform">
			<br>
			<div class="form-group">
				<input type="text" class="form-control pname" placeholder="Name" required>
			</div>
			<br>
			<div class="form-group">
				<input type="text" class="form-control phoneno" placeholder="Phone No.">
			</div>
			<br><hr><br>
			<div class="form-group">
				<input type="submit" class="btn btn-info btn-block" value="OK">
			</div>
			<br>
		</form>
	</div>
<?php }

if (isset($_POST["adminlogin"])) {
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];
	$sql = "SELECT userid, name FROM adminlogin WHERE username='$uname' AND password='$pass'";
	$result = mysqli_query($link,$sql);
	$count = mysqli_num_rows($result);
	if($count > 0){
		$row = mysqli_fetch_array($result);
		$_SESSION["admin"] = true;
		$_SESSION["userid"] = $row["userid"];
		$_SESSION["username"] = $uname;
		$_SESSION["adminname"] = $row["name"];
		echo "success";
	} else echo "Invalid Username/Password.";
	?>
<?php }

if(isset($_POST["tables"])){ ?>
	<div class="tables">
		<br>
		<h3>Please Select Table</h3>
		<br>
		<table class="table">							
			<tr>
				<td><input type="button" value="T1" class="btn btn-info btn-block"></td>
				<td><input type="button" value="T2" class="btn btn-info btn-block"></td>
			</tr>
			<tr>
				<td><input type="button" value="T3" class="btn btn-info btn-block"></td>			
				<td><input type="button" value="T4" class="btn btn-info btn-block"></td>
			</tr>
			<tr>
				<td><input type="button" value="T5" class="btn btn-info btn-block"></td>
				<td><input type="button" value="T6" class="btn btn-info btn-block"></td>
			</tr>	
			<tr>
				<td><input type="button" value="T7" class="btn btn-info btn-block"></td>
				<td><input type="button" value="T8" class="btn btn-info btn-block"></td>	
			</tr>
			<tr>
				<td><input type="button" value="T9" class="btn btn-info btn-block"></td>
				<td><input type="button" value="T10" class="btn btn-info btn-block"></td>
			</tr>

			<br>
		</table>
	</div>
<?php }

if(isset($_POST["country"])){ ?>
	<div class="country">
		<h3>Select Country Specification</h3>
		<table class="table" style="margin: 0">
			<tr>
				<td>
					<button cid="1" cname="nepali" class="btn btn-success btn-block"><img src="images/nep.png" alt="" width="160" class="img"><h5>nepali</h6></button>
				</td>
				<td>
					<button cid="2" cname="chinese" class="btn btn-success btn-block"><img src="images/chi.png" alt="" width="160" class="img"><h5>chinese</h6></button>
				</td>
			</tr>
			<tr>
				<td>
					<button cid="3" cname="indian" class="btn btn-success btn-block"><img src="images/ind.png" alt="" width="160" class="img"><h5>indian</h6></button>
				</td>
				<td>
					<button cid="4" cname="korean" class="btn btn-success btn-block"><img src="images/kor.png" alt="" width="160" class="img"><h5>korean</h5></button>
				</td>
			</tr>
		</table>
	</div>
<?php }

if(isset($_POST["foodlist"])){ ?>
<div class="foodlist">
	<form method="post">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="pill" href="#favourite">Favourite</a></li>
			<li><a data-toggle="pill" href="#category">Category</a></li>
			<li><a data-toggle="pill" href="#todays">Today's Special</a></li>
		</ul>

		<div class="tab-content">
			<div id="favourite" class="tab-pane fade in active">
				<br>
				<p align="right"><i><u>Sorted By Popularity</u></i></p>

				<?php
				$sql = "Select * From fooditem where countrySpf_cid=".$_POST['cid']." order by order_frequency desc";
				$retval = mysqli_query($link,$sql);
				if(! $retval) { die('Couldnot fetch data');}
				$i=0;
				$id=array();
				$qty=array();
				$name=array();  
				while($row = mysqli_fetch_array($retval)){
					$id[$i] = $row['fid'];
					$name[$i] = $row['fname'];
					$price[$i]=$row['fprice'];
					$i++;
				}
				?>

				<table class="table foodtable">
					<thead>
						<tr>
							<td></td>
							<td>Select</td>
							<td>Name</td>
							<td>Price</td>
							<td>Quantity</td>
							<td></td>
						</tr>
					</thead>

					<tbody>
						<?php for($j=0;$j<$i;$j++){ ?>
						<tr>
							<td></td>
							<td><input type="checkbox" name="techno" class="techno" id="<?php echo $id[$j]; ?>" value=""></td>
							<td><?php echo ucfirst($name[$j]); ?></td>
						  	<td><?php echo "$price[$j]"; ?></td>
							<td><input type="number" name="qty" class="qty" min="1" max="10" value="1" style="color: #000;"></td>
							<td class="recommendedfood"></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>

			</div>

			<div id="category" class="tab-pane fade">
				<h3>Menu 1</h3>
			</div>

			<div id="todays" class="tab-pane fade">
				<h3>Menu 2</h3>
				<p>Some content in menu 2.</p>
			</div>

		</div>

		<div class="order" align="right">
			<input type="button" name="makeorder" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal" value="Make Order" >
		</div>
	</form>
</div>

<div id="myModal" class="modal fade myModal" role="dialog" style="color: #000;">
	<div class="modal-dialog">
	    <div class="modal-content">
	     	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Select item</h4>
	    	</div>
	    	<div class="modal-body">
		        <form action="" method="post">
		            <?php $sql = "Select * From fooditem where countrySpf_cid =5";
		          $retval = mysqli_query($link,$sql);
		          if(! $retval){ die('Couldnot fetch data');}
		          $i=0;
		          $id=array();
		          $name=array();  
		          while($row = mysqli_fetch_array($retval)){
		            $id[$i] = $row['fid'];
		            $name[$i] = $row['fname'];
		            $price[$i]=$row['fprice'];
		            $i++;
		          }
		          ?>
		        
			        <table class="table">
			        	<tr>
			        		<td>Select</td>
				            <td>Name</td>
				            <td>Price</td>
				            <td>Quantity</td>
							<td></td>
			        	</tr>
			          	<?php for($j=0;$j<$i;$j++){ ?>
		            	<tr> 
		            		<td>
			            		<input type="checkbox" name="selfood" class="selfood" id="<?php echo $id[$j];?>" value="">
			            	</td>
			            	<td>
			            		<?php echo ucfirst($name[$j]);?>
			            	</td>
			            	<td>
			                	<?php echo "$price[$j]"; ?>
			            	</td>
			            	<td>
			            		<input type="number" name="qtys" class="qtys" id="numsel" value="1" min="1" max="10">
			            	</td>
							<td class="recommendedfood"></td>
		            	</tr>
		          	<?php } ?>
		        	</table>
	        	</form>
	      	</div>
	      
	    	<div class="modal-footer">
		        <button type="submit" name="confirm" class="btn btn-success confirm" style="width: 100px;">OK</button>
	    	</div>

		</div>
	</div>
</div>
<?php }

if (isset($_POST['recommend'])) {
	$phone = $_POST['phone'];
	$r_foods=json_decode(html_entity_decode($_POST['r_foods']));
	$re_foods=array();
	$re_oids = array();

	foreach ($r_foods as $r_food) {
		$sql_re_oids = "Select distinct orderedfoods.oid from orderedfoods left join orders on orderedfoods.oid=orders.oid where foodid='$r_food' and phoneno='$phone' order by oid desc limit 1";
		$result_re_oids = mysqli_query($link,$sql_re_oids);
		$row_re_oid = mysqli_fetch_assoc($result_re_oids);
		array_push($re_oids,$row_re_oid['oid']);
	}
	$re_oids_str = implode(", ", $re_oids);
	$sql_recommend = "Select foodid from orderedfoods where oid in ('$re_oids_str')";
	$result_recommend = mysqli_query($link,$sql_recommend);
	while ($row_recommend = mysqli_fetch_assoc($result_recommend)) {
		array_push($re_foods, $row_recommend['foodid']);
	}
	echo implode(",",$re_foods);
}

if(isset($_POST["calculate"])){
	$foods=json_decode(html_entity_decode($_POST['foods']));
	$foodsqty=json_decode(html_entity_decode($_POST['foodsqty']));
	$i=0;$total=0; ?>
	<div class="pricelist">
		<h3>Your Food Prices</h3>
		<br>
		<table class="table" style="text-align: left;color: #fff;">
			<tr>
				<th>S.N.</th>
				<th>Food</th>
				<th>Rate</th>
				<th>Quantity</th>
				<th>Total</th>
			</tr>
			<?php foreach($foods as $food){
			$sql = "Select * from fooditem where fid='$food'";
			$result = mysqli_query($link, $sql);
			$row = mysqli_fetch_assoc($result); ?>
			<tr>
				<td><?php echo ($i+1); ?></td>
				<td><?php echo ucfirst($row['fname']); ?></td>
				<td><?php echo $row['fprice']; ?></td>
				<td><?php echo $foodsqty[$i]; ?></td>
				<td><?php $tot=$row['fprice']*$foodsqty[$i]; echo $tot; $total+=$tot; $i++; ?></td>
			</tr>
			<?php } ?>
		</table>
		<hr>
		<h3>Total Price: Rs. <span id="totalprice"><?php echo $total; ?></span></h3>
		<hr>
		<div class="row">
			<div class="col-md-6"><button class="btn btn-default btn-block editfoods">Edit Food Selection</button></div><div class="col-md-6"><button class="btn btn-default btn-block allconfirm" data-toggle="modal" data-target="#myModal1">Confirm Food Selection</button></div>
		</div>
	</div>
	<div id="myModal1" class="modal fade myModal1" role="dialog" style="color: #000;">
		<div class="modal-dialog">
		    <div class="modal-content">
		     	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h2 class="modal-title">Anything to say?</h2>
		    	</div>
		    	<div class="modal-body">
			        <form action="#" method="POST">
						<h4>Enter your message: </h4>
						<textarea class="form-control" id="message" rows="5"></textarea><hr>
						<a type="button" class="btn btn-info btn-block kitchen">Send My Order To Kitchen</a><br>
					</form>
		      	</div>
			</div>
		</div>
	</div>
<?php }

if(isset($_POST["final"])){
	$foods=json_decode(html_entity_decode($_POST['foods']));
	$foodsqty=json_decode(html_entity_decode($_POST['foodsqty']));
	$i=0;$total=0;
	$foodsname=array();
	if(sizeof($foods)>0) {
		$pname = $_POST['pname'];
		$phoneno = $_POST['phoneno'];
		$table = $_POST['table'];
		$cname = ucfirst($_POST['cname']);
		$total = $_POST['total'];
		$message = $_POST['message'];
		$ordered_date = date('Y-m-d H:i:s');
		$sql_orders = "INSERT INTO orders (phoneno, pname, table_no, country, totalprice, message, ordered_date) VALUES ('$phoneno','$pname','$table','$cname','$total','$message','$ordered_date')";
		mysqli_query($link, $sql_orders);
		$oid = mysqli_insert_id($link);
		$i=0;
		foreach($foods as $food) {
			$sql="SELECT fname from fooditem where fid='$food'";
			$result=mysqli_query($link, $sql);
			$row=mysqli_fetch_assoc($result);
			array_push($foodsname, ucfirst($row['fname']));
			$food_qty = $foodsqty[$i];
			$sql_foods = "INSERT INTO orderedfoods (oid,food_qty,foodid) VALUES ('$oid','$food_qty','$food')";
			mysqli_query($link, $sql_foods);
			$sql_frequency = "UPDATE fooditem SET order_frequency=order_frequency+1 WHERE fid='$food'";
			mysqli_query($link,$sql_frequency);
			$i++;
		}
	}
	?>
	<div class="summary">
		<p align="center">Thank You!!! Your order will be delivered soon...</p>
		<h3>Your order is:</h3>
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
				<td><?php echo implode(", ", $foodsname); ?></td>
			</tr>
			<tr>
				<td><b>Total Price: </b></td>
				<td><b>Rs. <?php echo $total; ?> /-</b></td>
			</tr>
			<tr>
				<td><b>Message: </b></td>
				<td><?php echo $message; ?></td>
			</tr>
		</table>
		<div class="row">
			<div class="col-md-6"></div><div class="col-md-6"><a href="index.php" class="btn btn-default btn-block exitbtn" style="color: #000;">Exit</a></div>
		</div>
	</div>
<?php } 

if (isset($_POST['served'])) {
	$oid = $_POST['oid'];
	$sql_served = "UPDATE orders SET served_status=1 WHERE oid='$oid'";
	mysqli_query($link,$sql_served);
}

if (isset($_POST['paid'])) {
	$oid = $_POST['oid'];
	$sql_paid = "UPDATE orders SET paid_status=1 WHERE oid='$oid'";
	mysqli_query($link,$sql_paid);
}

?>