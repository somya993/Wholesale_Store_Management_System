<?php
	session_start(); 
	if(!isset($_SESSION['loginUser'])){
		header("Location:logout.php");
	}

?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
	<link rel='stylesheet' href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<title>My Transactions</title>


</head> 
<body>
	<div class="topStyle">
		<h2 style="color:white;">Wholesale DataBase Management</h2>
		<a class='userNameDisplay'><?php echo $_SESSION['loginUser']; ?></a>
	</div>
	<div class='sidebar'>
		<button onclick="location.href='customerHome.php'">Home</button>
		<button onclick="location.href='viewProductsCustomer.php'">View Products</button>
		<button onclick="location.href='order.php'">Order</button>
		<button onclick="location.href='cart.php'">Cart</button>
		<button onclick="location.href='customerViewTransactions.php'">My Transactions</button>
		<button onclick="location.href='logout.php'">Logout</button>
	</div>
	<div class='container'>

	<fieldset><legend><b>My Transactions</b></legend>
		<table class='tableLarge'><tr><th>Transaction ID</th><th>Amount</th><th>Payment Mode</th><th>Phone</th><th>Address</th><th>Date</th></tr>
		<?php 
			$conn=mysqli_connect("localhost:3307","root","","wholesale");
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$curUser=$_SESSION['loginUser'];
			$sql="select * from transactions where customer_id='$curUser'";
			
			$result=mysqli_query($conn,$sql);
			if (!$result) {
				die("Query failed: " . mysqli_error($conn));
			}
			
			while($row=mysqli_fetch_assoc($result)){
				echo "<tr><td>".$row['transaction_id']."</td><td>".$row['transaction_amount']."</td><td>".$row['payment']."</td><td>".$row['phone']."</td><td style='font-size: 15px;'>".$row['address']."</td><td>".$row['date']."</td></tr>";
			}
			$res = mysqli_query($conn, "SELECT * FROM transactions WHERE customer_id='$curUser'");
			$row = mysqli_num_rows($res);

			if ($row > 0) {
				// Rows were found, you can fetch and display them.
				while ($data = mysqli_fetch_assoc($res)) {
					// Process each row of data
				}
			} else {
				// No rows were found
				echo "No transactions found for the customer.";
			}

			echo "</table><br>";
		?>
	</fieldset>
	



</div>
</body>
</html>