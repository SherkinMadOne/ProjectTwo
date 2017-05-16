<!DOCTYPE HTML> 
<html>
<head>
<title> Using property details </title>
</head>
<body bgcolor="white">
<h1> Search propertys : </h1>


<?php
$formtop='<form <action="<?php echo htmlentities($_SERVER[$redir]); ?>" method="post">';
$menu=$formtop.'<select name="second" style="display: none"> <option value=""></option></select>';
$subbutton='<input type="submit" name="formSubmit" value="Submit" /></form><a href="index.html"> Back to index </a>';
$formdetail="";
$query="";
$wherecond="";
$result_id="";
$counter=0;
$values= array ('City',  'Rooms', 'Type');
if(isset($_POST['formSubmit'])) {$query= $_POST['first'];
 $wherecond= $_POST['second'];}

$conn_id = @mysql_connect ("server", "id","password")
or exit ();

mysql_select_db ("Dreamhome_km32", $conn_id);
if (!$query && !$wherecond){
$formdetail.=$menu.'
	<label for="first">Please choose how you like to search :</label><br>
	<select name="first">
		<option value="">Select an option...</option>';
		while ($counter<count($values)){
		$formdetail.='<option value="'.$values[$counter].'">'.$values[$counter].'</option>';
		$counter++;}
$formdetail.='
	</select> 
    <br>'.$subbutton;


}
if ($query && !$wherecond){
    printf("<h1>Showing all properties : Please select from menu.</h1>");
$result_id = mysql_query ("select * from property_for_rent group by ".$query) or exit ();
if ($result_id){

	while ($row = mysql_fetch_array ($result_id)){
		printf ("<p> ".$row["Street"]." ".$row["Area"]." " .$row[$query]." ".$row["Type"]." ".$row["Rent"]." " ); }
	$menu=$formtop.'<select name="first" style="display: none">
	 <option value='.$query.'></option>
	 </select>';
	  $result_id = mysql_query ("select Street, Area, Type, Rent," .$query. " from property_for_rent group by ".$query) or exit ();
	$menu.="<label for='second'> Search parameters : </label> <select name='second'><option value=''>Select an option...</option>";
	while ($row = mysql_fetch_array ($result_id)){
		$menu.="<option value=".$row[$query].">".$row[$query]."</option>";
		}
	$menu.=$subbutton;
	mysql_free_result ($result_id);
	}
	
}

elseif ($query && $wherecond){
    if ($query==="City"){ printf ("<h1>Showing all properties in :".$wherecond)."</h1>";}
    if ($query==="Rooms"){ printf ("<h1>Showing all properties with :".$wherecond." rooms </h1>");}
    if ($query==="Type"){ printf ("<h1>Showing all properties that are a :".$wherecond)."</h1>";}
$result_id = mysql_query ("select * from property_for_rent where ".$query." = '".$wherecond."'") or exit ();
while ($row = mysql_fetch_array ($result_id)){
printf ("<p> ".$row["Street"]." ".$row["Area"]." " .$row[$query]." <p>Property Type: ".$row["Type"]." </p><p>Rent : $".$row["Rent"]." " ); }
mysql_free_result ($result_id);}





?>
<span><?php printf( $formdetail); ?> </span>
<span><?php printf( $menu); ?> </span>



</body>
</html>