<?php 
session_start();
require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
$us=$_POST['user'];
$clave=$_POST['contra'];
$contra=sha1($clave);
$_SESSION['user']=$us;

$consul="SELECT * FROM empp_tb_users where username='$us' and password='$contra'";
$ejec=mysqli_query($con,$consul);
if (mysqli_affected_rows($con)!=0) {
	echo "1";
}else{
	echo "2";
}

?>