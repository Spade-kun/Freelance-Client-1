@extends('default')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    {!! Form::open(['route' => 'enrollments.store']) !!}

        <!-- Student Dropdown -->
        <div class="mb-3">
            {{ Form::label('student_id', 'Student', ['class' => 'form-label']) }}
            {{ Form::select('student_id', $students, null, ['class' => 'form-control', 'placeholder' => 'Select a Student']) }}
        </div>

        <!-- Subject Dropdown -->
        <div class="mb-3">
            {{ Form::label('subject_id', 'Subject', ['class' => 'form-label']) }}
            {{ Form::select('subject_id', $subjects, null, ['class' => 'form-control', 'placeholder' => 'Select a Subject']) }}
        </div>

        <!-- Enrollment Date -->
        <div class="mb-3">
            {{ Form::label('enrollment_date', 'Enrollment Date', ['class' => 'form-label']) }}
            {{ Form::date('enrollment_date', null, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}

    {!! Form::close() !!}

@stop
