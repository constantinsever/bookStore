<?php
include 'db_connect.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BibliotecaOnline - Activare cont</title>
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
      <td width="100%" colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold"><table width="100%" border="0">
        <tr>
          <td width="34%" align="center" valign="top"><a href="index.php"><img src="images/book.png" width="154" height="100" border="0" /></a></td>
          <td width="40%" align="left"><span class="style2">Biblioteca online </span></td>
          <td width="26%" colspan="2" align="left" valign="middle"><p>
              <?php 
		  if (isset($_SESSION["AUTH_USERNAME"]))
		   { 
		     echo "Bun venit ".$_SESSION['AUTH_FULLNAME'] . "<br>";
			 if ( $_SESSION["AUTH_USERTYPE"] == "admin")
			  {
			    echo '<a href="javascript: void(0)" onclick="document.location=&quot;adaugare_carte.php&quot;">Adaugare carte</a><br>';
  		        echo '<a href="javascript: void(0)" onclick="document.location=&quot;manage_users.php&quot;">Gestiune useri</a><br>';
				echo '<a href="javascript: void(0)" onclick="document.location=&quot;statistici.php&quot;">Statistici</a><br>';
  			    echo '<a href="javascript: void(0)" onclick="document.location=&quot;rapoarte.php&quot;">Rapoarte</a><br>';

			   }
			  else //user normal
			  {
			    echo '<a href="javascript: void(0)" onclick="document.location=&quot;manage_books.php&quot;">Gestiune cont</a><br>';
  		        echo '<a href="javascript: void(0)" onclick="document.location=&quot;manage_users.php&quot;">Cartile mele</a><br>';
			   };
			 // logout pt toata lumea, indiferent de tipul contului   	
			 echo '<a href="javascript: void(0)" onclick="document.location=&quot;logout.php&quot;">Iesire</a>';
		    } // nu este logat
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
      <td colspan="4" align="left" valign="middle" nowrap="nowrap" bgcolor="#F2F2F2" class="arial_bold">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold">Cautare</td>
      <td align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold">&nbsp;
          <input name="criteriu" type="text" class="arial_normal" style="width:300px"/></td>
      <td colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold"><input type="submit" class="arial_bold" value="Afisare rezultate" style="width:180px"/>      </td>
    </tr>
    

	<form action="afisare_carti.php" method="GET">
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold">&nbsp;</td>
      </tr>
	</form>
	
	
    <tr>
      <td height="213" colspan="4" align="center" valign="middle" class="arial_bold">
	  
	  <table  border="1" cellpadding="5" cellspacing="0" bordercolor="#999999">
          <tr>
            <td bgcolor="#CCCCCC">Activare cont</td>
          </tr>
          <tr>
            <td><br />
			
			<?php
			$con = connect_to_db();
			if ( $con)
             { 
  			  $code = filter_var($_GET['cod_activare'], FILTER_SANITIZE_STRING) ;
			  $sql  = "select * from utilizatori where activation_code='$code';";

			  $res =  mysqli_query($con,$sql);
			   if(mysqli_num_rows($res) == 0 )
				 echo("Codul introdus este gresit/expirat.");
			   else
				{
		         $sql  = "update utilizatori set enabled='YES' WHERE activation_code='$code';"; 

                 $res =  mysqli_query($con,$sql);
				  echo "<br>Felicitari, contul a fost activat.<br>Va puteti autentifica cu parola aleasa.<br><br>";
				 }
              }; //$con

		    ?>
			<br />			</td>
          </tr>
        </table>		</td>
    </tr>
  </table>
</div>
</body>
</html>
