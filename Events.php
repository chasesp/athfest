<?php
/*
 * author Jason Kirby, William Spivey, & Logan Henry
 * retrieve events from data base and display them
 */

$con = mysqli_connect('localhost', 'someuser', 'password');
if ($con == null)
{
  //check if db connection is null
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con, "AthFest");

$result = mysqli_query($con, "SELECT * FROM Events ORDER BY EventDate ASC, EventTime ASC");

$i = 18;

while($data = mysqli_fetch_array($result))
{   
  //inspect single entry of events, print event details
$var = substr($data['EventDate'], 8, 2);
$var += 0;
if($var == $i)
  {
    //initialize new list representing one day
    if($var != 18)
      echo "</ul>";
    echo "<h4>June " . $i . " 2014</h4>";
    echo "<ul data-role=\"listview\" data-inset=\"true\" data-split-icon=\"check\">";
    $i++;
  }

    echo "<li>";
    echo "<h3>" . $data['BandName'] . "</h3>";
    echo "<p>" . $data['EventTime'] . " | ";
    echo $data['Location'] . "</p>";
    echo "</li>";
}

echo "</ul>";

mysqli_close($con);
?>