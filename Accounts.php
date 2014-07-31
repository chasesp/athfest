<?php
/*
 * author Jason Kirby
 * adds User to the database
 */

$con = mysqli_connect('localhost', 'someuser', 'password');
if ($con == null)
{
  //check if db connection is null
	die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con, "AthFest");

$username = mysqli_real_escape_string($con, $_POST['newUsername']);
$password = mysqli_real_escape_string($con, $_POST['newPassword']);
$conPassword = mysqli_real_escape_string($con, $_POST['conPassword']);
$query = mysqli_query($con, "SELECT * FROM Accounts WHERE Username='$username'");

if($username === '' || $password === '' || $conPassword === '')
{
  //check for empty fields
	header('Location: http://172.17.152.41:8080/Ath/fillCreateAcc.html');
	exit;
}
else if($password === $conPassword)
{
  //passwords match
	if(mysqli_num_rows($query) !== 0)
	{
	  //user already exists
		header('Location: http://172.17.152.41:8080/Ath/userCreateAcc.html');
		exit;
	}
	else
	{
		$sql = "INSERT INTO Accounts (Username, Password) VALUES ('$username', '$password')";
		header('Location: http://172.17.152.41:8080/Ath/userHomepage.html');

		if (mysqli_query($con,$sql) == null)
		  {
		    //add new user to db
			die('Error: ' . mysqli_error($con));
		  }
	}
}
else if($password !== $conPassword)
{
  //passwords don't match
	header('Location: http://172.17.152.41:8080/Ath/passCreateAcc.html');
	exit;	
}

mysqli_close($con);
?>