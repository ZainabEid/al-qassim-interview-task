@extends('layouts.app')
@section('content')
    <div class="container">

        {{-- add new project button --}}
        <div class="row">
            <div class="col">
                <a class="btn btn-outline-info" id="add-project" href="{{ route('projects.create') }}">add new project</a>
            </div>
        </div>

        <div class="row">

            {{-- projects and tasks table --}}
            <div class="col">
                @if ($projects->count() > 0)

                    {{-- list of projects --}}
                    <table class="table-bordered">
                        <thead>

                            <tr>
                                <th scope="col" colspan="0" rowspan="2">#</th>
                                <th scope="col" colspan="2" rowspan="2">project name</th>
                                <th scope="col" rowspan="2">progress</th>
                                <th scope="col" colspan="2">tasks</th>
                            </tr>
                            <tr>
                                <th scope="col">task name</th>
                                <th scope="col">status</th>
                            </tr>


                        </thead>
                        <tbody>

                            @foreach ($projects as $index => $project)

                                {{-- project row --}}
                                <tr id="{{ $project->id }}">
                                    {{-- index --}}
                                    <td rowspan="{{ $project->tasks()->count() ? $project->tasks()->count() + 1 : 0 }}">
                                        {{ $index + 1 }}
                                    </td>

                                    {{-- project name --}}
                                    <td colspan="2"
                                        rowspan="{{ $project->tasks()->count() ? $project->tasks()->count() + 1 : 0 }}">
                                        <span><a class="show-project" href="{{ route('projects.show', $project->id) }}"
                                                title="show project details">{{ $project->name }}</a></span>

                                        <a href="{{ route('task.add-task-form', $project->id) }}" type="button"
                                            class="show-add-task-form btn btn-warning btn-sm  " role="button"
                                            title="add task"> +  add task </a>
                                    </td>

                                    {{-- progress --}}
                                    <td id="progress{{ $project->id }}" rowspan="{{ $project->tasks()->count() ? $project->tasks()->count() + 1 : 0 }}">

                                        {{-- this codde will be calculated in a helper function calculatePercentage() --}}
                                        {{-- number_format(($project->tasks->whereIn('status', 'finished')->count() / $project->tasks->count()) * 100, 1) --}}
                                          {{ $project->tasks()->count() ? calculatePercentage($project->id) : 0 }}
                                            %
                                    </td>

                                </tr><!-- end of project row -->

                                @if ($project->tasks()->count() > 0)

                                    {{-- tasks rows --}}
                                    @foreach ($project->tasks as $task)
                                        <tr  class="{{ $project->id }}">
                                            {{-- task name --}}
                                            <td>{{ $task->name }}</td>

                                            {{-- task staus --}}
                                            <td>
                                                <span class="status">

                                                    {{ $task->status }}

                                                    {{-- change link --}}
                                                    @if ($task->status != 'finished')
                                                        <a href="{{ route('task.change-status', $task->id) }}">change</a>
                                                    @endif
                                                </span>
                                            </td>
                                        </tr> <!-- end of task row -->
                                    @endforeach
                                @else
                                    <td colspan="2"><span> there is no tasks yet</span></td>
                                @endif


                            @endforeach
                        </tbody>
                    </table>

                @else
                    <p> there is no projects yet</p>
                @endif
            </div>

            {{-- project data --}}
            <div class="col">
                <div class="row " id="project-details">

                    {{-- managed in public/js/project.js --}}

                </div>
            </div>
        </div>





    </div> <!--  end of container -->

@endsection
