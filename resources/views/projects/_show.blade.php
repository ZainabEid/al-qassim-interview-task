<div class="row">

    <h3>Project Details</h3>
    <table class="table-bordered">

        <!-- project name -->
        <tr>
            <th><span>project name: </span></th>
            <td><span>{{ $project->name }}</span></td>
        </tr>

        <!-- project creator -->
        <tr>
            <th>created by: </th>
            <td>{{ $project->creator }}</td>
        </tr>

        {{-- created by --}}
        <tr>
            <th><span>created by: </span></th>
            <td><span>{{ $project->creator }}</span></td>
        </tr>

        {{-- started at --}}
        <tr>
            <th><span>started at: </span></th>
            <td><span>{{ $project->start }}</span></td>
        </tr>

        <!-- deadline -->
        <tr>
            <th><span>deadline:  </span></th>
            <td><span>{{ $project->end }}</span></td>
        </tr>
    </table>

</div>