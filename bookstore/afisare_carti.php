<?php
session_start();

include 'db_connect.php';
include 'functii.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BibliotecaOnline - Afisare carti</title>
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
      <td colspan="4" align="center" valign="middle" >
	  <?php
	  $con = connect_to_db();
	  
	  $results_per_page = 8;
	  
	  if (isset($_GET["pagina"])) 
	    $pagina  = $_GET["pagina"]; 
	  else 
	    $pagina = 1; // pagina curenta de afisat.
		
 	  $start_from = ($pagina-1) * $results_per_page;
 

      if ( $con)
       { 
       $criteriu = filter_var($_GET['criteriu'], FILTER_SANITIZE_STRING) ;
	   

	   // pt determinarea numarului total de inregistrari
	    if ( (isset($_SESSION["AUTH_USERTYPE"])) && ($_SESSION["AUTH_USERTYPE"] == "admin"))
	    $sql  = "SELECT * FROM carti WHERE titlu LIKE '%$criteriu%' OR autor LIKE '%$criteriu%';"; 	   // daca este admin, se vor numara inclusiv cartile dezactivate
	   else
	    $sql  = "SELECT * FROM carti WHERE (titlu LIKE '%$criteriu%' OR autor LIKE '%$criteriu%') AND (activa='DA');"; 	   // daca nu este admin, nu se vor numara inclusiv cartile dezactivate
	   
	   
	   $res =  mysqli_query($con,$sql);
	   $num_books = mysqli_num_rows($res);
	   
	   if ( (isset($_SESSION["AUTH_USERTYPE"])) && ($_SESSION["AUTH_USERTYPE"] == "admin"))
        $sql  = "SELECT * FROM carti WHERE titlu LIKE '%$criteriu%' OR autor LIKE '%$criteriu%' ORDER BY book_id DESC LIMIT $results_per_page OFFSET $start_from"; // pentru paginare
	   else
        $sql  = "SELECT * FROM carti WHERE (titlu LIKE '%$criteriu%' OR autor LIKE '%$criteriu%') AND (activa='DA') ORDER BY book_id DESC LIMIT $results_per_page OFFSET $start_from"; // pentru paginare


       $res =  mysqli_query($con,$sql);
	   
	   
	   if ($num_books == 0)
	    echo '<br><br><span class="arial_bold">Nu s-au gasit carti care sa corespunda acestei cautari.</span>';
   	   else 
	    {
		
		
		
 		 echo '<br><br>';
		 echo '<table  border="0" cellspacing="10" width="100%" cellspacing="0" cellpadding="10" >';
		 echo '<tr>';
		 $current_book = 0; // cartea curenta afisata pe linie
		  while ($row = mysqli_fetch_assoc($res))
		   {
		   
		   $color = "white";
            if ($row['cititor'] !="")
			  $color="#ffb3b3"; // este imprumutata
            if ($row['activa'] !="DA")
			  $color="#E5E7E9"; // este dezactivata
			  
		   
            if ($current_book < 3)
			
		     { 
			  echo '<td align="center" class="arial_bold"  bgcolor="'.$color.'"><a href="show_book.php?book_id=' . $row['book_id']. '"><img src="images/poze_coperti/uploads/' . $row['poza_coperta']. '" width="100" height="140"></a><br><br>';
			  echo $row['autor']. "<br>". $row['titlu']. '</td>';
			   $current_book ++ ;
              }

 		    else // s-a ajuns la capatul liniei din tabel, se va printa ultima coperta de pe linie
			 { 
			  echo '<td align="center"  class="arial_bold" bgcolor="'.$color.'"><a href="show_book.php?book_id=' . $row['book_id']. '"><img src="images/poze_coperti/uploads/' . $row['poza_coperta']. '" width="100" height="140"></a><br><br>';
			  echo $row['autor']. "<br>". $row['titlu']. '</td></tr>';
			   $current_book = 0 ;
			   echo '<tr>'; // incepere linie noua
              };
		    
		    };
		 if ($current_book < 3) // nu s-a terminat linia din tabel
		  {
		   for ($i = $current_book; $i <= 3; $i++)
		    echo '<td align="center" class="arial_bold">&nbsp;</td>'; // completare linie
		     
		   }; 
		  
		  echo '</tr>';
		  
		echo "<tr>"; // paginare
			   $num_pages = 1;
			   if ($num_books > $results_per_page) 
			   {
				 if (($num_books % $results_per_page) == 0)
				  $num_pages = floor($num_books/$results_per_page) ;
				  else
				  $num_pages = floor($num_books/$results_per_page) + 1;
				};
				
				
				
				
			//	if ($num_pages > 1) 
				 {
				  echo '<td colspan="4" class="arial_bold" align="right">Au fost gasite '.$num_books.' carti. Salt rapid la pagina : ';
				  for ($i = 1; $i <= $num_pages; $i++)
				   {
				    echo '<a  href="javascript: void(0)" onclick=document.location="afisare_carti.php?criteriu='.$criteriu.'&pagina='.$i.'">&nbsp;'.$i.'&nbsp;</a>';
                    };   
				  }; 
			   echo  '</td></tr>';
	  
		  
		   echo ' </table>';

		 }; //else
		
	   }; //$con
	  
	  ?>      </td>
    </tr>
  </table>
</div>
</body>
</html>
