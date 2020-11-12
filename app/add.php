<?php

if(isset($_POST['title'])) {
    require '../dbCon.php';

    //fetching data
    $title = $_POST['title'];

    //checks, if to-do was entered
    if(empty($title)) {
        header("Location: ../index.php?message=error");
    } else {
        //execute statement
        $stmt = $conn->prepare("INSERT INTO todos(title) VALUE(?)");
        $res = $stmt->execute([$title]);

        //checking result
        if($res) {
            header("Location: ../index.php?message=success");
        } else {
            header("Location: ../index.php");
        }
        //closing connection
        $conn = null;
        exit();
    }
} else {
    //if something went wrong
    header("Location: ../index.php?message=error");
}
