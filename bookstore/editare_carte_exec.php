<?php
session_start();

include 'db_connect.php';
include 'functii.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BibliotecaOnline - Editare carte</title>
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
          <td width="26%" colspan="2" align="left" valign="middle"><p>
              <td width="26%" colspan="2" align="left" valign="middle">
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
        <td width="34%" colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold"><input name="submit" type="submit" class="arial_bold" style="width:180px; " value="Afisare rezultate"/>        </td>
      </tr>
    </form>
    <tr>
      <td colspan="4" align="center" valign="middle" >&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center" valign="middle" class="arial_bold">
	  
	  <?php
 	  $con = connect_to_db();
      if ( $con)
      { 

      if (isset($_SESSION["AUTH_USERTYPE"])) // user logat  
	   if ( $_SESSION["AUTH_USERTYPE"] == "admin") //  adaugare carte, numai daca este admin
        {
        $book_id = filter_var($_POST['book_id'], FILTER_SANITIZE_STRING);
		$autor = filter_var($_POST['autor'], FILTER_SANITIZE_STRING);
		$titlu = filter_var($_POST['titlu'], FILTER_SANITIZE_STRING);
		$link  = filter_var($_POST['link'], FILTER_SANITIZE_STRING);
		$locatie = filter_var($_POST['locatie'], FILTER_SANITIZE_STRING);
		
		 $sql  = "UPDATE carti SET autor='$autor',titlu='$titlu',link_sursa='$link',locatie='$locatie' WHERE book_id='$book_id';";

		 mysqli_query($con,$sql);
		
		 echo 'Cartea a fost modificata cu succes.<br>';
		 echo 'Puteti vizualiza aceasta inregistrare apasand <a href="javascript: void(0)" onclick="document.location=&quot;show_book.php?book_id='.$book_id.'&quot;">aici</a>.';


 		}; //admin

		 if (!isset($_SESSION["AUTH_USERTYPE"]) || $_SESSION["AUTH_USERTYPE"] != "admin") 
				  echo '<br><br>Aceasta pagina este disponibila numai pentru administratori.<br><br>';


       }; //con

	        

	  ?>    
	  <br><br>  
	  </td>
    </tr>
  </table>
</div>
</body>
</html>
