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

        try {
            // validation 
            $request->validate([
                'name' => 'required|string',
            ]);

            // store data
            $new_task = $project->tasks()->create([
                'name' => $request->task_name,

            ]);

            //compacted data
            $task = Task::findOrFail($new_task->id);
            $tasks_count = $project->tasks->count();
            $project_id = $project->id;

            // return statments
            if ($request->ajax()) {

                return response()->json([
                    'tasks_count' => $tasks_count,
                    'project_id' =>  $project_id,
                    'tr' => view('projects._new_task_tr', compact('task', 'project_id'))->render(),
                ]);
            } else {

                return view('projects')->with(['success' => 'new task added succefully']);
            }
        } catch (\Exception $ex) {

            if ($request->ajax()) {

                return response()->json(['error' => 'cant add new task ', 'ex:' => $ex->getMessage()]);
            } else {

                return view('projects')->with(['error' => 'something went wrong']);
            }
        }
    } // end of add()

    public function changeStatus(Task $task)
    {

        try {
            // get the new status
            $status = ($task->status == 'toDo') ? 'onProgress' : 'finished';

            // update status
            $task->update([
                'status' => $status,
            ]);

            // return statments
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
