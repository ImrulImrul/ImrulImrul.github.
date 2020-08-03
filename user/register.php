<!DOCTYPE HTML>
<html>
<body>
<?php
 
include 'server.html'; // include the connection object from the DBConnection.html
 
 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ 
	 $inFullname = $_POST["fullname"]; // as the method type in the form is "post" we are using $_POST otherwise it would be $_GET[]
	 $inEmail = $_POST["email"];
	 $inUsername = $_POST["username"];
	 $inPassword = $_POST["password"];

	$encryptPassword = password_hash($inPassword, PASSWORD_DEFAULT);
	 
	 $stmt = $db->prepare("INSERT INTO user( username, email, password) VALUES('$inUsername','$inEmail','$inPassword ')"); //Fetching all the records with input credentials
	 $stmt->bind_param("ssss", $inFullname, $inEmail, $inUsername, $encryptPassword); //Where s indicates string type. You can use i-integer, d-double
	 $stmt->execute();
	 $result = $stmt->affected_rows;
	 $stmt -> close();
	 $db -> close(); 
	
	if($result > 0)
	 {
		header("location: login.html"); // user will be taken to the login page
	 }
	 else
	 {
		 echo "Oops. Something went wrong. Please try again"; 
		 ?>
		<a href="registration.html">Try Login</a>
	    <?php 
	 }
}
?>
</body> 
</html>