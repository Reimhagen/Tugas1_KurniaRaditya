<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
<h5>Status: Tamu</h5>
<a class='btn btn-primary btn-sm' href='sistem_login.php'>Login</a>
    <div class="container my-5">
        <h2 style="color: #FFFFFF; text-shadow: 2px 2px 4px #000000;">Data Mahasiswa</h2>
       
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Email</th>
                    
                    
            </thead>
            <tbody>
              <?php  $servername = "localhost";
                $username = "root" ;
                $password = "" ;
                $database = "pemwebfinal" ;

                // Membuat Koneksi
                $connection = new mysqli($servername, $username, $password, $database);

                // Cek Koneksi
                if ($connection->connect_error) {
                    die("Connection Failed: " . $connection->connection_error);
                }

                // Membaca semua row dari tabel database
                $sql = "SELECT * FROM mahasiswa";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid Query: " . $connection->error);
                }

                // membacata data dalam setiap baris
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[Nomor]</td>
                    <td>$row[NIM]</td>
                    <td>$row[Nama]</td>
                    <td>$row[Prodi]</td>
                    <td>$row[Email]</td>
                    
                    
                </tr>
                    ";
                }
                ?>
            </tbody>
        </table> 
    </div>
</body>
</html>