<?php
session_start();

require('fpdf/fpdf.php');

include 'db_connect.php';
include 'functii.php';

if ( (isset($_SESSION["AUTH_USERTYPE"])) && ($_SESSION["AUTH_USERTYPE"] == "admin"))
  		{
		
		  $con = connect_to_db();

          if ( $con)
          { 
		
		
			$pdf = new FPDF();
	
			$pdf->AddPage();
			
			$pdf->SetFont('Arial','B',14);
			
			$pdf->Cell(100,10,'Biblioteca Online - Raport '. date("d-m-Y"));
			$pdf->ln();


			 $sql  = "SELECT * FROM carti;"; 
			   $res =  mysqli_query($con,$sql);
			 $num_books = mysqli_num_rows($res);
  			 $pdf->SetFont('Arial','B',12);
			  $pdf->Cell(100,10,"Total carti in biblioteca : ". $num_books );
  			 $pdf->ln();


  			 $sql  = "select * from carti group by cereri order by cereri desc limit 3;"; 
  		      $res =  mysqli_query($con,$sql);
  			 $pdf->SetFont('Arial','B',12);
			  $pdf->Cell(100,10,"Cele mai cerute carti : ");
  			 $pdf->ln();
  			 $pdf->SetFont('Arial','',10);

			  while ($row = mysqli_fetch_assoc($res))
		     {

			   $pdf->Cell(100, 5,$row['autor'] ." - ".$row['titlu']. " - ceruta de ". $row['cereri']." ori.");
  			   $pdf->ln();
			  };
 

//////////////////////////////////////

			 
			$sql  = "SELECT * FROM carti WHERE cititor <>'';"; 
			   $res =  mysqli_query($con,$sql);
			 $num_books_imprumutate = mysqli_num_rows($res);
			 
			 $pdf->SetFont('Arial','B',12);
			  $pdf->Cell(100,10,"Total carti imprumutate : ". $num_books_imprumutate);
  			 $pdf->ln();

			 
			 $carti_disponibile =  $num_books - $num_books_imprumutate;
			  $pdf->Cell(100,10,"Total carti disponibile : ". $carti_disponibile);
  			 $pdf->ln();



			
			$sql  = "SELECT * FROM utilizatori where usertype='user';"; 
			   $res =  mysqli_query($con,$sql);
			 $num_users = mysqli_num_rows($res);
			 
			  $pdf->SetFont('Arial','B',12);
			  $pdf->Cell(100,10,"Total utilizatori  : ". $num_users);
  			 $pdf->ln();


			 
			  $sql  = "select * from utilizatori group by carti_imprumutate order by carti_imprumutate desc limit 3;"; 
  		      $res =  mysqli_query($con,$sql);

			  $pdf->Cell(100,10,"Cei mai activi useri : ");
  			  $pdf->SetFont('Arial','',10);
  			  $pdf->ln();

			  while ($row = mysqli_fetch_assoc($res))
		      {
			    $pdf->Cell(100,5,$row['fullname'] ." (".$row['username']. ")  a imprumutat ". $row['carti_imprumutate']." carti");
  			   $pdf->ln();
			 
		   
			  };
			  

			 $pdf->Output();
           }; //con		 
		 
		 	 
		 
		 
		
		}; //admin
	  
	  
	  ?>












	   





























$pdf->Output();
 
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BibliotecaOnline - Rapoarte</title>
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
		  if (isset($_SESSION["AUTH_FULLNAME"])) // user logat
		   { 
		     echo "Bun venit ".$_SESSION['AUTH_FULLNAME'] . "<br>";
			 if ( $_SESSION["AUTH_USERTYPE"] == "admin")
			  {
			    echo '<a href="javascript: void(0)" onclick="document.location=&quot;adaugare_carte.php&quot;">Adaugare carte</a><br>';
  		        echo '<a href="javascript: void(0)" onclick="document.location=&quot;manage_users.php&quot;">Gestiune useri</a><br>';
				echo '<a href="javascript: void(0)" onclick="document.location=&quot;statistici.php&quot;">Statistici</a><br>';
				
			   }
			  else //user normal
			  {
			    echo '<a href="javascript: void(0)" onclick="document.location=&quot;gestiune_cont.php&quot;">Gestiune cont</a><br>';
  		        echo '<a href="javascript: void(0)" onclick="document.location=&quot;cartile_mele.php&quot;">Cartile mele</a><br>';
			   };
			 // logout pt toata lumea, indiferent de tipul contului   	
			 echo '<a href="javascript: void(0)" onclick="document.location=&quot;logout.php&quot;">Iesire</a>';
		    }
			else 
			 {
			  echo '<a href="javascript: void(0)" onclick="document.location=&quot;login.php&quot;">Intra in cont</a><br>
                    <a href="javascript: void(0)" onclick="document.location=&quot;contnou.php&quot;">Cont nou</a>';
			  };
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
      <td colspan="4" align="center" valign="middle" nowrap="nowrap">rezultate cautare </td>
    </tr>
  </table>
</div>
</body>
</html>
