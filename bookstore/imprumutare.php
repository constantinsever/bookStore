<?php
session_start();
include 'db_connect.php';
include 'functii.php';

 if ( isset($_GET['book_id']) )
   $book_id = filter_var($_GET['book_id'], FILTER_SANITIZE_STRING) ;

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BibliotecaOnline - Imprumutare</title>
<link href="code/css.css" rel="stylesheet" type="text/css" />


<script language="JavaScript">

 function validare(){
 
 if ( document.getElementById('data_returnare').value == "")
  	 
	 {
	  alert("Va rugam sa completati data returnarii.")  
	  return;
	 };



  mesaj = "Sunteti sigur ca doriti imprumutarea acestei carti ?";
  if (confirm(mesaj) == true)
   {

    var lista = document.getElementById('lista_cititori');
    var cititor = lista.options[lista.selectedIndex].value;

    var URL = "actiuni_carti.php?action=IMPRUMUTARE&book_id=<?php echo $book_id ?>&cititor=" + cititor + "&data_returnare=" + document.getElementById('data_returnare').value;
	
    document.location= URL;

	};


 
 };
</script>

<!-- script pentru date-picker  -->
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">

<script>
// atasasrea comportamentului DatePicjker pentru un TextBox din pagina
$(document).ready(function() {
	$(function() {
	 $("#data_returnare").datepicker({ dateFormat: 'dd-mm-yy' });
	});
});
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
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold">&nbsp;</td>
    </tr>
    
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap="nowrap" class="arial_bold">
	  <?PHP

  	  $con = connect_to_db();
	  
	  
  		    if ( (isset($_SESSION["AUTH_USERTYPE"])) && ($_SESSION["AUTH_USERTYPE"] == "admin"))
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
			
			 ?>
			  <table border="1" cellpadding="5" cellspacing="0" bordercolor="#999999">
				  <tr>
					<td bgcolor="#CCCCCC" class="arial_bold">Imprumutare carte</td>
				  </tr>
				  <tr>
					<td>
					<form action="actiuni_carti.php" method="POST">
                     <table height="158" border="0" cellpadding="10" cellspacing="5">
					  <tr>
					    <td rowspan="6" nowrap="nowrap" class="arial_normal"><?php echo '<img src="images/poze_coperti/uploads/' . $row['poza_coperta']. '" width="180" height="250">'; ?></td>
						<td nowrap="nowrap" class="arial_normal">Autor : <?php echo $row['autor'] ?></td>
						<td nowrap="nowrap">&nbsp;</td>
						</tr>
					  <tr>
					    <td nowrap="nowrap" class="arial_normal">Titlu : <?php echo $row['titlu'] ?></td>
						<td nowrap="nowrap">&nbsp;</td>
						</tr>
					  
					  <tr>
					    <td nowrap="nowrap" class="arial_normal">Cititor </td>
						<td nowrap="nowrap"><select id="lista_cititori" style="width:250px"/>
						<?php
						
						   $sql  = "SELECT * from utilizatori WHERE usertype='user' and enabled='yes' ORDER BY fullname;"; // pentru paginare
                           $res =  mysqli_query($con,$sql);
						   while ($row = mysqli_fetch_assoc($res))
						   {
						    echo '<option value="'.$row['username'].'">'.$row['fullname'].'</option>' . "\r\n";
						    };
							  
					?>
						</select></td>
						</tr>
					  <tr>
					    <td nowrap="nowrap" class="arial_normal">Data returnare </td>
						<td nowrap="nowrap"><input name="data_returnare" type="text" id="data_returnare" style="width:250px"/></td>
						</tr>

					  <tr>
					    <td colspan="2" align="center" nowrap="nowrap" class="arial_normal"><hr /></td>
				       </tr>
					  <tr>
						<td align="center" nowrap="nowrap" class="arial_normal">&nbsp;</td>
						<td align="center" nowrap="nowrap" class="arial_normal"><a href="javascript: void(0)" onclick = "validare()">Imprumuta carte</a></td>
					  </tr>
					</table>
					<input type="hidden" name="book_id" value="<?php echo $book_id ?>" />
					</form>					
					</td>
				  </tr>
				</table>
				
				<?php
				}; // s-au gasit carti
				
			 } //admin
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
