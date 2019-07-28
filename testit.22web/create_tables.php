<html>
<body>

<?php
$servername = "sql102.epizy.com";
$username = "epiz_24031081";
$password = "spoonfin99";
$dbname = "epiz_24031081_testit";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create Users table
$sql = "CREATE TABLE Users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(100) UNIQUE NOT NULL,
psswrd VARCHAR(255) NOT NULL,
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to create Children table
$sql = "CREATE TABLE Children (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
parent INT(6),
email VARCHAR(100) NOT NULL,
reg_date TIMESTAMP,
FOREIGN KEY (parent) REFERENCES Users(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Children created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>

</body>
</html>
