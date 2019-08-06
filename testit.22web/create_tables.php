<html>
<body>

<?php
//$servername = "sql102.epizy.com";
//$username = "epiz_24031081";
//$dbpassword = "spoonfin99";
//$dbname = "epiz_24031081_testit";
$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "testit";

// Create connection
$conn = new mysqli($servername, $username, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<br>");
} 

// sql to create Users table
$sql = "CREATE TABLE Users (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(128) UNIQUE NOT NULL,
psswrd VARCHAR(256) NOT NULL,
reg_time TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Users created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// sql to create Children table
$sql = "CREATE TABLE Children (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
parent INT UNSIGNED NOT NULL,
email VARCHAR(128) NOT NULL,
reg_time TIMESTAMP,
total_money_earned DOUBLE DEFAULT 0,
money_balance DOUBLE DEFAULT 0,
FOREIGN KEY (parent) REFERENCES Users(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Children created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// sql to create Questions table
$sql = "CREATE TABLE Questions (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
level INT UNSIGNED NOT NULL,
question VARCHAR(1024) NOT NULL,
answer VARCHAR(128) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Questions created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// sql to create Payments table
$sql = "CREATE TABLE Payments (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
parent_id INT UNSIGNED NOT NULL,
child_id INT UNSIGNED NOT NULL,
pay_time TIMESTAMP,
amount_paid DOUBLE DEFAULT 0,
selected_level INT UNSIGNED NOT NULL,
total_num_questions INT UNSIGNED NOT NULL,
num_questions_sent INT UNSIGNED DEFAULT 0,
num_questions_correct INT UNSIGNED DEFAULT 0,
money_per_question DOUBLE DEFAULT 0,
questions_cancelled BOOLEAN DEFAULT FALSE,
FOREIGN KEY (parent_id) REFERENCES Users(id),
FOREIGN KEY (child_id) REFERENCES Children(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Payments created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// sql to create SentQuestions table
$sql = "CREATE TABLE SentQuestions (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
child_id INT UNSIGNED NOT NULL,
question_id INT UNSIGNED NOT NULL,
payment_id INT UNSIGNED NOT NULL,
sent_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
answer VARCHAR(128),
answer_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
answer_correct BOOLEAN DEFAULT FALSE,
money_earned DOUBLE DEFAULT 0,
FOREIGN KEY (child_id) REFERENCES Children(id),
FOREIGN KEY (question_id) REFERENCES Questions(id),
FOREIGN KEY (payment_id) REFERENCES Payments(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table SentQuestions created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// sql to create MoneyGiven table
$sql = "CREATE TABLE MoneyGiven (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
child_id INT UNSIGNED NOT NULL,
give_time TIMESTAMP,
amount_given DOUBLE NOT NULL,
FOREIGN KEY (child_id) REFERENCES Children(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table MoneyGiven created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// sql to create Feedback table
$sql = "CREATE TABLE Feedback (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
parent_id INT UNSIGNED NOT NULL,
rate_time TIMESTAMP,
rating INT UNSIGNED NOT NULL,
comments VARCHAR(4096),
FOREIGN KEY (parent_id) REFERENCES Users(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Feedback created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

$conn->close();
?>

</body>
</html>
