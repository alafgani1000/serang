@extends('layouts.app')
@section('content')
<a class="btn btn-primary" href="{{route('incidents.create')}}">
    Create
</a>
<p>&nbsp;</p>
@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<table id="dataTables" class="display" cellspacing="0" width="100%">
	<thead class="table-success">
        <tr>
            <th width="5%">ID</th>
            <th width="20%">Description</th>
            <th width="20%">Impact</th>
            <th width="5%">User</th>
            <th width="5%">Stage</th>
            <th width="15%">Create At</th>
            <th width="5%" cols="4"></th>
            <th width="20%" cols="4">Handle</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($paginated as $incident)
            <tr>
                <td>{{$incident->id}}</td>
                <td>{{$incident->description}}</td>
                <td>{{$incident->impact}}</td>
                <td>{{$incident->user->IdWithName}}</td>
                <td>{{$incident->stage->name}}</td>
                <td>{{$incident->created_at}}</td>
                @role('service desk')
                <td>
                        <form method="POST" action="{{route('incidents.destroy', $incident->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                </td>
                <td>
                        @if($incident->stage->id == 5)
                                <button class="btn btn-secondary">Detail</button>
                        @else
                                <a class="btn btn-primary" href="{{ route('incidents.detailshow', $incident->id) }}">Detail Input</a>
                        @endif
                        <span><a class="btn btn-primary" href="{{ route('incidents.edit', $incident->id) }}">Edit</a>
                        
                </td>
                @endrole
                @role('employee')
                    @if($incident->stage->id == 6)
                        <td>
                            <a class="btn btn-primary" href="{{ route('incidents.approveshow', $incident->id) }}">Approve</a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('incidents.rejectshow', $incident->id) }}">Reject</a>
                        </td>
                    @else
                        <td>
                            <button class="btn btn-secondary">Approve</button>
                        </td>
                        <td>
                            <button class="btn btn-secondary">Reject</button>
                        </td>
                    @endif
                @endrole
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
