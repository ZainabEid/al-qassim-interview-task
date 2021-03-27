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
        return view('projects._add_task_form', compact('project'));
    }


    public function store(Project $project, Request $request)
    {
        //return response()->json(['returned' => $request->task_name]);

        try {
            // validation 

            // store data
            $new_task = $project->tasks()->create([
                'name' => $request->task_name,
                
            ]);

            //compact data
            $task = Task::findOrFail($new_task->id);
            $tasks_count = $project->tasks->count();
            $project_id = $project->id;

            if ($request->ajax()) {

                return response()->json([
                    'tasks_count' => $tasks_count,
                    'project_id' =>  $project_id,
                    'tr' => view('projects._new_task_tr', compact('task', 'project_id'))->render(),
                ]);

            } else {
                return view('projects');
            }
        } catch (\Exception $ex) {

            return response()->json(['error' => 'cant add new task ', 'ex:' => $ex->getMessage()]);
        }
    } // end of add()

    public function changeStatus(Task $task)
    {

        try {

            $status = ($task->status == 'toDo') ? 'onProgress' : 'finished';
            $task->update([
                'status' => $status,
            ]);

            return  response()->json([
                'status' =>  $task->status,
                 'task_id' => $task->id,
                 'project_id' => $task->project->id,
                 ]);
        } catch (\Exception $ex) {

            return response()->json(['error' => 'can\'t be changed']);
        }
    } // end of cahnge status
}// end of task controller
