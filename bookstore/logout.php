<?php
session_start();
session_unset();     
session_destroy();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BibliotecaOnline - logout</title>
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
          <td width="26%" colspan="2" align="left" valign="middle"><p><a href="javascript: void(0)" onclick="document.location=&quot;login.php&quot;">Intra in cont<br />
          </a><a href="javascript: void(0)" onclick="document.location=&quot;contnou.php&quot;">Cont nou</a></p></td>
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
      <td width="34%" colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold">
        <input type="submit" class="arial_bold" value="Afisare rezultate" style="width:180px"/>      </td>
	  <td></td>
    </tr>
	</form>
    
      <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold">&nbsp;</td>
    </tr>
    <form action="afisare_carti.php" method="GET">
	</form>
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold">Sesiunea a fost inchisa, la revedere.  </td>
    </tr>
  </table>
</div>
</body>
</html>
