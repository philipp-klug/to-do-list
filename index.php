<?php require 'dbCon.php'; ?>
<?php require 'section/validate.php'; ?>
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

        <!-- Section Form to insert ToDo-->
        <?php include 'section/form.php'; ?>

        <!-- Section to list all ToDo's -->
        <?php include 'section/listall.php'; ?>
    </body>
</html>
