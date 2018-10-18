<?php
 $server = "35.226.169.132";
 $username = "root";
 $password = "12345";
 $dbname = "sybio-219816:us-central1:sybiodb";
 // Create connection
 $conn = new mysqli($servername, $username, $password,$dbname);
 // Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }

 
 // sql to create table
$sql = "CREATE TABLE Liang (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Liang created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>

<!DOCTYPE HTML>  
<html>
<head>
<style type="text/css">
	table {border-collapse: collapse;}
	table, th,td{
	border:1px solid black;
	}
</style>
</head>
<body> 
<h2>STUDENTS</h2>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
First Name: <input type="text" name="firstName">

  <br><br>
Last Name: <input type="text" name="lastName" >

  <br><br>
Email: <input type="text" name="email">

  <br><br>
<input type="submit" value="Submit">
</form>
</body>
</html>

<?php
$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$email=$_POST['email'];
$stmt = $conn->prepare("INSERT INTO Liang (firstname, lastname, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $firstname, $lastname, $email);
$stmt->execute();

$sql= "INSERT INTO Liang (firstname, lastname, email)
VALUES ('$firstName', '$lastName', '$email')";

if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id;
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "SELECT id, firstname, lastname, email FROM Liang";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     echo "<table><tr><th>ID</th><th>Name</th><th>Email</th></tr>";
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<tr><td>" . $row["id"]. "</td><td>" . $row["firstname"]. " " . $row["lastname"]. "</td><td>".$row["email"]."</td></tr>";
     }
     echo "</table>";
} else {
     echo "0 results";
}

$stmt->close();
$conn->close();

?>
























