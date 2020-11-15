<?php
require 'dbCon.php';
$todos = $toDo->getAll();
?>
<!-- Section to Show To-Dos -->
<div class="mx-auto" class="show-todo-section">
    <ul class="list-group">

        <!-- Shown, if To-Do List is empty -->
        <?php if($todos->rowCount() === 0) { ?>
            <div class="todo-item">
                No To-Do's to do! <br/>
                <img src="img/blank.jpg" width="300px" />
            </div>
        <?php } ?>

        <!-- While loop to print all To-Do -->
        <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="todo-item">

                <!-- If To-Do is checked -->
                <?php if($todo['checked']) { ?>
                    <form method="post">
                        <li class="list-group-item" aria-disabled="true">
                            <button class="btn btn-danger" type="submit" name="delete-btn" value="<?php echo $todo['id']; ?>">Delete</button>
                            <span id="<?php echo $todo['id']; ?>" name='delete-to-do' class="delete-to-do" aria-disabled="false">x</span>
                            <button class="btn btn-success" type="submit" name="check-btn" value="<?php echo $todo['id']; ?>">Done</button>
                            <input type="checkbox" class="check-box" name='check-box' data-todo-id="<?php echo $todo['id']; ?>" checked />
                            <h2 class="checked"><?php echo $todo['title'] ?></h2>
                            <small>created: <?php echo $todo['date_time'] ?></small>
                        </li>
                    </form>

                    <!-- Otherwise To-Do is unchecked -->
                <?php } else { ?>
                    <form method="post">
                        <li class="list-group-item">
                            <button class="btn btn-danger" type="submit" name="delete-btn" value="<?php echo $todo['id']; ?>">Delete</button>
                            <!--<span id="<?php echo $todo['id']; ?>" class="delete-to-do" name='delete-to-do' aria-disabled="false">x</span>-->
                            <button class="btn btn-success" type="submit" name="check-btn" value="<?php echo $todo['id']; ?>">Done</button>
                            <input type="checkbox" class="check-box" name='check-box' data-todo-id="<?php echo $todo['id']; ?>" />
                            <h2><?php echo $todo['title'] ?></h2>
                            <small>created: <?php echo $todo['date_time'] ?></small>
                        </li>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>
    </ul>
</div>
