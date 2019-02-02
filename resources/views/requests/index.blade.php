@extends('layouts.app')
@section('content')

<a href="{{route('requests.create')}}" class="control">
    <button class="btn btn-primary">Tambah Data</button>
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
			<th class="center" width="5%"> ID </th>
            <th width="7%">LAYANAN</th>
            <th width="15%">MANFAAT BISNIS</th>
			<th width="15%">KEBUTUHAN BISNIS</th>
			<th width="5%">TICKET</th>
			<th width="15%">DETAIL LAYANAN</th>
            <th width="10%">FILE</th>
            <th width="10%">USER</th>
            <th width="15%">STAGE</th>
            <th width="18%">AKSI</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($paginated as $request)
			<tr>
				<td>{{$request->id}}</td>
				<td>{{$request->service->name}}</td>
				<td>{{$request->business_need}}</td>
				<td>{{$request->business_benefit}}</td>
				<td>{{$request->ticket}}</td>
				<td>{{$request->detail}}</td>
				<td><a class="btn btn-primary" href="{{asset('storage/' . $request->attachment) }}" target="_blank">File</a></td>
				<td>{{$request->user->idWithName}}</td>
				<td>{{$request->stage->name}}</td>
				@role('service desk')
					<td>
						@if($request->stage->id == 3)
							<a class="btn btn-primary" href="{{ route('requests.editticket', $request->id) }}">Ticket</a>
						@elseif($request->stage->id == 4)
							<a class="btn btn-primary" href="{{ route('requests.editdetail', $request->id) }}">Detail</a>
						@else
							<button type="button" class="btn btn-secondary" href="#">Waiting</button>
						@endif
						
						@if($request->stage->id == 1)
						<a class="btn btn-primary" href="{{ route('requests.edit', $request->id) }}">Edit</a>
						<form method="POST" action="{{route('requests.destroy', $request->id)}}">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger" type="submit">Delete</button>
						</form>
						@endif
					</td>
				@endrole
				@role('boss')
					<td>
						@if($request->stage->id == 1)
							<a class="btn btn-primary" href="{{ route('requests.approveshow', $request->id) }}">Approval</a>
							<a class="btn btn-primary" href="{{ route('requests.editreject', $request->id) }}">Reject</a>
						@elseif($request->stage->id == 2 or $request->stage->id == 4 or $request->stage->id == 5)
							<a  class="btn btn-success" disabled href="#">Success</a>
						@endif
					</td>
				@endrole
				@role('operation sd')
					<td>
						@if($request->stage->id == 2)
							<a class="btn btn-primary" href="{{ route('requests.approveshow', $request->id) }}">Approval</a>
							<!--<a class="btn btn-primary" href="{{ route('requests.editreject', $request->id) }}">Reject</a>-->
							<a class="btn btn-primary" href="{{ route('requests.eskalasiso', $request->id) }}">Eskalasi</a>
						@elseif($request->stage->id == 7)
							<a  class="btn btn-success" disabled href="#">Success</a>
						@endif
					</td>
				@endrole
				@role('operation ict')
					<td>
						@if($request->stage->id == 7)
							<a class="btn btn-primary" href="{{ route('requests.approveshow', $request->id) }}">Approval</a>
							<!--<a class="btn btn-primary" href="{{ route('requests.editreject', $request->id) }}">Reject</a>-->
							<a class="btn btn-primary" href="{{ route('requests.eskalasiso', $request->id) }}">Eskalasi</a>
						@elseif($request->stage->id == 3)
							<a  class="btn btn-success" disabled href="#">Success</a>
						@elseif($request->stage->id == 5)
							<a class="btn btn-primary" href="{{ route('requests.approveshow', $request->id) }}">Approval</a>
						@elseif($request->stage->id == 10)
							<a class="btn btn-primary" href="{{ route('requests.approveshow', $request->id) }}">Approval</a>
							<a class="btn btn-primary" href="{{ route('requests.editreject', $request->id) }}">Reject</a>
						@endif
					</td>
				@endrole
				@role('so web')
				<td>
					@if($request->stage->id == 3)
						<a  class="btn btn-success" disabled href="#">Success</a>
					@elseif($request->stage->id == 5)
						<a class="btn btn-primary" href="{{ route('requests.approveshow', $request->id) }}">Approval</a>
					@elseif($request->stage->id == 10)
						<a class="btn btn-primary" href="{{ route('requests.approveshow', $request->id) }}">Approval</a>
						<a class="btn btn-primary" href="{{ route('requests.editreject', $request->id) }}">Reject</a>
					@endif
				</td>
				@endrole
				@role('employee')
					<td>
						@if($request->stage->id == 6) 
							<a class="btn btn-primary" href="{{ route('requests.approveshow', $request->id) }}">Approval</a>
						@endif
					</td>
				@endrole
				@role('manager beict')
					@if($request->stage->id == 8) 
						<td>
							<a class="btn btn-primary" href="{{ route('requests.showvalidasi', $request->id) }}">Approval</a>
						</td>
					@endif
				@endrole
			</tr>
		@endforeach
	</tbody>
</table>
<script>
	function view(id){
		$.colorbox({
			iframe:true, 
			width:"80%", 
			height:"80%",
			transition:'none',
			title: "Preview Data"
			//href:"#"
		});
	}
</script>
@endsection
