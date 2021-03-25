<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index',compact('projects'));
    }// end of index


    public function create()
    {
        return view('projects.create');
    }// end of create

    public function store(ProjectRequest $request)
    {
        try {
            $requested_data = $request->except('_token','_method');

            Project::create($requested_data);
            $request->session()->flash('success', 'data enterd correctly');
            return redirect()->route('projects');
            
        } catch (\Exception $ex) {
            $request->session()->flash('error', 'there is an error');
            return redirect()->back();
        }
    }// end of 
    
    public function show(Project $project)
    {
        $projects = Project::all();
        return view('projects._show',compact('project','projects'));
    }

    
}// end of project controller
