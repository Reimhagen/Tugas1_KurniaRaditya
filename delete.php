<?php
if ( isset($_GET["Nomor"])) {


$servername = "localhost";
$username = "root" ;
$password = "" ;
$database = "pemwebfinal" ;
 // Membuat Koneksi
$connection = new mysqli($servername, $username, $password, $database);

$Nomor = $_GET["Nomor"];
$sql = "DELETE FROM mahasiswa WHERE Nomor=$Nomor";
$connection->query($sql);

}

header("location: /PemwebFinal/index.php");
exit;
?>