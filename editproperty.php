<!DOCTYPE HTML> 
<html>
<head>
<title> Using staff details </title>
<link rel="stylesheet" href="style.css" />
</head>
<body bgcolor="white">
<h1> Edit Propertys </h1>


<?php
$formtop='<form <action="<?php echo htmlentities($_SERVER[$redir]); ?>" method="post">';
$menu=$formtop.'<select name="second" style="display: none"> <option value=""></option></select> <input type="text" name ="third" value="" style="display: none"';
$subbutton='<input type="submit" name="formSubmit" value="Submit" /></form> <a href="index.html"> Back to index </a>';
$formdetail="";
$query="";
$wherecond="";
$result_id="";
$Innputform="";


if(isset($_POST['formSubmit'])) {$query= $_POST['first'];
 $wherecond= $_POST['second'];
 $Innputform=$_POST['third'];
 if ($query && $Innputform){
    $Street=$_POST["Street"];
    $Address=$_POST["Area"];
    $Rent=$_POST["Rent"];
    $PNO=$_POST["Pno"];
    $BNO=$_POST["Bno"];
    $Type=$_POST["Rooms"];

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
		<option value="Insert">Insert</option>
        <option value="Delete">Delete</option>
	</select> 
    <br>'.$subbutton;

}

if ($query==="Update" && !$wherecond){
    
    $result_id = mysql_query ("select Street, Area, Pno from property_for_rent") or exit ();
if ($result_id){
    PrintF("<p>Please select Property : </p>"); 
	$menu=$formtop.'<select name="first" style="display: none">
	 <option value='.$query.'></option>
	 </select> <input type="text" name ="third" value="" style="display: none"';
	$menu.="<label for='second'> Search parameters : </label> <select name='second'><option value=''>Select...</option>";
	while ($row = mysql_fetch_array ($result_id)){
		$menu.="<option value=".$row["Pno"].">".$row["Street"]." ".$row["Area"]." ".$row["Pno"]."</option>";
		}
	$menu.=$subbutton;
	mysql_free_result ($result_id);

}

}

if ($query==="Update" && $wherecond){
    $result_id = mysql_query ("select * from property_for_rent where Pno='".$wherecond."'") or exit ();
$formdetail=$formtop.'<select name="second" style="display: none"> <option value='.$wherecond.'></option></select>
<input type="text" name ="third" value="True" style="display: none">
<select name="first" style="display: none">
	 <option value='.$query.'></option>
	 </select>';
if ($result_id){
    $row = mysql_fetch_array ($result_id);
    printf("Street : ".$row["Street"]);
    printf($formdetail.
       "<br> Street : <input type='text' name ='Street' value=".$row["Street"]." readonly>".
   "<br> Area : <input type='text' name ='Area' value='".$row["Area"]."' readonly>".
   "<br> Property No. : <input type='text' name ='Pno' value='".$row["Pno"]."' readonly>".
   "<br> Rent : <input type='text' name ='Rent' value='".$row["Rent"]."'>".
    '<br> <select name="Rooms">
		<option value="">Select an option...</option>
		<option value="House">House</option>
		<option value="Flat">Flat</option>
        <option value="Bungalow">Bungalow</option>
	</select> '.
    "<br> Branch : <input type='text' name ='Bno'  value=".$row["Bno"].">".$subbutton);
}

}
if ($query==="Insert" && !$Innputform){
$formdetail=$formtop.'<select name="second" style="display: none"> <option value=""></option></select>
<input type="text" name ="third" value="True" style="display: none">'
.'<select name="first" style="display: none">
	 <option value='.$query.'></option>
	 </select>';
   $formdetail.=
   "<br> Street : <input type='text' name ='Street'>".
   "<br> Area : <input type='text' name ='Area'>".
   "<br> Property No. : <input type='text' name ='Pno'>".
   "<br> Rent : <input type='text' name ='Rent'>".
    '<br> <label for ="Rooms" > Type : </label> <select name="Rooms">
		<option value="">Select an option...</option>
		<option value="House">House</option>
		<option value="Flat">Flat</option>
        <option value="Bungalow">Bungalow</option>
	</select> ';
    $result_id = mysql_query ("select distinct (bno) from branch") or exit ();
if ($result_id){
	$formdetail.='<label for="Bno"> Select a Branch Number </label><select name="Bno">';
	while ($row = mysql_fetch_array ($result_id)){
		$formdetail.="<option value=".$row['bno'].">".$row['bno']."</option>";
		}}
    $formdetail.="</select>".$subbutton;
}

if ($query==="Delete"  && !$wherecond){

    $result_id = mysql_query ("select Street, Area, Pno from property_for_rent") or exit ();
if ($result_id){
    PrintF("<p>Please select Property : </p>"); 
	$menu=$formtop.'<select name="first" style="display: none">
	 <option value='.$query.'></option>
	 </select> <input type="text" name ="third" value="" style="display: none"';
	$menu.="<label for='second'> Search parameters : </label> <select name='second'><option value=''>Select...</option>";
	while ($row = mysql_fetch_array ($result_id)){
		$menu.="<option value=".$row["Pno"].">".$row["Street"]." ".$row["Area"]." ".$row["Pno"]."</option>";
		}
	$menu.=$subbutton;
	mysql_free_result ($result_id);
    }
}
if ($query==="Delete"  && $wherecond){
     $formdetail=$formtop.'<select name="second" style="display: none"> <option value=""></option></select>
<input type="text" name ="third" value="" style="display: none" ><select name="first" style="display: none">
	 <option value=""></option>	 </select>';
    $result_id = mysql_query ("select Street, Area, Pno from property_for_rent where Pno='".$wherecond."'") or exit ();
    if ($result_id){
        $row = mysql_fetch_array ($result_id);
        $query="Deleting : ".$row["Street"]." ".$row["Area"]." ".$row["Pno"];}
        if ( mysql_query ("delete from property_for_rent where Pno='".$wherecond."'") ) {printf($query);}
}

if ($Innputform){
   
   $formdetail=$formtop.'<select name="second" style="display: none"> <option value=""></option></select>
<input type="text" name ="third" value="True" style="display: none" ><select name="first" style="display: none">
	 <option value=""></option>	 </select>';

  if ($query==="Update"){
      if( mysql_query ("Update property_for_rent SET Street='".$Street."', Area='".$Address."', Rent='".$Rent."', Bno='".$BNO."', Type='".$Type."' where pno='".$wherecond."'"))
      {printf("Updated");}       
        else { printf("Failed update");}}
    if ($query==="Insert")
    { 
         if( mysql_query ("Insert into property_for_rent (Street, Area, Rent, Pno, Bno, Type) Values ('".$Street."','".$Address."','".$Rent."','".$PNO."','".
        $BNO."','".$Type."')")){ printf("Property Inserted");} else { printf("Failed update ");}
        
    } 
    $formdetail=$formtop.'<select name="second" style="display: none"> <option value=""></option></select>
<input type="text" name ="third" value="True" style="display: none" <select name="first" style="display: none">
	 <option value=""></option>	 </select>';
  
  
}

?>
<span><?php printf( $formdetail); ?> </span>
<span><?php printf( $menu); ?> </span>



</body>
</html>