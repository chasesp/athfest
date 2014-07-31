<?php
/*
 * author William Spivey
 * Displays events happening in the next hour
 */

$con = mysqli_connect('localhost', 'someuser', 'password');
if($con == null)
  {
    //check if db connection is null
  die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con, "AthFest");

date_default_timezone_set('America/New_York');

$date = date('m/d/Y h:i:s');
$hour = substr($date, 11, 2);
$hour += 1;//checks for events at time hour + 1
$day = substr($date, 3, 2);
$day += 0;
$result=mysqli_query($con, "SELECT * FROM Events");

echo "<div data-role=\"header\" data-theme=\"e\">";
echo "<h3>EVENTS HAPPENING WITHIN THE NEXT HOUR</H3><br>";

while($data = mysqli_fetch_array($result))
  {
    //inspect single entry of Events
    $var = substr($data['EventDate'], 8, 2);
    $var += 0;
    $var2 = substr($data['EventTime'], 0, 2);
    $var2 += 0;
    if($day == $var && $hour == $var2)
      {
      //checks if event is starting in the next hour
      echo "<h3>" . $data['BandName'] . " @ " . $data['Location'] . "</h3><br>";
      }
  }
echo "</div>";
mysqli_close($con);
?>