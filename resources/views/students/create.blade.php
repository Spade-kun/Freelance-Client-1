@extends('default')

@section('content')

@php
	use Collective\Html\FormFacade as Form;
@endphp

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'students.store']) !!}
    <div class="mb-3">
        {{ Form::label('name', 'Username', ['class'=>'form-label']) }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
		<div class="mb-3">
			{{ Form::label('first_name', 'First_name', ['class'=>'form-label']) }}
			{{ Form::text('first_name', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('middle_name', 'Middle_name', ['class'=>'form-label']) }}
			{{ Form::text('middle_name', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('last_name', 'Last_name', ['class'=>'form-label']) }}
			{{ Form::text('last_name', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('email', 'Email', ['class'=>'form-label']) }}
			{{ Form::text('email', null, array('class' => 'form-control')) }}
		</div>
        <div class="mb-3">
            {{ Form::label('password', 'Password', ['class'=>'form-label']) }}
            {{ Form::password('password', ['class' => 'form-control']) }}
        </div>
		<div class="mb-3">
			{{ Form::label('phone', 'Phone', ['class'=>'form-label']) }}
			{{ Form::text('phone', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('address', 'Address', ['class'=>'form-label']) }}
			{{ Form::text('address', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
            {{ Form::label('date_of_birth', 'Date of Birth', ['class'=>'form-label']) }}
            {{ Form::date('date_of_birth', null, ['class' => 'form-control']) }}
        </div>




		{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}


@stop
