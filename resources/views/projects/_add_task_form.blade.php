<div class="row">
    <h3>Add new Task For {{ $project->name }} Project </h3>
    <label for="task-name">Task Name</label>
    <input type="text" name="task-name" placeholder="enter the task name" value="">
    <a id="add-task" class="add-task btn btn-info" href="{{ route('task.store',$project->id) }}"> <big>+</big> add task</a>
</div>