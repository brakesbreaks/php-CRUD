<html>
	<head>
		<title>Add Item</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
	<center>
		<h2>Add Item</h2>
		<?php
			
			//if the user clicks the save button
			if(isset($_POST["save"]))
			{
				//get all the inputted values
				$itemcode = $_POST["itemcode"];
				$description = $_POST["description"];
				$price = $_POST["price"];
				$quantity = $_POST["quantity"];
				$status = $_POST["status"];
				
				//check if you have established a connection to the database named: market
				$con = mysqli_connect("localhost", "root", "", "market");
				
				//check if the connection is successful...
				if($con)
				{
					//echo "<p>Connection successful</p>";
					
					//construct the insert query
					$query = "insert into item (itemcode, description, price, quantity, status) 
							  values (".$itemcode.", '".$description."', ".$price.", ".$quantity.", '".$status."') ";
							  
					//call the query function in order to insert a record
					mysqli_query($con, $query);
					
					//display a success message
					echo "<p>Record was saved successfully...</p>";
					
				}
				else 
				{
					echo "<p>Error connecting to the database...</p>";
					
				}
				
				mysqli_close($con);
				
			}
		
		
		?>
		<form method="POST" action="create.php">
			<input type="text" name="itemcode" placeholder="Item Code..." required><br>
			<input type="text" name="description" placeholder="Description..." required /><br>
			<input type="text" name="price" placeholder="Price..." required /><br>
			<input type="text" name="quantity" placeholder="Quantity..." required /><br>
			<label>Status:</label>
			<br />
			<select name="status">
				<option value="A">Active</option>
				<option value="I">In-Active</option>
			</select>
			<br />
			<br />
			<button type="submit" name="save">Save</button>
		</form>
		<form method="POST">
			<button type="submit" name="view">View Item</button><br>
			<button type="submit" name="search">Search Item</button><br>
			<button type="submit" name="back">Back to Main Menu</button>
		</form>
		<?php
			if(isset($_POST['back'])){
				header('location:mainmenu.php');
			}	
			if(isset($_POST['view'])){
				header('location:list_all.php');
			}
			if(isset($_POST['search'])){
				header('location:search.php');
			}
		?>
		</center>
	</body>
</html>