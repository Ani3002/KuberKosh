<?php

	// Connect to database 
	$con = mysqli_connect("db","admin","password","kuberkosh_db");

	$sql = "SELECT * FROM `registeredBanks`";
	$all_categories = mysqli_query($con,$sql);

	// The following code checks if the submit button is clicked 
	// and inserts the data in the database accordingly
	if(isset($_POST['submit']))
	{
		// Store the Product name in a "name" variable
		$name = mysqli_real_escape_string($con,$_POST['Product_name']);
		
		// Store the Category ID in a "id" variable
		$id = mysqli_real_escape_string($con,$_POST['Category']); 
		
		// Creating an insert query using SQL syntax and
		// storing it in a variable.
		$sql_insert = 
		"INSERT INTO `product`(`product_name`, `category_id`)
			VALUES ('$name','$id')";
		
		// The following code attempts to execute the SQL query
		// if the query executes with no errors 
		// a javascript alert message is displayed
		// which says the data is inserted successfully
		if(mysqli_query($con,$sql_insert))
		{
			echo '<script>alert("Product added successfully")</script>';
		}
    }



    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the selected bankSelect and branchSelect from the form
        $bankSelect = mysqli_real_escape_string($con, $_POST['bankSelect']);
        $branchSelect = mysqli_real_escape_string($con, $_POST['branchSelect']);

        // Insert the selected bankSelect and branchSelect into the database
        $sql_insert = "INSERT INTO `product`(`product_name`, `category_id`, `subcategory_id`)
                       VALUES ('Product Name', '$bankSelect', '$branchSelect')";

        // Execute the SQL query
        if (mysqli_query($con, $sql_insert)) {
            echo '<script>alert("Product added successfully")</script>';
        } else {
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($con);
        }
    }
?>








<?php
  $db = new mysqli("db","admin","password","kuberkosh_db");//set your database handler
  $query = "SELECT regBank_id,bank_name FROM registeredBanks";
  $result = $db->query($query);

  while($row = $result->fetch_assoc()){
    $banks[] = array("regBank_id" => $row['regBank_id'], "val" => $row['bank_name']);
  }

  $query = "SELECT regBank_id, brunch_id, brunchLocation FROM bank_brunches";
  $result = $db->query($query);

  while($row = $result->fetch_assoc()){
    $brunches[$row['regBank_id']][] = array("regBank_id" => $row['regBank_id'], "val" => $row['brunchLocation']);
  }

  $jsonBanks = json_encode($banks);
  $jsonBrunches = json_encode($brunches);
?>

<!doctype html>
<html>

<head>
    <script type='text/javascript'>
        <?php
        echo "var bank = $jsonBanks; \n";
        echo "var branches = $jsonBrunches; \n";
        ?>
        function loadBanksBranches() {
            var select = document.getElementById("bankSelect");
            select.onchange = updateBranches;

            // Add default "Select Bank" option
            select.options[0] = new Option("Select Bank", "");
            select.options[0].disabled = true;
            select.options[0].selected = true;

            for (var i = 0; i < bank.length; i++) {
                select.options[i + 1] = new Option(bank[i].val, bank[i].regBank_id);
            }
        }

        function updateBranches() {
            var catSelect = this;
            var catid = this.value;
            var branchSelect = document.getElementById("branchSelect");
            branchSelect.options.length = 0; //delete all options if any present

            // Add default "Select Location" option
            branchSelect.options[0] = new Option("Select Location", "");
            branchSelect.options[0].disabled = true;
            branchSelect.options[0].selected = true;

            for (var i = 0; i < branches[catid].length; i++) {
                branchSelect.options[i + 1] = new Option(branches[catid][i].val, branches[catid][i].brunch_id);
            }
        }
    </script>

</head>

<body onload='loadBanksBranches()'>
    <form method="post" action="">
        <select id='bankSelect' name="bankSelect">
        </select>

        <select id='branchSelect' name="branchSelect">
        </select>

        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>