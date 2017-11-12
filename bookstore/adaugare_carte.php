<?php
session_start();
include 'db_connect.php';
include 'functii.php';
	

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BibliotecaOnline - Adaugare carte</title>
<link href="code/css.css" rel="stylesheet" type="text/css" />


<script language="JavaScript">

 function validare(){
 
 if ( ( document.getElementById('titlu').value == "") ||
      ( document.getElementById('autor').value == "") ||
      ( document.getElementById('locatie').value == "") ||
      ( document.getElementById('poza').value == "") ||
	  ( document.getElementById('link').value == "") )
	 
	 {
	  alert("Va rugam sa completati toate campurile")  
	  return;
	 };

 
  onclick=document.forms[1].submit()
 
 };
</script>

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
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" bgcolor="#F2F2F2" class="arial_bold">&nbsp;</td>
    </tr>
    
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold">
	  <?PHP
	  
	   if (isset($_SESSION["AUTH_USERTYPE"])) // user logat  
		 if ( $_SESSION["AUTH_USERTYPE"] == "admin") // afisare forma de adaugare carte, numai daca este admin
  		    {
			?>
			  <table border="1" cellpadding="5" cellspacing="0" bordercolor="#999999">
				  <tr>
					<td bgcolor="#CCCCCC" class="arial_bold">Adaugare carte  </td>
				  </tr>
				  <tr>
					<td>
					<form action="adaugare_carte_exec.php" method="POST" enctype="multipart/form-data">
					<table height="158" border="0" cellpadding="10" cellspacing="5">
					  <tr>
						<td nowrap="nowrap" class="arial_normal">Autor</td>
						<td nowrap="nowrap"><input name="autor" type="text" id="autor"  style="width:300px"/></td>
						</tr>
					  <tr>
						<td nowrap="nowrap" class="arial_normal">Titlu</td>
						<td nowrap="nowrap"><input name="titlu" type="text" id="titlu" style="width:300px"/></td>
						</tr>
					  
					  <tr>
						<td nowrap="nowrap" class="arial_normal">Link sursa </td>
						<td nowrap="nowrap"><input name="link" type="text" id="link" style="width:300px"/></td>
						</tr>
					  <tr>
						<td nowrap="nowrap" class="arial_normal">Locatie</td>
						<td nowrap="nowrap"><input name="locatie" type="text" id="locatie" style="width:300px"/></td>
						</tr>
					  <tr>
						<td nowrap="nowrap" class="arial_normal">Poza coperta </td>
						<td nowrap="nowrap"><input name="poza" type="file" id="poza" /></td>
						</tr>
					  <tr>
						<td colspan="2" align="center" nowrap="nowrap" class="arial_normal"><a href="javascript: void(0)" onClick = "validare()"><hr /><br />Adaugare carte </a></td>
						</tr>
					</table>
					</form>					</td>
				  </tr>
				</table>
				
				<?php
				 }
                 if (!isset($_SESSION["AUTH_USERTYPE"]) || $_SESSION["AUTH_USERTYPE"] != "admin") 
				  echo '<br><br>Aceasta pagina este disponibila numai pentru administratori.<br><br>';
				 ?>
		
	    <br />
		<br />	  </td>
    </tr>
  </table>
</div>
</body>
</html>
