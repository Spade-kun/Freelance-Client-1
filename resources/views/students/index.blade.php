<x-app-layout>

	<div class="d-flex justify-content-end m-3"><a href="{{ route('students.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered m-3">
		<thead>
			<tr>
				<th>id</th>
                <th>username</th>
				<th>first_name</th>
				<th>middle_name</th>
				<th>last_name</th>
				<th>email</th>
				<th>phone</th>
				<th>address</th>
				<th>date_of_birth</th>
				<th>password</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($students as $student)

				<tr>
					<td>{{ $student->id }}</td>
                    <td>{{ $student->user->name }}</td>
					<td>{{ $student->first_name }}</td>
					<td>{{ $student->middle_name }}</td>
					<td>{{ $student->last_name }}</td>
					<td>{{ $student->user->email }}</td>
					<td>{{ $student->phone }}</td>
					<td>{{ $student->address }}</td>
					<td>{{ $student->date_of_birth }}</td>
					<td>{{ $student->user->password }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('students.show', [$student->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('students.edit', [$student->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['students.destroy', $student->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

</x-app-layout>
