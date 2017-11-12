<?php
session_start();
include 'db_connect.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Proiect biblioteca - Gestiune cont</title>
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
			    echo '<a href="javascript: void(0)" onclick="document.location=&quot;gestiune_cont.php&quot;">Gestiune cont</a><br>';
  		        echo '<a href="javascript: void(0)" onclick="document.location=&quot;cartile_mele.php&quot;">Cartile mele</a><br>';
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
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold">Cautare</td>
      <td align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold">&nbsp;
          <input name="criteriu" type="text" class="arial_normal" style="width:300px"/></td>
      <td colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold"><input type="submit" class="arial_bold" value="Afisare rezultate" style="width:180px"/>      </td>
    </tr>
    
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold">&nbsp;</td>
    </tr>
    <tr>
      <td height="213" colspan="4" align="center" valign="top" class="arial_bold">
	  
	  <table  border="1" cellpadding="5" cellspacing="0" bordercolor="#999999">
          <tr>
            <td bgcolor="#CCCCCC">Gestiune cont </td>
          </tr>
          <tr>
            <td>
			
			  <?php	  
			  
			  
				if (!isset($_SESSION["AUTH_USERNAME"]))
				   echo "<br>Nu puteti accesa aceasta pagina, va rugam sa va autentificati.<br>";   
				  else
				  {
				   $con = connect_to_db();
				   if ( $con)
				   
				   { 
					  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING) ;
					  $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING) ;
					  $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING) ;
					  $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING) ;
				   
                      $sql  = "update utilizatori set fullname='$fullname', password='$password', email='$email' WHERE username='$username';"; 

                      $res =  mysqli_query($con,$sql);
		  		      echo "<br>Felicitari, contul a fost actualizat.<br><br>";
                       

                    }; //$con
					
				}; //autentificat	

		    ?>			</td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
</body>
</html>
