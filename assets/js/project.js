$(document).ready(function () {

    // add task funciton
    $('.add-task').on('click', function (e) {
        e.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');
        var task_name = $(this).siblings('input').attr('name', 'task-name').val();
        var url = $(this).attr('href').val();

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: _token,
                task_name: task_name,
            },
            success: function (result) {
                var html = `<li> 
                                ${result.name}  $nfp; ${result.status} $nfp; <a href="{{ route('task.change-status', ${result.id} ) }}">change</a>
                            </li>`
                $(this).closest('ul').find('.task-list').append(html);
                
            }
        });
    });

        
        
    //change status function
    $('.change-status').on('click', function () {
        e.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');
        var url = $(this).attr('href').val();

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: _token,
            },
            success: function (result) {
               $(this).siblings('p').find('.status').empty();
               $(this).siblings('p').find('.status').html(result.status);
                
            }
        });

    });


});