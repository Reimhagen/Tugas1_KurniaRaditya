
<?php

$servername = "localhost";
$username = "root" ;
$password = "" ;
$database = "pemwebfinal" ;
 // Membuat Koneksi
$connection = new mysqli($servername, $username, $password, $database);


$Nomor = "";
$NIM = "";
$Nama = "";
$Prodi= "";
$Email = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET') {

    if ( !isset($_GET["Nomor"])) {
        header("location: /PemwebFinal/index.php");
        exit;
    }

    $Nomor = $_GET["Nomor"];

    $sql = "SELECT * FROM mahasiswa WHERE Nomor = $Nomor";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /PemwebFinal/index.php");
        exit;
    }

} else {
    
    $Nomor = $_POST["Nomor"];
    $NIM = $_POST["NIM"];
    $Nama = $_POST["Nama"];
    $Prodi = $_POST["Prodi"];
    $Email = $_POST["Email"];

    do {
        if (   empty($NIM) || empty($Nama) || empty($Prodi) || empty($Email) ) {
            $errorMessage = "Isi semua field";
            break;
        }

        $sql = "UPDATE mahasiswa " . 
               "SET NIM = '$NIM', Nama = '$Nama',  Prodi = '$Prodi', Email = '$Email'" . 
               "WHERE Nomor = $Nomor";

        
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid Query: " . $connection->error;
            break;
        }

        $successMessage = "Pengguna Berhasil Diperbarui";

        header("location: /PemwebFinal/index.php");
        exit;

        } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
    body {
        background-image: url('yoyi.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: fill;
        background-color: rgba(0, 0, 0.5, 0.5);
        position: relative;
        z-index: -1;
        
    }

    table {
        position: relative;
        z-index: 1;
    }
</style>

<audio src="bgm.mp3" id="backgroundAudio" autoplay loop>
 
</audio>

<button onclick="toggleAudio()" style="position: fixed; top: 10px; right: 10px;" >Toggle Music</button>

<script>
  function toggleAudio() {
    var audio = document.getElementById("backgroundAudio");
    if (audio.paused) {
      audio.play();
    } else {
      audio.pause();
    }
  }
</script>

<body>
    <div class="container my-5">
        <h2 style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Perbarui Mahasiswa</h2>

        <?php
        if ( !empty($errorMessage) ) {
            echo "
            <div class='alert alert-warning alert-dismissable fade show' role='alert'>
            <strong?>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <input type="hidden" name="Nomor" value="<?php echo $Nomor ;?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">NIM</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="NIM" value="<?php echo $NIM ;?>">

                    </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="Nama" value="<?php echo $Nama ;?>">

                    </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prodi </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="Prodi" value="<?php echo $Prodi ;?>">

                    </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="Email" value="<?php echo $Email  ;?>">

                    </div>
            </div>

            <?php 
            if ( !empty($successMessage) )
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-3'>
                        <div class='alert alert-success alert-dismissable fade show' role='alert'>
                            <strong?>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                    "
            
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/PemwebFinal/index.php" role="button">Batal</a>
                </div>
            </div>
            
        </form>
    </div>
</body>
</html>