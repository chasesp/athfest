<?php
/*
 * author Jason Kirby
 * hanles user login
 */

	session_start();

	$con = mysqli_connect('localhost', 'someuser', 'password');

	if ($con == null)
	{
	  //checks if db connection is null
	  die('Could not connect: ' . mysqli_error($con));
	}

	mysqli_select_db($con, "AthFest");

	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$query = mysqli_query($con, "SELECT * FROM Accounts WHERE Username='$username' AND Password='$password'");

if(mysqli_num_rows($query) === 1)
  {
    //user exists in db
    $data = mysqli_fetch_array($query);
    $_SESSION['uID'] = $data['UserID'];
    header('Location: http://172.17.152.41:8080/Ath/userHomepage.html?t=' . time());
    exit;
    if($query == null)
      die('Error: ' . mysqli_error($con));
  }
else
  {
    //user does not exist, redirect
    header('Location: http://172.17.152.41:8080/Ath/invalidUser.html');
    exit;
  }

mysqli_close($con);
?>
