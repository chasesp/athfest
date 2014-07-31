<?php
/*
 * author Jason Kirby & William Spivey
 * Add event to itinerary
 */

session_start();

$con = mysqli_connect('localhost', 'someuser', 'password');
if ($con == null)
{
  //check if db connection is null
	die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con, "AthFest");

$usID = $_SESSION['uID'];
$evID = mysqli_real_escape_string($con, $_POST['evID']);

$query = mysqli_query($con, "SELECT * FROM Events WHERE EventID='$evID'");
$query2 = mysqli_query($con, "SELECT * FROM Itineraries WHERE UserID_FK='$usID' AND EventID_FK='$evID'");
$query3 = mysqli_query($con, "SELECT * FROM Itineraries WHERE UserID_FK='$usID'");

$data = mysqli_fetch_array($query);

if(mysqli_num_rows($query2) !== 0)
{
  //event already exists in user itinerary
	header('Location: http://172.17.152.41:8080/Ath/noAddMessage.html');
	exit;
}
else
  {	
    while($res = mysqli_fetch_array($query3))
      {
	//inspect entry in user itinerary
	if($data['EventDate'] == $res['EventDate'] && $data['EventTime'] == $res['EventTime'])
	  {
	    //date and time of new event conflict with existing event
	    header('Location: http://172.17.152.41:8080/Ath/noAddMessage.html');
	    exit;
	  }
      }
    $evDate = $data['EventDate'];
    $evTime = $data['EventTime'];
    $evType = $data['EventType'];
    $bandName = $data['BandName'];
    $loc = $data['Location'];
    $sql = "INSERT INTO Itineraries (UserID_FK, EventID_FK, EventDate, EventTime, EventType, BandName, Location) VALUES ('$usID', '$evID', '$evDate', '$evTime', '$evType', '$bandName', '$loc')";
    header('Location: http://172.17.152.41:8080/Ath/addMessage.html');	
    if (mysqli_query($con,$sql) == null)
      {
	//add event to user itinerary
	die('Error: ' . mysqli_error($con));
      }
  }
?>

