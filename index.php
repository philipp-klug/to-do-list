<?php require 'dbCon.php' ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do-List</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css"
</head>
<body class="text-center">
    <form class="form-todo" action="app/add.php" method="POST" autocomplete="off">
        <img class="mb-4" src="img/todo.png" alt="" width="72" height="72">
        <h1 class="h3 mb-4 font-weight-normal">To Do List</h1>
        <label for="inputToDo" class="sr-only">To Do</label>

        <!-- error handling, if message=error isset-->
        <?php if(isset($_GET['message']) && $_GET['message'] == 'error') { ?>
            <input type="text" name="title" class="form-control" placeholder="Enter To-Do" style="border-color: #ff6666" > <!-- Leave off 'required autofocus' to show error handling -->
        <?php } else { ?>
            <input type="text" name="title" class="form-control" placeholder="Enter To-Do"> <!-- Leave off 'required autofocus' to show error handling  -->
        <?php } ?>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Do it!</button>
    </form>
        <!-- DB query to get all data -->
        <?php
        $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
        ?>
        <!-- Section to Show To-Dos -->
        <div class="mx-auto" class="show-todo-section">
            <ul class="list-group">
                <!-- Shown, if To-Do List is empty -->
                <?php if($todos->rowCount() === 0) { ?>
                    <div class="todo-item">
                        NO TO DOS TO DO <!--<img src="img/blank.jpg" width="100%" />-->
                    </div>
                <?php } ?>

                <!-- While loop to print all To-Do -->
                <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="todo-item">
                        <!-- If To-Do is checked -->
                        <?php if($todo['checked']) { ?>
                            <li class="list-group-item" aria-disabled="true">
                                <p><s><?php echo $todo['title'] ?></s></p>
                                <br/>
                                <small>created: <?php echo $todo['date_time'] ?></small>
                                <br />
                                <input type="checkbox" class="check-box" data-todo-id="<?php echo $todo['id']; ?>" checked />
                                <span id="<?php echo $todo['id']; ?>" class="remove-to-do" aria-disabled="false">x</span>
                            </li>
                            <!-- Otherwise To-Do is unchecked -->
                        <?php } else { ?>
                            <li class="list-group-item">
                                <p><?php echo $todo['title'] ?></p>
                                <br />
                                <small>created: <?php echo $todo['date_time'] ?></small>
                                <br />
                                <input type="checkbox" class="check-box" data-todo-id="<?php echo $todo['id']; ?>" />
                                <span id="<?php echo $todo['id']; ?>" class="remove-to-do">x</span>
                            </li>
                        <?php } ?>
                    </div>
                <?php } ?>
            </ul>
        </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

     <!-- jquery Js-->
    <script src="js/jquery-3.2.1.min.js"></script>

    <!-- Own Js-->
    <script>
        $(document).ready(function () {
            //remove animation
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
               $.post("app/remove.php", {
                       id: id
                   },
                   (data) => {
                        if(data) {
                            $(this).parent().hide(600);
                        }
                   }
                );
            });

            //checked toggle
            $(".check-box").click(function(e) {
                const id = $(this).attr('data-todo-id');
                $.post('app/check.php',
                    {
                        id: id
                    },
                    (data) => {
                        if(data != 'error') {
                            const p = $(this).next();
                            if(data === '1') {
                                p.removeClass('checked');
                            } else {
                                p.addClass('checked');
                            }
                        }
                    }
                )
            });
        });
    </script>
</body>
</html>
