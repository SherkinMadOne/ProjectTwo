<!DOCTYPE HTML> 
<html>
<head>
<title> Using staff details </title>
<link rel="stylesheet" href="style.css" />
</head>
<body bgcolor="white">
<h1> Branch Update conditions </h1>


<?php
$formtop='<form <action="<?php echo htmlentities($_SERVER[$redir]); ?>" method="post">';
$menu=$formtop.'<select name="second" style="display: none"> <option value=""></option></select> <input type="text" name ="third" value="" style="display: none"';
$subbutton='<input type="submit" name="formSubmit" value="Submit" /></form>';
$formdetail="";
$query="";
$wherecond="";
$result_id="";
$Address="";
$Phone="";
$Bno="";
$Position="";
$Innputform="";


if(isset($_POST['formSubmit'])) {$query= $_POST['first'];
 $wherecond= $_POST['second'];
 $Innputform=$_POST['third'];
 if ($query && $Innputform){
    $Address=$_POST["Address"];
    $Phone=$_POST["Phone"];
    $Bno=$_POST["Bno"];


 }
 }

$conn_id = @mysql_connect ("server", "id","password")
or exit ();

mysql_select_db ("Dreamhome_km32", $conn_id);

if (!$query && !$wherecond){
$formdetail.=$menu.'
	<label for="first">Please choose how you like to search :</label><br>
	<select name="first">
		<option value="">Select an option...</option>
		<option value="Update">Update</option>
	</select> 
    <br>'.$subbutton;

}

if ($query==="Update" && !$wherecond){
    
    $result_id = mysql_query ("select Bno from branch") or exit ();
if ($result_id){
    PrintF("<p>Please select Branch No : </p>"); 
	$menu=$formtop.'<select name="first" style="display: none">
	 <option value='.$query.'></option>
	 </select> <input type="text" name ="third" value="" style="display: none"';
	$menu.="<label for='second'> Search parameters : </label> <select name='second'><option value=''>Select branch...</option>";
	while ($row = mysql_fetch_array ($result_id)){
		$menu.="<option value=".$row["Bno"].">".$row["Bno"]."</option>";
		}
	$menu.=$subbutton;
	mysql_free_result ($result_id);

}

}

if ($query==="Update" && $wherecond){
    $result_id = mysql_query ("select * from branch where Bno='".$wherecond."'") or exit ();
$formdetail=$formtop.'<select name="second" style="display: none"> <option value='.$wherecond.'></option></select>
<input type="text" name ="third" value="True" style="display: none">
<select name="first" style="display: none">
	 <option value='.$query.'></option>
	 </select>';
if ($result_id){
    $row = mysql_fetch_assoc ($result_id);
    printf($formdetail.
   "<br>Branch No. : <input type='text' name ='Bno' value='".$row["Bno"]."' readonly>".
   "<br> Address : <input type='text' name ='Address' value='".$row["Street"]."'>".
    "<br> Telephone :<input type='text' name ='Phone' value='".$row["Tel_No"]."'>".$subbutton);
}

}


if ($Innputform){

   $formdetail=$formtop.'<select name="second" style="display: none"> <option value=""></option></select>
<input type="text" name ="third" value="True" style="display: none" ><select name="first" style="display: none">
	 <option value=""></option>	 </select>';

  if ($query==="Update"){
      if( mysql_query ("Update branch SET Street='".$Address."', Tel_No='".$Phone."' where Bno='".$wherecond."'" ) ){
        printf("Updated");}        
        else { printf("Failed update");}
  }
    $formdetail=$formtop.'<select name="second" style="display: none"> <option value=""></option></select>
<input type="text" name ="third" value="True" style="display: none" <select name="first" style="display: none">
	 <option value=""></option>	 </select><a href="index.html"> Back to index </a>';
  
  }

?>
<span><?php printf( $formdetail); ?> </span>
<span><?php printf( $menu); ?> </span>



</body>
</html>