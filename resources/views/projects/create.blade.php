@extends('layouts.app')
@section('content')
    <div class="container">

        {{-- add new project --}}
        <form action="{{ route('project.store') }}" method="post">
            <input type="text" name="project-name" value="{{ old('project-name') }}">
            <input type="time" name="start-time" value="{{ old('start-time') }}">
            <input type="time" name="end-time" value="{{ old('end-time') }}">
            <input type="text" name="creator" value="{{ old('creator') }}">
            <button type="submit">add</button>
        </form>
    </div>
@endsection
