<?php


// calculate Progree Percentage

use App\Models\Project;
use SebastianBergmann\Environment\Console;

// calculate percentage 
function calculatePercentage($project_id)
{
    try{
        $project = Project::findOrFail($project_id);
       return  number_format(($project->tasks->whereIn('status', 'finished')->count() / $project->tasks->count()) * 100, 1);
    }
    catch(Exception $ex){
        error_log('something goes wrong'.$ex);
    }
}// end of caculatePercentage function