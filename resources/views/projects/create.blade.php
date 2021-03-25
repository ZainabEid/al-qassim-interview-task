@extends('layouts.app')
@section('content')
    <div class="container row">

        {{-- add new project --}}
        <h3>Add New Project</h3>
        <form action="{{ route('projects.store') }}" method="post">
            @csrf
            @method('POST')
                <label for="name"> enter project name: </label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="enter project name">
                @error('name')
                    {{ $message }}
                @enderror

                <br>
                <label for="start"> start at:</label>
                <input type="date" name="start" value="{{ old('start') }}">
                @error('start')
                    {{ $message }}
                @enderror

                <br>
                <label for="end"> ends at:</label>
                <input type="date" name="end" value="{{ old('end') }}">
                @error('end')
                {{ $message }}
                @enderror
                <br>
                
                <label for="creator"> enter creator name:</label>
                <input type="text" name="creator" value="{{ old('creator') }}" placeholder="enter creator name">
                @error('creator')
                {{ $message }}
                @enderror
                <br>

                <button type="submit">add</button>

        </form>
    </div>
@endsection
