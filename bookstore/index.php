<?php
session_start();
include 'functii.php';
include 'db_connect.php';
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BibliotecaOnline - Home</title>
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
      <td width="34%" colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold">
        <input type="submit" class="arial_bold" value="Afisare rezultate" style="width:180px"/>      </td>
    </tr>
	</form>
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap">
	  
	    <?php
	  $con = connect_to_db();
	  
	
      if ( $con)
       { 

	   $sql  = "SELECT * FROM carti ORDER BY data_adaugare DESC limit 8;"; // se vor afisa ultimele 8 carti adaugate, cate 4 pe linie
	   $res =  mysqli_query($con,$sql);
	     
	   echo '<br><br><span class="arial_bold">Noutati la Biblioteca Online</span>';
	    echo '<br><br>';
		 echo '<table  border="0" cellspacing="10" width="100%" cellspacing="0" cellpadding="10" >';
		 echo '<tr>';
		 $current_book = 0; // cartea curenta afisata pe linie
		  while ($row = mysqli_fetch_assoc($res))
		   {
            if ($current_book < 3)
			
		     { 
			  echo '<td align="center" class="arial_bold"><a href="show_book.php?book_id=' . $row['book_id']. '"><img src="images/poze_coperti/uploads/' . $row['poza_coperta']. '" width="100" height="140"></a><br><br>';
			  echo $row['autor']. "<br>". $row['titlu']. '</td>';
			   $current_book ++ ;
              }

 		    else // s-a ajuns la capatul liniei din tabel, se va printa ultima coperta de pe linie
			 { 
			  echo '<td align="center"  class="arial_bold"><a href="show_book.php?book_id=' . $row['book_id']. '"><img src="images/poze_coperti/uploads/' . $row['poza_coperta']. '" width="100" height="140"></a><br><br>';
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
		  
		  
		   echo ' </table>';

		
	   }; //$con
	  
	  ?>      
	  
	  
	  
	   </td>
    </tr>
  </table>
</div>
</body>
</html>
