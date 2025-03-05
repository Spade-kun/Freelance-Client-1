


<x-app-layout>
	<div class="d-flex justify-content-end mb-3"><a href="{{ route('subjects.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered m-3">
		<thead>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>code</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($subjects as $subject)

				<tr>
					<td>{{ $subject->id }}</td>
					<td>{{ $subject->name }}</td>
					<td>{{ $subject->code }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('subjects.show', [$subject->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('subjects.edit', [$subject->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['subjects.destroy', $subject->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>
</x-app-layout>

