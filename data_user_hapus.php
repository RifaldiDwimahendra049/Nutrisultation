<?php
$connect = mysqli_connect('localhost', 'root', '', 'nutrisultation');
    $id = $_GET['id'];

    $result = mysqli_query($connect, "DELETE FROM user WHERE id=$id");

    header("Location:data_user.php");
        ?>