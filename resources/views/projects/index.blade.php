@extends('layouts.app')
@section('content')
    <div class="container">

        <a id="add-project" href="{{ route('project.add') }}">add new project</a>


        {{-- list of projects --}}
        <ul>
            @if ($projects->count() > 0)
                @foreach ($projects as $project)
                    <li>
                        progresss:
                        {{ $project->name }} >> <span> progress:
                            {{ ($project->tasks->where('status', 'finish')->count() / $project->tasks->count()) * 100 }} %
                        </span>

                        {{-- add new task form --}}
                        <div>
                            <form action="{{ route('task.add', $project->id) }}" method="post">

                                <input type="text" name="task-name" value="" placeholder="write a new task">
                                <a class="add-task" href="{{ route('task.add', $project->id) }}">add task</a>
                            </form>
                        </div>

                        @if ($project->tasks()->count() > 0)
                            {{-- list of tasks --}}
                            <ul class="task-list">
                                @foreach ($ptoject->tasks as $task)
                                    <li>
                                        {{ $task->name }} $nfp; 
                                        <p class="status">{{ $task->status }} $nfp; </p>
                                        
                                        <a href="{{ route('task.change-status', $task->id) }}">change</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else

                        <p> there is no tasks yet</p>
                        @endif

                    </li>
                @endforeach

            @else
                <p> there is no projects yet</p>
            @endif

        </ul>


    </div>
@endsection
