<?php
$connect = mysqli_connect('localhost', 'root', '', 'nutrisultation');
    $id = $_GET['id'];

    $result = mysqli_query($connect, "DELETE FROM konsultasi WHERE id=$id");

    header("Location:konsultasi_client.php");
        ?>