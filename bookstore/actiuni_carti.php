<?php
session_start();
include 'functii.php';
include 'db_connect.php';
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BibliotecaOnline - Management carti</title>
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
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold">
	  
	    <?php
		  $con = connect_to_db();  
		  if ( $con)
		   { 
  		    if ( (isset($_SESSION["AUTH_USERTYPE"])) && ($_SESSION["AUTH_USERTYPE"] == "admin"))
			 {
			  $book_id = filter_var($_GET['book_id'], FILTER_SANITIZE_STRING) ;
			  $action = filter_var($_GET['action'], FILTER_SANITIZE_STRING) ;
			  
			  $sql  = "SELECT * FROM carti WHERE book_id='$book_id';";
              $res =  mysqli_query($con,$sql);
	          $num_books = mysqli_num_rows($res);
	   
			  if ($num_books == 0)
			   echo '<br><br>Nu s-au gasit carti care sa corespunda acestei cautari.<br>Actiunea nu a fost executata';
			  else 
			  {
			   $row = mysqli_fetch_assoc($res);
 			   if ($action=="STERGERE")
			   {
			    $sql1="DELETE FROM carti WHERE book_id='$book_id';";
				
				//stergerea este inactiva ...
			    //mysqli_query($con,$sql1);
				//unlink("images/poze_coperti/uploads/".$row['poza_coperta']);
			     echo '<br><br>Cartea a fost stearsa din baza de date, si poza de pe disc.';
				};

			   if ($action=="DEZACTIVARE")
			   {
			    $sql1="UPDATE carti SET activa='NU' WHERE book_id='$book_id';";
			    mysqli_query($con,$sql1);
				 echo '<br><br>Cartea a fost dezactivata, si nu va mai apare la cautari.<br><br>';
				  echo 'Puteti vizualiza aceasta carte apasand <a href="javascript: void(0)" onclick="document.location=&quot;show_book.php?book_id='.$row['book_id'].'&quot;">aici</a>.';
				};
				
				
			   if ($action=="ACTIVARE")
			   {
			    $sql1="UPDATE carti SET activa='DA' WHERE book_id='$book_id';";
			     mysqli_query($con,$sql1);
				echo '<br><br>Cartea a fost activata, si va apare la cautari. <br><br>';
			    echo 'Puteti vizualiza aceasta carte apasand <a href="javascript: void(0)" onclick="document.location=&quot;show_book.php?book_id='.$row['book_id'].'&quot;">aici</a>.';
				};
				
			   if ($action=="RETURNARE")
			   {
			    $sql1="UPDATE carti SET cititor='', disponibila_de_la='".date("d-m-Y")."' WHERE book_id='$book_id';";
			     mysqli_query($con,$sql1);
				echo '<br><br>Cartea a fost returnata, si apare ca disponibila. <br><br>';
			    echo 'Puteti vizualiza aceasta carte apasand <a href="javascript: void(0)" onclick="document.location=&quot;show_book.php?book_id='.$row['book_id'].'&quot;">aici</a>.';
				};
				
			   if ($action=="IMPRUMUTARE")
			   {
			    $cititor = filter_var($_GET['cititor'], FILTER_SANITIZE_STRING) ;
				$data_returnare = filter_var($_GET['data_returnare'], FILTER_SANITIZE_STRING) ;
				
			  
			    $sql1="UPDATE carti SET cititor='$cititor', disponibila_de_la='$data_returnare', cereri=cereri+1 WHERE book_id='$book_id';";
				 mysqli_query($con,$sql1);
				 
			    $sql1="UPDATE utilizatori SET carti_imprumutate=carti_imprumutate+1 WHERE username='$cititor';";

			     mysqli_query($con,$sql1);
				echo '<br><br>Cartea a fost acordata cititorului, si apare ca indisponibila disponibila.<br><br>';
			    echo 'Puteti vizualiza aceasta carte apasand <a href="javascript: void(0)" onclick="document.location=&quot;show_book.php?book_id='.$row['book_id'].'&quot;">aici</a>.';
				};			   
			   
			  };
			  
			 }
			 else
			  echo 'Nu puteti accesa aceasta pagina, va rugam sa va autentificati cu drepturi de Administrator.<br><br>';


			
		   }; //$con
		  
	  ?>      
	  
	  
	  
	   </td>
    </tr>
  </table>
</div>
</body>
</html>
