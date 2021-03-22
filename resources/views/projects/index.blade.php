@extends('layouts.app')
@section('content')
    <div class="container">

        <a class="btn btn-outline-info" id="add-project" href="{{ route('projects.create') }}">add new project</a>


        {{-- list of projects --}}
        <ul>
            @if ($projects->count() > 0)
                @foreach ($projects as $project)
                    <li>
                        project:
                        {{ $project->name }} >>



                        {{-- add new task form --}}
                        <div>
                            <form action="{{ route('task.add', $project->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <input type="text" name="task_name" value="" placeholder="write a new task">

                                <button type="submit">add task</button>

                            </form>
                        </div>

                        @if ($project->tasks()->count() > 0)
                            <span> progress:
                                {{ number_format(($project->tasks->whereIn('status', 'finished')->count() / $project->tasks->count()) * 100, 1) }}
                                %
                            </span>

                            {{-- list of tasks --}}
                            <ul class="task-list">
                                @foreach ($project->tasks as $task)
                                    <li>
                                        {{ $task->name }}
                                        <p class="status">{{ $task->status }} @if ($task->status == 'finished')
                                                <a href="{{ route('task.change-status', $task->id) }}">change</a>
                                            @endif
                                        </p>

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
