<?php
session_start();
include 'functii.php';
include 'db_connect.php';	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Proiect biblioteca - Statistici</title>
<link href="code/css.css" rel="stylesheet" type="text/css" />


<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	left:0px;
	top:100px;
	width:100%;
	height:50px;
	z-index:3;
	background-color: #006699;
}
.style3 {font-size: medium}
-->
</style>
</head>

<body>
<div class="search_layer">
  <table width="100%" border="0" cellpadding="5" cellspacing="2">
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold"><table width="100%" border="0">
        <tr>
          <td width="34%" align="center" valign="top"><a href="index.php"><img src="images/book.png" width="154" height="100" border="0" /></a></td>
          <td width="40%" align="left"><span class="style2">Biblioteca online </span></td>
          <td width="26%" colspan="2" align="left" valign="middle"><p>
            <?php
  	       tiparire_linkuri();
 	    ?>
          </p></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold">&nbsp;</td>
    </tr>
    <form action="afisare_carti.php" method="GET">
      <tr>
        <td width="22%" align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold">Cautare</td>
        <td width="44%" align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold">&nbsp;
            <input name="criteriu" type="text" class="arial_normal" style="width:300px"/></td>
        <td width="68%" colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold"><input name="submit" type="submit" class="arial_bold" style="width:180px" value="Afisare rezultate"/>
        </td>
      </tr>
    </form>
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" nowrap="nowrap" class="arial_normal">
	  
	  <?php
	   echo "<b>Statici BibliotecaOnline la data de : ".date("d-m-Y")."</b><br><br>";
	   if ( (isset($_SESSION["AUTH_USERTYPE"])) && ($_SESSION["AUTH_USERTYPE"] == "admin"))
  		{
		
		  $con = connect_to_db();

          if ( $con)
          { 
		
			 $sql  = "select distinct locatie from carti;"; 
  		      $res =  mysqli_query($con,$sql);
 			 echo "<br><b>Locatii din Bucuresti: <br></b>";
			  while ($row = mysqli_fetch_assoc($res))
		     {
			   echo $row['locatie'] ."<br>";
		   
			  };
	
			 $sql  = "SELECT * FROM carti;"; 
			   $res =  mysqli_query($con,$sql);
			 $num_books = mysqli_num_rows($res);
			 
			 echo "<br><b>Total carti in biblioteca : ". $num_books . "<br></b>"; 

 
  			 $sql  = "select * from carti group by cereri order by cereri desc limit 3;"; 
  		      $res =  mysqli_query($con,$sql);
 			 echo "<br><b>Cele mai cerute carti : <br></b>";
			  while ($row = mysqli_fetch_assoc($res))
		     {
			   echo $row['autor'] ." - ".$row['titlu']. " - ceruta de ". $row['cereri']." ori.<br>";
		   
			  };
			 
			 
			$sql  = "SELECT * FROM carti WHERE cititor <>'';"; 
			   $res =  mysqli_query($con,$sql);
			 $num_books_imprumutate = mysqli_num_rows($res);

	        echo "<br><b>Total carti imprumutate : ". $num_books_imprumutate . "<br></b>"; 
			 
			 $carti_disponibile =  $num_books - $num_books_imprumutate;
			 
			echo "<br><b>Total carti disponibile  : ". $carti_disponibile . "<br></b>";  
			
			$sql  = "SELECT * FROM utilizatori where usertype='user';"; 
			   $res =  mysqli_query($con,$sql);
			 $num_users = mysqli_num_rows($res);
			 
		     echo "<br><b>Total utilizatori  : ". $num_users . "<br></b>"; 
			 
			 
			 
			 
			  $sql  = "select * from utilizatori group by carti_imprumutate order by carti_imprumutate desc limit 3;"; 
  		      $res =  mysqli_query($con,$sql);
 			 echo "<br><b>Cei mai activi useri : <br></b>";
			  while ($row = mysqli_fetch_assoc($res))
		     {
			   echo $row['fullname'] ." (".$row['username']. ")  a imprumutat ". $row['carti_imprumutate']." carti.<br>";
		   
			  };
			 
           }; //con		 
		 
		 	 
		 
		 
		
		}; //admin
	  
	  
	  ?>
	  
	  
	  
	  
	  
	  
	  
	   </td>
    </tr>
  </table>
</div>
</body>
</html>
