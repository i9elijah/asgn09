<!DOCTYPE html>
<!--	Author: Elijah Hume
		Date:	11/3/2020
		File:	wage-report.php
		Purpose:MySQL Exercise
-->

<html>
<head>
	<title>MySQL Query</title>
	<link rel ="stylesheet" type="text/css" href="sample.css">
</head>
<body>
<?php

include_once("connection.php");

$connect=mysqli_connect(SERVER, USER, PW, DB);

if( !$connect) 
{
	die("ERROR: Cannot connect to database $db on server $server 
	using user name $user (".mysqli_connect_errno().
	", ".mysqli_connect_error().")");
}

$hourlyWage = $_POST['hourlyWage'];
$jobTitle = $_POST['jobTitle'];

$userQuery = "SELECT * FROM personnel WHERE hourlyWage='$hourlyWage' AND jobTitle='$jobTitle'"; // ADD THE QUERY

$result = mysqli_query($connect, $userQuery);

if (!$result) 
{
	die("Could not successfully run query ($userQuery) from $db: " .	
		mysqli_error($connect) );
}

if (mysqli_num_rows($result) == 0) 
{
	print("No records found with query $userQuery");
}
else 
{ 
	print("<h1>RESULTS</h1>");
	print("<p>The following employees have the $jobTitle job title, and an hourly wage of $".
			number_format($hourlyWage, 2)." or higher:</p>");
			
	print("<table border = \"1\">");
	print("<tr><th>EMP ID</th></tr>");

	while($row = $result->fetch_assoc()) {
	print("<tr><td>".$row["empID"]."</td></tr>");
  	}// ADD CODE HERE

	print ("</table>");
}

mysqli_close($connect);   // close the connection
 
?>
</body>
</html>
