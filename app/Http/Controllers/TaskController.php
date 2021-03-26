<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function addTaskForm(Project $project)
    {
        return view('projects._add_task_form',compact('project'));
    }


    public function store(Project $project, Request $request)
    {
        //return response()->json(['returned' => $request->task_name]);
       
        try {

            $new_task = $project->tasks()->create([
                'name' => $request->task_name,
            ]);

            $task = Task::findOrFail($new_task->id);
            $tasks_count = $project->tasks->count();

           return response()->json([
               'task_name' => $task->name ,
               'task_status' => $task->status ,
               'task_id' => $task->id ,
               'project_id' => $project->id ,
               'tasks_count' =>  $tasks_count + 1,
               ]);

        } catch (\Exception $ex) {

            return response()->json(['error' => 'cant add new task ' , 'ex:' => $ex->getMessage()]);
        }
    } // end of add()

    public function changeStatus(Task $task)
    {

        try {

            $status = ($task->status == 'toDo') ? 'onProgress' : 'finished';
            $task->update([
                'status' => $status,
            ]);

            return  redirect()->route('projects')->with(['success' => 'status changed']);
            
        } catch (\Exception $ex) {

            return  redirect()->route('projects')->with(['error' => 'can\'t be changed']);
        }
    } // end of cahnge status
}// end of task controller
