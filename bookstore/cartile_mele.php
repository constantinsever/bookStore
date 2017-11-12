<?php
session_start();

include 'db_connect.php';
include 'functii.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BibliotecaOnline - Cartile mele</title>
<link href="code/css.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div class="search_layer">
  <table width="100%" border="0" cellpadding="5" cellspacing="2">
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold"><table width="100%" border="0">
        <tr>
          <td width="34%" align="center" valign="top"><a href="index.php"><img src="images/book.png" width="154" height="100" border="0" /></a></td>
          <td width="40%" align="left"><span class="style2">Biblioteca online </span></td>
          <td width="26%" colspan="2" align="left" valign="middle">
		 <?php
  	       tiparire_linkuri();
 	    ?>
 	  </td>
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
      <td width="68%" colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold"><input type="submit" class="arial_bold" value="Afisare rezultate" style="width:180px"/>      </td>
    </tr>
    </form>
    <tr>
      <td colspan="4" align="center" valign="middle" >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center" valign="middle" class="arial_bold" >
	  <?php
	  
		if (!isset($_SESSION['AUTH_USERNAME'])) 
         echo "Nu sunteti autentificat, va rugam sa va autentificati."; 

	   else
	   	
       {	  
	          $username = $_SESSION['AUTH_USERNAME'];
	        
			  $con = connect_to_db();
			  
			  if ( $con)
			   { 
		
			   $sql  = "SELECT * FROM carti WHERE cititor='$username';"; // pt determinarea numarului total de inregistrari
			   $res =  mysqli_query($con,$sql);
			   $num_books = mysqli_num_rows($res);
				   
			   if ($num_books == 0)
				echo '<br><br>Nu aveti carti de returnat. Chill.<br><br>';
			   else 
				{
				 echo '<br><br>';
				 echo '<table  border="0" cellspacing="10" width="100%" cellspacing="0" cellpadding="10" >';
		
				 
				  while ($row = mysqli_fetch_assoc($res))
				   {
					  echo '<tr>';		   
					  echo '<td align="center" class="arial_bold" ><a href="show_book.php?book_id=' . $row['book_id']. '"><img src="images/poze_coperti/uploads/' . $row['poza_coperta']. '" width="90" height="120"></a><br></td>';
					  echo '<td>'.$row['autor']. "<br><br>". $row['titlu']. '</td>';
					  echo '<td>De returnat pana la data de : '.$row['disponibila_de_la']. '<br></td>';
					  
				  
					  echo '</tr>';
				  
				   }; //while
				  
				   echo ' </table>';
		
				 }; //else
				
			   }; //$con
	    }
	  
	  ?>  <br><br>    </td>
    </tr>
  </table>
</div>
</body>
</html>
