<?php
/*
 * author Jason Kirby
 * format of Itinerary based on work by William Spivey
 */

session_start();

$con = mysqli_connect('localhost', 'someuser', 'password');
if ($con == null)
{
  //check if db connection is null
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con, "AthFest");

$userID = $_SESSION['uID'];

$query = mysqli_query($con, "SELECT * FROM Itineraries WHERE UserID_FK='$userID' ORDER BY EventDate ASC, EventTime ASC");

//$i = 18;

echo "<ul data-role=\"listview\" data-inset=\"true\" data-split-icon=\"check\">";

while($data = mysqli_fetch_array($query))
{
  //inspect single entry of Events, print event details
	$eID = $data['EventID'];

	echo "<li>";
	echo "<h3>" . $data['BandName'] . "</h3>";
	echo "<p>" . $data['EventDate'] . " @ " . $data['EventTime'] . " | ";
	echo $data['Location'] . "</p>";
	echo "</li>";
}
echo "</ul>";

mysqli_close($con);
?>
