
<x-app-layout>
    <div class="d-flex justify-content-end m-3"><a href="{{ route('grades.create') }}" class="btn btn-info">Create</a></div>

	<table class="table table-bordered m-3">
		<thead>
			<tr>
				<th>id</th>
				<th>enrollment_id</th>
				<th>grade</th>
				<th>remarks</th>

				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($grades as $grade)

				<tr>
					<td>{{ $grade->id }}</td>
					<td>{{ $grade->enrollment_id }}</td>
					<td>{{ $grade->grade }}</td>
					<td>{{ $grade->remarks }}</td>

					<td>
						<div class="d-flex gap-2">
                            <a href="{{ route('grades.show', [$grade->id]) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('grades.edit', [$grade->id]) }}" class="btn btn-primary">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['grades.destroy', $grade->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>
</x-app-layout>





