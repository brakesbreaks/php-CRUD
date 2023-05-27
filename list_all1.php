<!DOCTYPE html>
<html>
	<head>
		<title>List All Items</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
	
		<?php
			
			//declare the variable that will hold the item records
			$items;
			
			//establish a connection to the database market
			$con = mysqli_connect("localhost", "root", "", "market");
			
			if($con)
			{
				//this code block will only execute if the user clicks a DELETE button
				//get the itemcode from the URL parameter of the item
				//that you want to delete
				//note: when you are getting a value from the URL parameter
				//make sure that you ARE ALWAYS USING the $_GET variable
				if(isset($_GET["itemcode"]))
				{
					//get the value of the URL parameter variable itemcode
					$itemcode = $_GET["itemcode"];
					
					//create the sql code for the delete
					$sql = "delete from item where itemcode = ".$itemcode." ";
					
					//execute the delete query
					mysqli_query($con, $sql);
					
					//display success message
					echo "<p>Record was deleted successfully...</p>";
					
				}
				
				
				
				
				
				//form the query string that will select all records from item table
				$sql = "select * from item order by description ";
				
				//execute the sql query using the mysqli_query function
				$items = mysqli_query($con, $sql);
				//items variable is now a recordset
				
				//check if there are records retrieved
				if(mysqli_num_rows($items) > 0)
				{
					//form the html table
					echo "<table border='1'>";
					echo "		<tr>";
					echo "			<th>Item Code</th>";
					echo "			<th>Description</th>";
					echo "			<th>Price</th>";
					echo "			<th>Quantity</th>";
					echo "			<th>Status</th>";
				
					echo "		</tr>";
					
					//loop and visit each record in the recordset assign it to $record variable
					//and display it
					while($record = mysqli_fetch_assoc($items))
					{
						echo "<tr>";
						echo "		<td>".$record["itemcode"]."</td>";
						echo "		<td>".$record["description"]."</td>";
						echo "		<td>".$record["price"]."</td>";
						echo "		<td>".$record["quantity"]."</td>";
						echo "		<td>".$record["status"]."</td>";
					
						echo "</tr>";
						
					}										
					echo "</table>";
				}
				else 
				{
					echo "<p>Sorry, no records found...</p>";
					
				}
				
			}
			else 
			{
				
				echo "<p>Error connecting to database...</p>";
			}
			
			mysqli_close($con);
			
			
		
		
		?>
			<form method="GET" action="search.php">
			Type description:
			<input type="text" name="description" required />
			<button type="submit" name="search">Search</button>			
		</form>
	</body>
</html>