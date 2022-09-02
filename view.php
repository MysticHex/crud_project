<?php
    include 'function.php';

    $sql="SELECT penduduk.nama_lengkap, input_aspirasi.jenis_aspirasi,input_aspirasi.keluhan FROM penduduk,input_aspirasi WHERE penduduk.nik=input_aspirasi.id_pelapor;";
    $run=mysqli_query($conn,$sql);
    seeErrror();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View all</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="view.css">
    <style>
        .main {
            height: 100px;
            width: 500px;
            background-color: white;
            margin: 0 auto;
        }

        .sidenav {
            height: 100%;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <div class="board sidenav" id="board1">
        <div class="page">
            <img src="asset/user.png" id="user">
        </div>
        <div class="coat">
            <p class="subid">NIK:</p>
            <p class="subid">Nama lengkap:</p>
        </div>
    </div>

    <div class="board" id="board2">
        <div class="searchbar mt-2">
            <form action="" method="get" style="width:fit-content;">
                <input type="text" class="form-text" name="keyword" id="searchText">
                <button type="submit" id="btn"><img width="20px" src="asset/search-interface-symbol.png" alt=""></button>
            </form>
        </div>

        <?php while($row=mysqli_fetch_assoc($run)); { ?>
            <div class="mt-3"></div>
            <div class="main">
                <table>
                    <tr>
                        <td>Nama:</td>
                        <td><?= $row['nama_lengkap']; ?></td>
                    </tr>
                    <tr>
                        <td>Jenis laporan:</td>
                        <td><?= $row['jenis_aspirasi']; ?></td>
                    </tr>
                    <tr>
                        <td>Laporan:</td>
                        <td><?= $row['keluhan']; ?></td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td></td>
                    </tr>
                </table>
            </div>
        <?php } ?>
        <div class="mb-5"></div>
    </div>
</body>

</html>