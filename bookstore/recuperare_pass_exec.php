<?php
session_start();
include 'db_connect.php';
include 'functii.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Proiect biblioteca - Recuperare parola</title>
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
 	    ?>  </td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" nowrap="nowrap" class="arial_bold">&nbsp;</td>
    </tr>
    <form action="afisare_carti.php" method="GET">
    <tr>
      <td width="22%" align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold">Cautare</td>
      <td width="44%" align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold">&nbsp;
      <input name="criteriu" type="text" class="arial_normal" style="width:300px"/></td>
      <td width="34%" colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold">
        <input type="submit" class="arial_bold" value="Afisare rezultate" style="width:180px"/>      </td>
    </tr>
	</form>
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold">&nbsp;</td>
    </tr>
    <form action="afisare_carti.php" method="GET">
    </form>
    <tr>
      <td colspan="4" align="center" valign="middle"  class="arial_bold">
	  <?php

	  $con = connect_to_db();
  	  $email = filter_var($_GET['email'], FILTER_SANITIZE_STRING) ;
      $code = "";
      if ( $con)
       { 
        $sql  = "SELECT * FROM utilizatori where email='$email' limit 1;";

        $res =  mysqli_query($con,$sql);
	    $num_rows = mysqli_num_rows($res);
	    if ($num_rows == 0)
	     echo '<br><br><span class="arial_bold">Acest e-mail nu este inregistrat in sistem. <br></span>';
   	    else 
	    {
			 $row = mysqli_fetch_assoc($res);
			 $code = $row['password'];
	
		
			 if (sendMail($email,$code))
			  echo "Parola dvs a fost trimisa pe mailul $email. <br><br>";
			 else
			 echo "<br>Nu s-a putut trimite mailul de verificare la adresa $email.<br> Va rugam sa verificati.<br>";
			 
		  };
		
		};
		
	   ?>
	   
	   </td>
    </tr>
  </table>
</div>
</body>
</html>
