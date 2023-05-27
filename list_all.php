<!DOCTYPE html>
<html>
	<head>
		<title>List All Items</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<center><h2>List of Items</h2>
		<form method="POST" action="list_all.php">		
			<?php
				
				//declare the variable that will hold the item records
				$items;
				
				//establish a connection to the database market
				$con = mysqli_connect('localhost', 'root', '', 'market');
				
				if($con)
				{
					//this code block here will only execute if the user clicks the DELETE button
					if(isset($_POST["delete"]))
					{
						//error trapping: check first if there is at least 1 item checkbox
						//that has been checked / selected at least 1 item to be deleted
						if(isset($_POST["itemcodes"]))
						{
							//get the itemcodes
							$itemcodes = $_POST["itemcodes"];
							
							//loop through each itemcode that has been selected or checked							
							/*
							for($i=0; $i<count($itemcodes); $i++)
							{
								//form the sql query for the delete
								$sql = "delete from item where itemcode = ".$itemcodes[$i]." ";
								
								//execute the delete query
								mysqli_query($con, $sql);								
							}
							*/
							
							$itemcodesString = "";
							//$itemcodesString = "2, 1, 4, 5";
							for($i=0; $i<count($itemcodes); $i++)
							{								
								$itemcodesString = $itemcodesString . $itemcodes[$i];
								
								if($i < count($itemcodes) - 1)
								{
									$itemcodesString = $itemcodesString . ", ";
								}															
							}
							
							//form the sql query for the delete
							$sql = "delete from item where itemcode in (".$itemcodesString.") ";
								
							//execute the delete query
							mysqli_query($con, $sql);								
							
							//display success message
							echo "<p>Items(s) were deleted successfully...</p>";
							
						}
						else 
						{
							echo "<p>Please select at least 1 item to be deleted...</p>";
							
						}
						
						
						
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
						echo "<table class='list_table'>";
						echo "		<tr>";
						echo "			<th>Item Code</th>";
						echo "			<th>Description</th>";
						echo "			<th>Price</th>";
						echo "			<th>Quantity</th>";
						echo "			<th>Status</th>";
						echo "			<th><button class='delete_button' type='submit' name='delete'>DELETE</button></th>";
						echo "			<th></th>";
						echo "		</tr>";
						
						//loop and visit each record in the recordset assign it to $record variable
						//and display it
						while($record = mysqli_fetch_assoc($items))
						{
							echo "<tr";
  
							// check if the row is edited and add the "edited" class to it
							if(isset($_GET["edited"]) && $_GET["edited"] == $record["itemcode"]) {
								echo " class='edited'";
							}
							  
							echo ">";
							echo "		<td>".$record["itemcode"]."</td>";
							echo "		<td>".$record["description"]."</td>";
							echo "		<td>".$record["price"]."</td>";
							echo "		<td>".$record["quantity"]."</td>";
							echo "		<td>".$record["status"]."</td>";
							echo "		<td align='center'><input class='checkbox' type='checkbox' name='itemcodes[]' value='".$record["itemcode"]."' /></td>";
							echo "		<td align='center'><a href='edit.php?itemcode=".$record["itemcode"]."'>EDIT</a></td>";
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
					
					echo "<p>Error connecting to database...</p>";
				}
				
				mysqli_close($con);
				
				
			
			
			?>				
		</form>
		<form method="POST">
			<button type="submit" name="search">Search Item</button><br>
			<button type="submit" name="back">Back To Main Menu</button>
		</form>
		<?php
			if(isset($_POST['search'])){
				header('location: search.php');
			}
			if(isset($_POST['back'])){
				header('location: mainmenu.php');
			}
		?>
		</center>
	</body>
</html>