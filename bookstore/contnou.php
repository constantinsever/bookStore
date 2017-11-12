<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BibliotecaOnline - Cont nou</title>
<link href="code/css.css" rel="stylesheet" type="text/css" />


<script language="JavaScript">

 function validare(){
 
 if ( ( document.getElementById('fullname').value == "") ||
      ( document.getElementById('username').value == "") ||
      ( document.getElementById('password').value == "") ||
      ( document.getElementById('password2').value == "") ||
	  ( document.getElementById('email').value == "") )
	 
	 {
	  alert("Va rugam sa completati toate campurile")  
	  return;
	 };

  if ( ( document.getElementById('password').value) != ( document.getElementById('password2').value) )
	 
	 {
	  alert("Parola trebuie sa fie identica in cele doua campuri.")  
	  return;
	 };


 
  document.forms[1].submit()
 
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
          <td width="26%" colspan="2" align="left" valign="middle"><p><a href="javascript: void(0)" onclick="document.location=&quot;login.php&quot;">Intra in cont<br />
          </a><a href="javascript: void(0)" onclick="document.location=&quot;contnou.php&quot;">Cont nou</a></p></td>
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
        <td width="34%" colspan="2" align="center" valign="middle" nowrap="nowrap" bgcolor="#E6E6E6" class="arial_bold"><input name="submit" type="submit" class="arial_bold" style="width:180px" value="Afisare rezultate"/>
        </td>
      </tr>
    </form>
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" ><table width="200" border="1" cellpadding="5" cellspacing="0" bordercolor="#999999">
        <tr>
          <td bgcolor="#CCCCCC" class="arial_bold">Creare cont </td>
        </tr>
        <tr>
          <td><form action="contnou_exec.php" method="POST">
            <table width="451" height="158" border="0" cellpadding="10">
              <tr>
                <td width="136" nowrap="nowrap" class="arial_normal">Numele complet </td>
                <td width="153" nowrap="nowrap"><input name="fullname" type="text" id="fullname"  /></td>
                <td width="91" nowrap="nowrap">&nbsp;</td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="arial_normal">Nume utilizator</td>
                <td nowrap="nowrap"><input name="username" type="text" id="username" /></td>
                <td nowrap="nowrap">&nbsp;</td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="arial_normal">Parola</td>
                <td nowrap="nowrap"><input name="password" type="password" id="password" /></td>
                <td nowrap="nowrap">&nbsp;</td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="arial_normal">Parola din nou </td>
                <td nowrap="nowrap"><input name="password2" type="password" id="password2" /></td>
                <td nowrap="nowrap">&nbsp;</td>
              </tr>
              <tr>
                <td nowrap="nowrap" class="arial_normal">Adresa de email </td>
                <td nowrap="nowrap"><input name="email" type="text" id="email"  /></td>
                <td align="center" nowrap="nowrap"><a href="javascript: void(0)" onclick = "validare()">Creare cont </a></td>
              </tr>
            </table>
          </form></td>
        </tr>
      </table>
          <br />
          <br />
      </td>
    </tr>
  </table>
</div>
</body>
</html>
