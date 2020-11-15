<?php
/*
if(isset($_POST['id'])) {
    require '../dbCon.php';

    //fetching data
    $id = $_POST['id'];

    //checks, if to-do was entered
    if(empty($id)) {
        echo 0;
    } else {
        //execute statement
        $stmt = $conn->prepare("DELETE FROM todos WHERE id=?");
        $res = $stmt->execute([$id]);

        //checking result
        if($res) {
            echo 1;
        } else {
            echo 0;
        }
        //closing connection
        $conn = null;
        exit();
    }
} else {
    //if something went wrong
    header("Location: ../index.php?message=error");
}
*/
