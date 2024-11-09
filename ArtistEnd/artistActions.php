<?php

session_start();



//Artist Home Page


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include('connect.php');
    if (isset($_GET['view-all-btn'])) {
        header('Location: viewAll.php');
    }
    if (isset($_GET['back-to-artistHome-btn'])) {
        header('Location: artistHome.php');
    }
    if (isset($_GET['all-artist-btn'])) {
        header('Location: allartist.php');
    }

}

?>