<?php
include 'function.php';

if (isset($_POST['btn'])) {
    $nik = (isset($_POST['nik'])) ? $_POST['nik'] : "";
    $nama = (isset($_POST['nama'])) ? $_POST['nama'] : "";
    $divisi = (isset($_POST['divisi'])) ? $_POST['divisi'] : "";
    $keluhan = (isset($_POST['keluhan'])) ? $_POST['keluhan'] : "";



    $imgname = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $error = $_FILES['gambar']['error'];
    if ($imgname) {
        if ($error === 0) {
            $imgex = pathinfo($imgname, PATHINFO_EXTENSION);

            $img_ex_lc = strtolower($imgex);

            $allowed_exs = array('png', 'jpeg', 'jpg');

            if (in_array($img_ex_lc, $allowed_exs)) {
                $newimgname = uniqid("image-" . "_", true) . "." . $img_ex_lc;
                echo $newimgname . '<br>';

                $image_upload_path = 'uploads/' . $newimgname;
                $move = move_uploaded_file($tmp_name, $image_upload_path);

                if ($move) {
                    $sql = "INSERT INTO `input_aspirasi`(
                        `id_pelapor`,
                        `jenis_aspirasi`,
                        `keluhan`,
                        `gambar`
                    )
                    VALUES(
                        '$nik',
                        '$divisi',
                        '$keluhan',
                        '$newimgname'
                    )";
                }
            }
        }
    } else {
        $sql = "INSERT INTO `input_aspirasi`(
        `id_pelapor`,
        `jenis_aspirasi`,
        `keluhan`,
        `gambar`
    )
    VALUES('$nik', '$divisi', '$keluhan', NULL)";
    }
}
seeErrror();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman utama</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #80ED99;
        }

        #header {
            background-color: #22577A;
            width: 100%;
            height: fit-content;
            position: absolute;
            top: 0;
            color: #ffff;
        }

        .body {
            width: 30%;
            height: fit-content;
            background-color: #38A3A5;
            margin: 10rem auto 0 auto;
            border-radius: 5%;
        }

        .body .form {

            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }

        .inp {
            width: 100%;
        }
        #output{
            width: 120px;
            margin: 10px 0px;
        }

        @media only screen and (max-width: 600px) {
            .body {
                width: 80%;
                margin: 7rem auto 0 auto;

            }
            #output{
                width: 10rem;
                margin: 1rem 0px;
            }
        }

        @media only screen and (max-width: 872px) {
            .body {
                width: 60%;
            }
        }
    </style>
</head>

<body>
    <div class="header" id="header">
        <h1 class="text-center">KEMAS</h1>
        <h3 class="text-center font-italic">Keluhan Masyarakat</h3>
    </div>

    <div class="body py-3 px-5">
        <div class="form mt-3">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="">NIK</label>
                <div class="mt-2"></div>

                <input required type="text" class="inp" name="nik" id="">
                <div class="mt-2"></div>

                <label for="">Nama</label>
                <div class="mt-2"></div>

                <input type="text" name="nama" class="inp" id="">
                <div class="mt-2"></div>

                <label for="">Divisi</label>
                <div class="mt-2"></div>

                <div class="mt-2"></div>
                <select name="divisi" id="" class="inp">
                    <option value="" hidden selected>Pilih departemen</option>
                    <option value="Kebersihan">Kebersihan</option>
                    <option value="Keamanan">Keamanan</option>
                </select>

                <div class="mt-2"></div>
                <label for="">Keluhan</label>

                <div class="mt-2"></div>
                <textarea name="keluhan" id="" class="inp" rows="2"></textarea>

                <div class="mt-2"></div>
                <input accept="image/*" type='file' onchange="loadFile(event)" class="inp" />
                <img id="output"/>

                <div class="mt-3"></div>
                <button type="submit" name="btn" class="inp btn btn-success">Submit</button>
            </form>
        </div>

    </div>
</body>

</html>

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
