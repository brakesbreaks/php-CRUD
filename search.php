<!DOCTYPE html>
<html>
	<head>
		<title>Search Items by Description</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<center>
		<h2>Search Here</h2>
		<form method="GET" action="search.php">
			<input type="text" name="description" placeholder="Enter description..." required /><br>
			<button type="submit" name="search">Search</button>			
		</form><br>
		<?php
			$items;
			
			//if the user clicks the search button
			if(isset($_GET["search"]))
			{
				//get the value of the inputted description and remove leading and
				//trailing spaces using the trim function
				$description = trim($_GET["description"]);
				
				//establish a connection to the database market
				$con = mysqli_connect("localhost", "root", "", "market");
				
				//check if connection is successful
				if($con)
				{
					//form the query
					$sql = "select * from item where description like '%".$description."%' order by description ";
					
					//assign the returned or retrieved records to $items variable in PHP
					$items = mysqli_query($con, $sql);
					
					//check if there are records retrieved
					if(mysqli_num_rows($items) > 0)
					{
						//form the HTML table
						echo "<table border='1'>";
						echo "	<tr>";
						echo "		<th>Item Code</th>";
						echo "		<th>Description</th>";
						echo "		<th>Price</th>";
						echo "		<th>Quantity</th>";
						echo "		<th>Status</th>";
						echo "	</tr>";
						
						//loop each record in the $items recordset and display it
						while($record = mysqli_fetch_assoc($items))
						{
							echo "<tr>";
							echo "	<td>".$record["itemcode"]."</td>";
							echo "	<td>".$record["description"]."</td>";
							echo "	<td>".$record["price"]."</td>";
							echo "	<td>".$record["quantity"]."</td>";
							echo "	<td>".$record["status"]."</td>";
							echo "</tr>";							
						}
						
						echo "</table><br><br>";
						
					}
					else 
					{
						
						echo "<p>Sorry, no records found...</p>";
					}
					
				}
				else 
				{
					echo "<p>Sorry, error connecting to database...</p>";
					
				}
				
				mysqli_close($con);
				
				
			}
		
		?>
		<form method="POST">
			<button type="submit" name="view">View All Item</button><br>
			<button type="submit" name="back">Back To Main Menu</button>
		</form>
		<?php
			if(isset($_POST['view'])){
				header('location: list_all.php');
			}
			if(isset($_POST['back'])){
				header('location: mainmenu.php');
			}
		?>
		</center>
	</body>
</html>