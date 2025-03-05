@extends('default')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    {!! Form::open(['route' => 'grades.store']) !!}

        <!-- Enrollment Dropdown -->
        <div class="mb-3">
            {{ Form::label('enrollment_id', 'Enrollment', ['class' => 'form-label']) }}
            {{ Form::select('enrollment_id', $enrollments, null, ['class' => 'form-control', 'placeholder' => 'Select Enrollment']) }}
        </div>

        <!-- Grade -->
        <div class="mb-3">
            {{ Form::label('grade', 'Grade', ['class' => 'form-label']) }}
            {{ Form::text('grade', null, ['class' => 'form-control']) }}
        </div>

        <!-- Remarks -->
        <div class="mb-3">
            {{ Form::label('remarks', 'Remarks', ['class' => 'form-label']) }}
            {{ Form::text('remarks', null, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}

    {!! Form::close() !!}

@stop
