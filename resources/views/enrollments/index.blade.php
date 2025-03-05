



<x-app-layout>
    <div class="d-flex justify-content-end m-3"><a href="{{ route('enrollments.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered m-3">
		<thead>
			<tr>
				<th>id</th>
				<th>student_id</th>
				<th>subject_id</th>
				<th>enrollment_date</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($enrollments as $enrollment)

				<tr>
					<td>{{ $enrollment->id }}</td>
					<td>{{ $enrollment->student_id }}</td>
					<td>{{ $enrollment->subject_id }}</td>
					<td>{{ $enrollment->enrollment_date }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('enrollments.show', [$enrollment->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('enrollments.edit', [$enrollment->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['enrollments.destroy', $enrollment->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

</x-app-layout>

	<div class="d-flex justify-content-end mb-3"><a href="{{ route('enrollments.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered m-3">
		<thead>
			<tr>
				<th>id</th>
				<th>student_id</th>
				<th>subject_id</th>
				<th>enrollment_date</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($enrollments as $enrollment)

				<tr>
					<td>{{ $enrollment->id }}</td>
					<td>{{ $enrollment->student_id }}</td>
					<td>{{ $enrollment->subject_id }}</td>
					<td>{{ $enrollment->enrollment_date }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('enrollments.show', [$enrollment->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('enrollments.edit', [$enrollment->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['enrollments.destroy', $enrollment->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

