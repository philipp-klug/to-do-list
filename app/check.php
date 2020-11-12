<?php

if(isset($_POST['id'])) {
    require '../dbCon.php';

    //fetching data
    $id = $_POST['id'];

    //checks, if to-do was entered
    if(empty($id)) {
        echo 'error';
    } else {
        //execute statement
        $todos = $conn->prepare("SELECT id, checked FROM todos WHERE id=?");
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $uId = $todo['id'];
        $checked = $todo['checked'];

        //toggle value
        $uChecked = $checked ? 0 : 1;

        $res = $conn->query("UPDATE todos SET checked=$uChecked WHERE id =$uId");

        if($res) {
            echo $checked;
        } else {
            echo "error";
        }

        //closing connection
        $conn = null;
        exit();
    }
} else {
    //if something went wrong
    header("Location: ../index.php?message=error");
}
