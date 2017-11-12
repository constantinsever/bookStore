<?php

function connect_to_db(){
 $con = new mysqli('localhost','root','root','biblioteca');
 
 if($con == false) 
   echo "Nu se poate realiza conexiunea la baza de date.";
 return $con;
 
}; 

?>