
    // add task funciton
    $('.add-task').on('click', function (e) {
        e.preventDefault();

        alert();
        var _token = $(this).siblings('input').attr('name','_token').value;
        var task_name = $(this).siblings('input').attr('name', 'task-name').val();
        var project_id = $(this).data('project-id');
        var url = $(this).parent('form').attr('action').val();

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: _token,
                task_name: task_name,
            },
            success: function (result) {
                console.log(result);
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

    $('.show-project').on('click', function () {
        e.preventDefault();
        $('#project-details').append(content);
    });

