<?php require 'dbCon.php' ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do-List</title>
    <link rel="stylesheet" href="css/style.css"
</head>
<body>
    <div class="main-section">

        <!-- Section to add a To-Do -->
        <div class="add-section">
            <form action="app/add.php" method="POST" autocomplete="off">

                <!-- error handling, if message=error isset-->
                <?php if(isset($_GET['message']) && $_GET['message'] == 'error') { ?>
                    <input type="text" name="title" style="border-color: #ff6666" placeholder="No To-Do entered! " />
                    <button type="submit">Add &nbsp; <span>&#43</span></button>
                <?php } else { ?>
                    <input type="text" name="title" placeholder="required *" />
                    <button type="submit">Add &nbsp; <span>&#43</span></button>
                <?php } ?>
            </form>
        </div>

        <!-- DB query to get all data -->
        <?php
            $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
        ?>

        <!-- Section to Show To-Dos -->
        <div class="show-todo-section">
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
                    <span id="<?php echo $todo['id']; ?>" class="remove-to-do">x</span>
                    <?php if($todo['checked']) { ?>
                        <input type="checkbox" class="check-box" checked />
                        <h2 class="checked"><?php echo $todo['title'] ?></h2>
                    <!-- Otherwise To-Do is unchecked -->
                    <?php } else { ?>
                        <input type="checkbox" class="check-box" />
                        <h2><?php echo $todo['title'] ?></h2>
                    <?php } ?>
                    <!-- Allways shown created Datetime -->
                    <br />
                    <small>created: <?php echo $todo['date_time'] ?></small>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
