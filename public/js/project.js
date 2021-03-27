$(document).ready(function () { // public file

    // show add task form
    $('.show-add-task-form').on('click', function (e) {
        e.preventDefault();

        var url = $(this).attr('href');
        projectDetails(url)
    });

    // add task button
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

                //result is tr, project_id, tasks_count

                // project rowspan setting.
                var rowspan = Number(result.tasks_count) + 1;
                $('#' + result.project_id).children().attr('rowspan', rowspan );

                // check if it is the first task in the project
                if (result.tasks_count == 1) {

                    //remove there is now tasks cell
                    $('#no-task-' + result.project_id).remove();

                    // add the first task row 
                    $(result.tr).insertAfter('#' + result.project_id);

                } else {
                    // append html after the last task tr.
                    $('.' + result.project_id).last().after(result.tr);
                }


                // calculate the persentage
                calculatePercentage(result.project_id);

            }// end of ajax succes function
        });// end of ajax
    });//end of add-task click

    //change status function
    $(document).on('click','.change-status', function (e) {
        e.preventDefault();
        console.log('in change status funciotn');

        var _token = $('meta[name="csrf-token"]').attr('content');
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            method: 'GET',
            data: {
                _token: _token,
            },
            success: function (response) {
                console.log(response.status);
                if (response.status == 'finished') {
                    $('#change-status-link-' + response.task_id ).remove();
                }
                $("#status-" + response.task_id).html(response.status);
                calculatePercentage(response.project_id)
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

// calulate the progress percentage
function calculatePercentage(project_id) {
    $.ajax({

        url: " /calculate-percentage/ " + project_id,
        method: 'GET',
        success: function (percentage) {
            $('#progress' + project_id).html(percentage);

        }
    });

}


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