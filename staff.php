<!DOCTYPE HTML> 
<html>
<head>
<title> Using staff details </title>
<link rel="stylesheet" href="style.css" />
</head>
<body bgcolor="white">
<h1> Staff search conditions </h1>


<?php
$formtop='<form <action="<?php echo htmlentities($_SERVER[$redir]); ?>" method="post">';
$menu=$formtop.'<select name="second" style="display: none"> <option value=""></option></select>';
$subbutton='<input type="submit" name="formSubmit" value="Submit" /></form><a href="index.html"> Back to index </a>';
$formdetail="";
$query="";
$wherecond="";
$result_id="";
if(isset($_POST['formSubmit'])) {$query= $_POST['first'];
 $wherecond= $_POST['second'];}

$conn_id = @mysql_connect ("server", "id","password")
or exit ();

mysql_select_db ("Dreamhome_km32", $conn_id);
if (!$query && !$wherecond){
$formdetail.=$menu.'
	<label for="first">Please choose how you like to search :</label><br>
	<select name="first">
		<option value="">Select an option...</option>
		<option value="Sno">Staff Number</option>
		<option value="Position">Position</option>
        <option value="Bno">Branch Number</option>
	</select> 
    <br>'.$subbutton;


}
if ($query && !$wherecond){
    Printf("Showing search results for : ".$query);
$result_id = mysql_query ("select FName, LName, " .$query. " from staff") or exit ();
if ($result_id){

	while ($row = mysql_fetch_array ($result_id)){
		printf ("<p> ".$row["FName"]." ".$row["LName"]." " .$row[$query] ); }
	$menu=$formtop.'<select name="first" style="display: none">
	 <option value='.$query.'></option>
	 </select>';
	  $result_id = mysql_query ("select FName, LName," .$query. " from staff group by ".$query) or exit ();
	$menu.="<label for='second'> Search parameters : </label> <select name='second'><option value=''>Select an option...</option>";
	while ($row = mysql_fetch_array ($result_id)){
		$menu.="<option value=".$row[$query].">".$row[$query]."</option>";
		}
	$menu.=$subbutton;
	mysql_free_result ($result_id);
	}
	
}

elseif ($query && $wherecond){
    Printf("Showing search results for : ".$query. " and ".$wherecond);
$result_id = mysql_query ("select * from staff where ".$query." = '".$wherecond."'") or exit ();
while ($row = mysql_fetch_array ($result_id)){
printf ("<p> ".$row["FName"]." ".$row["LName"]." " .$row[$query] );}
mysql_free_result ($result_id);}


?>
<span><?php printf( $formdetail); ?> </span>
<span><?php printf( $menu); ?> </span>



</body>
</html>