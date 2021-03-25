$(document).ready(function () { // public file

    // show add task form
    $('.show-add-task-form').on('click', function (e) {
        e.preventDefault();

        var url = $(this).attr('href');
        projectDetails(url)
    });

    $(document).on('click', '.add-task', function (e) {
        e.preventDefault();

        var task_name = $(this).siblings('input').attr('name', 'task-name').val();
        var url = $(this).attr('href');


        $.ajax({
            url: url,
            method: 'GET',
            data: {
                task_name: task_name,
            },
            success: function (result) {
                console.log(result);

                //return with a table row to append in the project_id tr
                var html = ` <tr >
                <td> ${result.task_name}</td>
                <td><span class="status">
                        ${result.task_status}
                            <a href="#">change</a>
                    </span>
                </td>
            </tr>`
                // add the change route  to href : ${ route('task.change-status',result.project_id) }

                
                // append html after the last task tr.
                $tr_next_project_id = '#' + result.next_project_id;
                $(html).insertBefore($tr_next_project_id);

                // project colscope incresed by one.
                $('#' + result.project_id).children().attr('rowspan', result.tasks_count);

                // calculate the persentage
                
            }
        });
    });




    //change status function
    $('.change-status').on('click', function (e) {
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

    // show project script
    $('.show-project').on('click', function (e) {
        e.preventDefault();

        var url = $(this).attr('href');

        projectDetails(url)

    });




});

// fills the project-details div with show-project OR show-add-task-form
function projectDetails(url) {
    $.ajax({
        url: url,
        method: 'GET',
        success: function (result) {
            $('#project-details').empty();
            $('#project-details').append(result);
        }
    });
}