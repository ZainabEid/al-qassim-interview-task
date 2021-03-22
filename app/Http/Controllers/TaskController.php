<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function add(Project $project, Request $request)
    {
       
        try {
            $task = $project->tasks()->create([
                'name' => $request->task_name,
            ]);
            return  redirect()->route('projects')->with(['success' => 'new task is added']);
          // return response()->json(['message'=>'massage']);
        } catch (\Exception $ex) {
            return  redirect()->route('projects')->with(['error' => 'can\'t be added']);
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
