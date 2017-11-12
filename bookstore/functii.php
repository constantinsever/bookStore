 <?php
 
 require_once('PHPMailer-master/PHPMailerAutoload.php');
 
 
 function tiparire_linkuri(){
 
  if (isset($_SESSION["AUTH_FULLNAME"]))
   {
		if ($_SESSION["AUTH_FULLNAME"] != "") // user logat
		{ 
		 echo "Bun venit ".$_SESSION['AUTH_FULLNAME'] . "<br>";
		 if ( $_SESSION["AUTH_USERTYPE"] == "admin")
		  {
			echo '<a href="javascript: void(0)" onclick="document.location=&quot;adaugare_carte.php&quot;">Adaugare carte</a><br>';
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
		};
	
	}
	
	else // nu este logat/activat
	 {
	  echo '<a href="javascript: void(0)" onclick="document.location=&quot;login.php&quot;">Intra in cont</a><br>
			<a href="javascript: void(0)" onclick="document.location=&quot;contnou.php&quot;">Cont nou</a>';
	  };

 };
 
 
 
 
 
 	   function sendMail($adresa_email, $code){
	   
 	     $msg = "Mai jos aveti codul/parola de acces.<br>";
		 $msg .= "<b>".$code."</b>";

		 $mail = new PHPMailer(); // create a new object

		 $mail->IsSMTP(); // enable SMTP
		 $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
		 $mail->SMTPAuth = true; // authentication enabled
		 $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
		 $mail->Host = "smtp.gmail.com";
		 $mail->Port = 465; // or 587
		 $mail->IsHTML(true);
		 $mail->Username = "proiectbiblioteca2017@gmail.com";
		 $mail->Password = "biblioteca2017";
		 $mail->SetFrom("proiectbiblioteca2017@gmail.com");
		 $mail->Subject = "Mail de la ProiectBiblioteca";
		 $mail->Body = $msg;
		 $mail->AddAddress($adresa_email);
		
		 if(!$mail->Send()) 
			return 0;
		  else 
			return 1;
	   };


 



	?>	