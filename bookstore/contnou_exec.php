<?php
include 'db_connect.php';
include 'functii.php';

$con = connect_to_db();



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BibliotecaOnline - Cont nou</title>
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
  	       tiparire_linkuri();
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
      <td height="213" colspan="4" align="center" valign="middle" class="arial_bold">
	  
	  <table  border="1" cellpadding="5" cellspacing="0" bordercolor="#999999">
          <tr>
            <td bgcolor="#CCCCCC">Creare cont </td>
          </tr>
          <tr>
            <td>
			
			<?php
			
			   function generateRandomString() {
  			    $length = 40;
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$randomString = '';
				for ($i = 0; $i < $length; $i++) {
					$randomString .= $characters[rand(0, $charactersLength - 1)];
				}
				return $randomString;
			   }
			   
			  		
			
			if ( $con)
			 { 
			  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING) ;
			  $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING) ;
			  $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING) ;
			  $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING) ;
			  
			  
			  $sql  = "select * from utilizatori where username='$username';"; 
              $res =  mysqli_query($con,$sql);
              if(mysqli_num_rows($res) != 0 ) // numele de utilizator exista 		  
 		 	   die("Exista deja un utilizator cu numele <b>$username </b>.");
		
		      $sql  = "select * from utilizatori where email='$email';"; 
              $res =  mysqli_query($con,$sql);
              if(mysqli_num_rows($res) != 0 ) // adresa de email a mai fost folosita
			   die("Exista deja un utilizator cu emailul <b>$email</b>.");

		  
	
			   $code = generateRandomString();
			   if (sendMail($email,$code))
                {
			     echo "<br>Un cod de verificare a fost trimis pe adresa <i>$email</i>.<br>";
			     echo "<br>Folositi codul pentru a va activa contul la prima autentificare.<br><br>";
				 $sql  = "insert into utilizatori values('user', 'NO', '$fullname', '$username', '$password', '$email', '$code','0');"; 

                 $res =  mysqli_query($con,$sql);
				 }
				else
				  echo "<br>Nu s-a putut trimite mailul de verificare la adresa $email.<br>Contul nu a fost creat.<br><br>";


              }; //$con

		    ?>			</td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
</body>
</html>
