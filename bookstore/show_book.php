<?php
session_start();
include 'db_connect.php';
include 'functii.php';

 $book_id = filter_var($_GET['book_id'], FILTER_SANITIZE_STRING) ;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Proiect biblioteca - Vizualizare carte</title>
<link href="code/css.css" rel="stylesheet" type="text/css" />

<script language="javascript">
function confirmare(action){

if (action == "STERGERE")
 { 
  mesaj = "Sunteti sigur ca doriti stergerea acestei carti ?";
  mesaj = mesaj + "\nAceasta actiune ca sterge inregistrarea si fisierul de pe disc.";
  if (confirm(mesaj) == true)
   document.location="actiuni_carti.php?action=STERGERE&book_id=<?php echo $book_id ?>";
  };
 
 
if (action == "ACTIVARE")
 {
  mesaj = "Sunteti sigur ca doriti activarea acestei carti ?";
  mesaj = mesaj + "\n Cartea va deveni accesibila pentru cautari/imprumutari.";
  
  if (confirm(mesaj) == true)
   document.location="actiuni_carti.php?action=ACTIVARE&book_id=<?php echo $book_id ?>";
  };
 

if (action == "DEZACTIVARE")
 {
  mesaj = "Sunteti sigur ca doriti dezactivarea acestei carti ?";
  mesaj = mesaj + "\n Cartea va deveni inaccesibila pentru cautari/imprumutari.";
  
  if (confirm(mesaj) == true)
   document.location="actiuni_carti.php?action=DEZACTIVARE&book_id=<?php echo $book_id ?>";
  };
 
 
 if (action == "RETURNARE")
 {
  mesaj = "Sunteti sigur ca doriti returnarea acestei carti ?";
  
  if (confirm(mesaj) == true)
   document.location="actiuni_carti.php?action=RETURNARE&book_id=<?php echo $book_id ?>";
  };
 
 
};

</script>



</head>

<body>
<div class="search_layer">
  <table width="100%" border="0" cellpadding="5" cellspacing="2">
    <tr>
      <td width="134%" colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold"><table width="100%" border="0">
        <tr>
          <td width="34%" align="center" valign="top"><a href="index.php"><img src="images/book.png" width="154" height="100" border="0" /></a></td>
          <td width="40%" align="left"><span class="style2">Biblioteca online </span></td>
          <td width="26%" colspan="2" align="left" valign="middle">
		 <?php
  	       tiparire_linkuri();
 	    ?>	  </td>
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
      <td width="68%" colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold"><input type="submit" class="arial_bold" value="Afisare rezultate" style="width:180px"/>      </td>
    </tr>
    </form>    
	
	<tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold">&nbsp;</td>
    </tr>

    <tr>
      <td colspan="4" align="center" valign="middle" >
	  <?php
	  $con = connect_to_db();

      if ( $con)
       { 
        $book_id = filter_var($_GET['book_id'], FILTER_SANITIZE_STRING) ;
        $sql  = "SELECT * FROM carti WHERE book_id='$book_id';";

        $res =  mysqli_query($con,$sql);
	    $num_books = mysqli_num_rows($res);
	   
	    if ($num_books == 0)
	     echo '<br><br><span class="arial_bold">Nu s-au gasit carti care sa corespunda acestei cautari.</span>';
   	    else 
	    {
		 $row = mysqli_fetch_assoc($res);
		 // copiere descriere de pe www.elefant.ro
		 $html = file_get_contents($row['link_sursa']);
         $start_pos = strpos($html,"Prezentare</span>");
		 $start_pos = $start_pos+10; // se elimina "Prezentare"
		 $end_pos = strpos($html,"Produs publicat",$start_pos);
         $prezentare = substr($html,$start_pos,$end_pos - $start_pos);
		 
          echo '<table  border="0" cellspacing="10" width="100%" cellpadding="10" >';
  		  echo '<tr>';
		  $color = "white";
		  if ($row['activa'] !="DA")
			  $color="#E5E7E9"; // este dezactivata
		  if ($row['cititor'] !="")
			  $color="#ffb3b3"; // este imprumutata
			  
 		  echo '<td valign="top" align="center" rowspan="2" bgcolor="'.$color.'" ><img src="images/poze_coperti/uploads/' . $row['poza_coperta']. '" width="200" height="300"></td>';
		  echo '<td align="left" class="arial_bold">'.$row['autor'] .'<br><br>';
		  echo $row['titlu'] .'</td></tr>';
  		  
		  echo '<tr>'; 
  		   echo '<td align="left" ><span class="arial_bold">Prezentare</span><br>';
		   echo '<p align="justify" class="arial_normal">'.strip_tags($prezentare).'</p></td>';
  		  echo '</tr>';

  		  echo '<tr>'; 

		   if ($row['cititor'] != "") // este imprumutata
  		    {
			 echo '<td colspan="2" align="center" bgcolor="#ffb3b3"><span class="arial_bold" >Aceasta carte este indisponibila momentan.  ';
			 echo 'Disponibila incepand cu data de '; 
			 echo $row['disponibila_de_la'];
			 echo '</span></td>';
			 }
			else
	       {
			 echo '<td colspan="2" align="center" bgcolor="#b3ffd9"><span class="arial_bold" >Aceasta carte este disponibila momentan la locatia ' .$row['locatie']. '.</span>';
			 echo '</td>';
			 }
	
          echo '</tr>';  		  


          $sql  = "UPDATE carti set vizite=vizite+1 WHERE book_id='$book_id';"; // actualziare numar vizite 
          $res =  mysqli_query($con,$sql);  

	       if (isset($_SESSION["AUTH_USERTYPE"])) // user logat  
			 if ( $_SESSION["AUTH_USERTYPE"] == "admin") // adaugare butoane specifice administratorului, intr-o noua linie din tabel
  		    {
   		     echo '<tr> '; 
			 echo '<td colspan="2" align="center">';
			 echo '<table  width="100%"><tr>';
			  if ($row['cititor'] != "")
			   {
 			    echo '<td align="center" class="arial_bold" >Cititor : '.$row['cititor'].'</td>';
			    echo '<td align="center"><a href="javascript: void(0)" onclick=confirmare("RETURNARE")>Returnare</a></td>';
				}
			  else 
   	           echo '<td align="center"><a href="javascript: void(0)" onclick=document.location="imprumutare.php?book_id='.$book_id.'">Imprumutare</a></td>';
			  
			  echo '<td align="center"><a href="javascript: void(0)" onclick=document.location="editare_carte.php?book_id='.$book_id.'">Editare</a></td>';
			  
			  if ($row['activa'] == "DA")
			   echo '<td align="center"><a href="javascript: void(0)" onclick=confirmare("DEZACTIVARE")>Dezactivare temporara</a></td>';
			  else
			   echo '<td align="center"><a href="javascript: void(0)" onclick=confirmare("ACTIVARE")>Activare</a></td>';		   
			  
			  echo '<td align="center"><a href="javascript: void(0)" onclick=confirmare("STERGERE")>Stergere totala</a></td>';
			  echo '</tr></table>';
			 echo '</td>';
 		     echo '</tr>';			 
			 }
			 
		  echo '</table>';
		  
		 };
	    };
	  ?>      
	  </td>
    </tr>
  </table>
</div>
</body>
</html>
