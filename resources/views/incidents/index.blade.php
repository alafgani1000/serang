@extends('layouts.app')
@section('content')
@role('employee')
    <a class="btn btn-primary" href="{{route('incidents.create')}}">
        Buat baru
    </a>
@endrole
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
            <th width="15%">Deskripsi</th>
            <th width="15%">Dampak</th>
            <th width="15%">Tiket</th>
            <th width="15%">Detail Layanan</th>
            <th width="10%">User</th>
            <th width="5%">Tahap</th>
            <th width="15%">Dibuat</th>
            <th width="15%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($paginated as $incident)
            <tr>
                <td>{{$incident->id}}</td>
                <td>{{$incident->description}}</td>
                <td>{{$incident->impact}}</td>
                <td>{{$incident->ticket}}</td>
                <td>{{$incident->detail}}</td>
                <td>{{$incident->user->IdWithName}}</td>
                <td>{{$incident->stage->name}}</td>
                <td>{{$incident->created_at}}</td>
                <td>
                @role('service desk')
                    <!--
                    <form method="POST" action="{{route('incidents.destroy', $incident->id)}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                    <span><a class="btn btn-primary" href="{{ route('incidents.edit', $incident->id) }}">Edit</a>
                    -->
                    @if($incident->stage->id == 5)
                        <button class="btn btn-secondary">Detail</button>
                    @elseif($incident->stage->id == 3)
                        <a class="btn btn-primary" href="{{ route('incidents.ticketshow', $incident->id) }}">Ticket Input</a>
                    @elseIF($incident->stage->id == 4)
                        <a class="btn btn-primary" href="{{ route('incidents.detailshow', $incident->id) }}">Detail Input</a>
                    @endif
                        
                @endrole
                @role('employee')
                        @if($incident->stage->id == 6)
                            <a class="btn btn-primary" href="{{ route('incidents.approveshow', $incident->id) }}">Approve</a>
                            <a class="btn btn-primary" href="{{ route('incidents.rejectshow', $incident->id) }}">Reject</a>
                        @else  
                            <a class="btn btn-primary" href="{{ route('incidents.show', $incident->id) }}">Show</a>
                        @endif
                    
                @endrole
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
