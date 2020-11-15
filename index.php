<?php require 'dbCon.php' ?>
<?php

    /**
     * If submit-btn clicked
     */
    if (isset($_POST['submit-btn'])) {
        $todoTitle = $_POST['title'];
        $toDo->setTitle($todoTitle);

        //Statement ADD
        if($toDo->add()) {
            header("Location: index.php?inserted");
        } else {
            header("Location: index.php?insertfailure");
        }
    }

    /**
     * If delete clicked
     */
    if(isset($_POST['delete-btn'])){
        $toDoId = $_POST['delete-btn'];
        $toDo->setId($toDoId);

        if($toDo->delete()) {
            header("Location: index.php?deleted");
        } else {
            header("Location: index.php?deletedfailure");
        }
    }

    /**
     * If to-do checked as done
     */
    if(isset($_POST['check-btn'])){
        $taskId = $_POST['check-btn'];
        $toDo->setId($taskId);
        if($toDo->check())
        {
            header("Location: index.php?completed");
        }
        else
        {
            header("Location: index.php?completedfailure");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>To-Do List</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <!-- Own CSS -->
        <link rel="stylesheet" href="css/style.css"
    </head>
    <body class="text-center">

        <!-- Section Form -->
        <?php include 'section/form.php'; ?>

        <?php include 'section/listall.php'; ?>

        <!-- DB query to get all data -->
        <?php
            //$toDo->getAll();
        ?>

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

         <!-- jquery Js-->
        <script src="js/jquery-3.2.1.min.js"></script>

        <!-- Own Js-->
        <script src="js/own.js"></script>
    </body>
</html>
