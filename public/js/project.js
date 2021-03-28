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
            success: function (response) {

                //response is tr, project_id, tasks_count

                // project rowspan setting.
                var rowspan = Number(response.tasks_count) + 1;
                $('#' + response.project_id).children().attr('rowspan', rowspan );

                // check if it is the first task in the project
                if (response.tasks_count == 1) {

                    //remove there is now tasks cell
                    $('#no-task-' + response.project_id).remove();

                    // add the first task row 
                    $(response.tr).insertAfter('#' + response.project_id);

                } else {
                    // append html after the last task tr.
                    $('.' + response.project_id).last().after(response.tr);
                }


                // calculate the persentage
                calculatePercentage(response.project_id);

            }// end of ajax succes function
        });// end of ajax
    });//end of add-task click

    //change status function
    $(document).on('click','.change-status', function (e) {
        e.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            method: 'GET',
            data: {
                _token: _token,
            },
            success: function (response) {
                //response contains status, project_id, task_id

                //check status if finished remove the link
                if (response.status == 'finished') {
                    $('#change-status-link-' + response.task_id ).remove();
                }

                // change the status
                $("#status-" + response.task_id).html(response.status);

                // calculate the persentage
                calculatePercentage(response.project_id)
            }// end of success function 
        });// end of ajax

    });//end of document click change-status 

    // show project script 
    $('.show-project').on('click', function (e) {
        e.preventDefault();

        var url = $(this).attr('href');

        projectDetails(url)

    });// end of show project 


}); // end of document ready

// calulate the progress percentage
function calculatePercentage(project_id) {
    $.ajax({

        url: " /calculate-percentage/ " + project_id,
        method: 'GET',
        success: function (percentage) {
            $('#progress' + project_id).html(percentage);

        }// end of succes
    });// end of ajax

}// end of calculatepercentage funciton


// fills the project-details div with show-project OR show-add-task-form
// [right col area]
function projectDetails(url) {
    $.ajax({
        url: url,
        method: 'GET',
        success: function (result) {
            $('#project-details').empty();
            $('#project-details').append(result);
        }// end of success 
    });// end of ajax
}// end of project details function