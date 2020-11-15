<form class="form-todo" method="POST" autocomplete="off"> <!-- removed: action="app/add.php" -->
    <img class="mb-4" src="img/todo.png" alt="" width="80" height="80">
    <h1 class="h3 mb-4 font-weight-normal">To-Do List</h1>

    <!-- error handling, if message=error isset-->
    <?php if(isset($_GET['message']) && $_GET['message'] == 'error') { ?>
        <input type="text" name="title" class="form-control" placeholder="Enter To-Do" style="border-color: #ff6666" > <!-- Leaving off 'required' to show error handling -->
    <?php } else { ?>
        <input type="text" name="title" class="form-control" placeholder="Enter To-Do">
    <?php } ?>

    <!-- submit button -->
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit-btn">Do it!</button>
</form>
