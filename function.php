<?php
    $conn = mysqli_connect('localhost', 'root', '', 'laporan_masyarakat', 3308);

    function seeErrror()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(0);
        error_reporting(E_ALL);
    }

?>
