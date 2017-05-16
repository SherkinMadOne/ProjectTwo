<!DOCTYPE HTML> 
<html>
<head>
<title> Using staff details </title>
</head>
<body bgcolor="white">
<h1> Select Branch information </h1>


<?php
$formtop='<form <action="<?php echo htmlentities($_SERVER[$redir]); ?>" method="post">';
$subbutton='<input type="submit" name="formSubmit" value="Submit" /></form><a href="index.html"> Back to index </a>';
$formdetail="";
$query="";
$result_id="";
$menu="";
if(isset($_POST['formSubmit'])) $query= $_POST['first'];

$conn_id = @mysql_connect ("server", "id","password")
or exit ();


mysql_select_db ("Dreamhome_km32", $conn_id);
if (!$query ){

$result_id = mysql_query ("select * from branch group by city") or exit ();
if ($result_id){
	$menu=$formtop.'<select name="first">';
	while ($row = mysql_fetch_array ($result_id)){
		$menu.="<option value=".$row['City'].">".$row['City']."</option>";
		}
	$menu.=$subbutton;
	mysql_free_result ($result_id);
}
}



if ($query){
$result_id = mysql_query ("select * from branch where city='" .$query."'") or exit ();

if ($result_id){
printf("<h1> Showing search results for :".$query."</h1><br>");
	while ($row = mysql_fetch_array ($result_id)){
		printf($row["Bno"]);
		printf ("<p> ".$row["Street"]." ".$row["Area"]."</p>"."Tel No/Fax No <br>".$row["Tel_No"]."  /  ".$row["Fax_No"] ); 
		$result_idb = mysql_query ("select * from staff where Bno='" .$row["Bno"]."'") or exit ();
		printf("<p> "."Staff : </p>");
		while ($rowb = mysql_fetch_array ($result_idb)){
			printf($rowb["Position"]." ".$rowb["FName"]." ".$rowb["LName"]."<br>"); }}
	mysql_free_result ($result_id);
	
	
}}



?>
<span><?php printf( $menu); ?> </span>



</body>
</html>