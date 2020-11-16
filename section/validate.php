<?php
/**
 * Validate placed on top of index.php
 */
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
            header("Location: index.php?doneOrUndo");
        }
        else
        {
            header("Location: index.php?completedfailure");
        }
    }
?>
