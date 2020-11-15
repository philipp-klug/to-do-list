$(document).ready(function () {

    //remove to-do from list + animation
    $('.delete-to-do').click(function(){
        const id = $(this).attr('id');
        $.post("index.php", {
                id: id
            },
            (data) => {
                if(data) {
                    $(this).parent().hide(600);
                }
            }
        );
    });

    //checks to-do as done + animation
    $(".check-box").click(function(e) {
        const checkboxid = $(this).attr('data-todo-id');
        alert(checkboxid);
        $.post('index.php',
            {
                checkboxid: checkboxid
            },
            (data) => {
                if(data != 'error') {
                    const h2 = $(this).next();
                    //changing classes to toggle line-through
                    if(data === '1') {
                        h2.removeClass('checked');
                    } else {
                        h2.addClass('checked');
                    }
                }
            }
        )
    });
});
