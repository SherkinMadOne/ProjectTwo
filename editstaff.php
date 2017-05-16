<!DOCTYPE HTML> 
<html>
<head>
<title> Using staff details </title>
<link rel="stylesheet" href="style.css" />
</head>
<body bgcolor="white">
<h1> Staff Update / Insert </h1>


<?php
$formtop='<form <action="<?php echo htmlentities($_SERVER[$redir]); ?>" method="post">';
$menu=$formtop.'<select name="second" style="display: none"> <option value=""></option></select> <input type="text" name ="third" value="" style="display: none"';
$subbutton='<input type="submit" name="formSubmit" value="Submit" /></form>';
$formdetail="";
$query="";
$wherecond="";
$result_id="";
$Fname="";
$Lname="";
$Address="";
$Phone="";
$Salary="";
$SNO="";
$Position="";
$Innputform="";


if(isset($_POST['formSubmit'])) {$query= $_POST['first'];
 $wherecond= $_POST['second'];
 $Innputform=$_POST['third'];
 if ($query && $Innputform){
    $Fname=$_POST["FName"];
    $Lname=$_POST["LName"];
    $Address=$_POST["Address"];
    $Phone=$_POST["Phone"];
    $Salary=$_POST["Salary"];
    $SNO=$_POST["Sno"];
    $Bno=$_POST["Bno"];
    $Position=$_POST["Position"];

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
	</select> 
    <br>'.$subbutton;

}

if ($query==="Update" && !$wherecond){
    
    $result_id = mysql_query ("select FName, LName, Sno from staff") or exit ();
if ($result_id){
    PrintF("<p>Please select Staff No : </p>"); 
	$menu=$formtop.'<select name="first" style="display: none">
	 <option value='.$query.'></option>
	 </select> <input type="text" name ="third" value="" style="display: none"';
	$menu.="<label for='second'> Search parameters : </label> <select name='second'><option value=''>Select staff member...</option>";
	while ($row = mysql_fetch_array ($result_id)){
		$menu.="<option value=".$row["Sno"].">".$row["FName"]." ".$row["LName"]." ".$row["Sno"]."</option>";
		}
	$menu.=$subbutton;
	mysql_free_result ($result_id);

}

}

if ($query==="Update" && $wherecond){
    $result_id = mysql_query ("select * from staff where Sno='".$wherecond."'") or exit ();
$formdetail=$formtop.'<select name="second" style="display: none"> <option value='.$wherecond.'></option></select>
<input type="text" name ="third" value="True" style="display: none">
<select name="first" style="display: none">
	 <option value='.$query.'></option>
	 </select>';
if ($result_id){
    $row = mysql_fetch_assoc ($result_id);
    printf($formdetail.
       "<br> First Name : <input type='text' name ='FName' value=".$row["FName"]." readonly>".
   "<br> Second Name : <input type='text' name ='LName' value=".$row["LName"]." readonly>".
   "<br> Staff No. : <input type='text' name ='Sno' value=".$row["Sno"]." readonly>".
   "<br> Address : <input type='text' name ='Address' value=".$row["Address"].">".
    "<br> Telephone :<input type='text' name ='Phone' value=".$row["Tel_No"].">".
    "<br> Position :<input type='text' name ='Position' value=".$row["Position"].">".
     "<br> Branch Number :<input type='text' name ='Bno' value=".$row["Bno"].">".
    "<br> Salary : <input type='text' name ='Salary'  value=".$row["Salary"].">".$subbutton);
}

}
if ($query==="Insert" && !$Innputform){
$formdetail=$formtop.'<select name="second" style="display: none"> <option value=""></option></select>
<input type="text" name ="third" value="True" style="display: none">'
.'<select name="first" style="display: none">
	 <option value='.$query.'></option>
	 </select>';
   printf($formdetail.
   "<br> First Name : <input type='text' name ='FName' value='''>".
   "<br> Second Name : <input type='text' name ='LName' value='''>".
   "<br> Staff No. : <input type='text' name ='Sno' value='''>".
   "<br> Address : <input type='text' name ='Address' value=''>".
    "<br> Telephone :<input type='text' name ='Phone' value=''>".
    "<br> Position :<input type='text' name ='Position' value=''>".
     "<br> Branch Number :<input type='text' name ='Bno' value=''>".
    "<br> Salary : <input type='text' name ='Salary'  value=''>".$subbutton);

}

if ($Innputform){

   $formdetail=$formtop.'<select name="second" style="display: none"> <option value=""></option></select>
<input type="text" name ="third" value="True" style="display: none" ><select name="first" style="display: none">
	 <option value=""></option>	 </select>';
    if ($query==="Insert")
    {  if( mysql_query ("Insert into staff (FName,LName,Sno,Address,Tel_No,Position,Salary,Bno) Values ('".$Fname."','".$Lname."','".$SNO."','".$Address."','".
        $Phone."','".$Position."','".$Salary."','".$Bno."')")){
            printf("Staff Inserted");
        }
    }

  if ($query==="Update"){
      if( mysql_query ("Update staff SET Address='".$Address."', Tel_No='".$Phone."', Position='".$Position."', Salary='".$Salary."' , Bno ='".$Bno."' where Sno='".$wherecond."'" ) ){
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