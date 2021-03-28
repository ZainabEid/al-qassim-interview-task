<tr class="{{ $project_id }}" >
    {{-- task name --}}
    <td>{{ $task->name }}</td>

    {{-- task staus --}}
    <td>
        
        {{-- status --}}
        <p id="status-{{ $task->id }}">{{ $task->status }}</p>

        {{-- change link --}}
        @if ($task->status != 'finished')

            <a id="change-status-link-{{ $task->id }}"
               href="{{ route('task.change-status', $task->id) }}"
               class="change-status">change</a>

        @endif
    </td>
</tr> <!-- end of task row -->
