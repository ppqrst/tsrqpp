<html>
<body>

Welcome!

Your email is <?php echo $_POST["email"]; ?><br>
Your passw is <?php echo $_POST["password"]; ?><br>
Your passw2 is <?php echo $_POST["password2"]; ?><br>

<?php
// define variables
$email = $password = $password2 = "";
$emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// clean up input
	$email = test_input($_POST["email"]);
	$password = test_input($_POST["password"]);
	$password2 = test_input($_POST["password2"]);
	// validate
	if (empty($email)) {
		$emailErr = "Email is required";
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailErr = "Invalid email format"; 
	}
	if (empty($password)) {
		$passwordErr = "Password is required";
	}
	if ($password != $password2) {
		$passwordErr = "Passwords don't match";
	}
}

// function to clean up the form input if needed
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<br>
Errors?
<br><?php echo $emailErr; ?>
<br><?php echo $passwordErr; ?>
<br>

<?php
if (empty($emailErr) and empty($passwordErr)) {
	
	$servername = "sql102.epizy.com";
	$username = "epiz_24031081";
	$dbpassword = "Bm5Z1uhbboD3";
	$dbname = "epiz_24031081_testit";
	$pw_hash = "";
	
	// Create connection
	$conn = new mysqli($servername, $username, $dbpassword, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	// Encrypt password (for login check use logical = password_verify($pw_from_form, $pw_from_db))
	$pw_hash = password_hash($password, PASSWORD_DEFAULT);
	echo "Hashed password: " . $pw_hash . "<br>";
	
	// sql to insert into table
	$sql = "INSERT INTO Users (email, psswrd) VALUES ('" . $email . "', '" . $pw_hash . "')";

	if ($conn->query($sql) === TRUE) {
		echo "<br>Registered successfully<br>";
	} else {
		echo "<br>Error: " . $conn->error . "<br>";
	}
	
	$conn->close();
}
?>

</body>
</html>
