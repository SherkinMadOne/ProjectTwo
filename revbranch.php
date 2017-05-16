<!DOCTYPE HTML> 
<html>
<head>
<title> Using staff details </title>
</head>
<body bgcolor="white">
<h1> Select Branch information </h1>


<?php

$result_id="";

$conn_id = @mysql_connect ("server", "id","password")
or exit ();


mysql_select_db ("Dreamhome_km32", $conn_id);

$result_id = mysql_query ("select Concat(Fname,' ',LName) FROM owner") or exit ();
printf($result_id);
if ($result_id){
	while ($row = mysql_fetch_array ($result_id)){
		printf($row['Name']."<br>");
        printf($row[0]."<br>");
		}
	mysql_free_result ($result_id);
}



?>


</body>
</html>