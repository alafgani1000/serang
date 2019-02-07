@extends('layouts.app')
@section('content')
@role('employee')
	<a href="{{route('requests.create')}}" class="control">
		<button class="btn btn-primary">Buat Permintaan</button>
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
			<th class="center" width="5%"> ID </th>
			<th width="7%">LAYANAN</th>
			<th width="5%">KATEGORI</th>
            <th width="15%">ALASAN PERMINTAAN</th>
			<th width="15%">MANFAAT TERHADAP BISNIS</th>
			<th width="5%">TIKET</th>
			<th width="15%">DETAIL LAYANAN</th>
			<th width="10%">FILE</th>
			@role('boss|service desk|operation sd|operation ict|so web|so')
				<th width="10%">PEMINTA</th>
			@endrole
			<th width="15%">TAHAP</th>
			<th width="10%">TANGGAL PERMINTAAN</th>
			<th width="18%">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($paginated as $request)
			<tr>
				<td>{{$request->id}}</td>
				<td>{{$request->service->name}}</td>
				<td>{{$request->category->name}}</td>
				<td>{{$request->business_need}}</td>
				<td>{{$request->business_benefit}}</td>
				<td>{{$request->ticket}}</td>
				<td>{{$request->detail}}</td>
				<td><a class="btn btn-primary" href="{{asset('storage/' . $request->attachment) }}" target="_blank">File</a></td>
				@role('boss|service desk|operation sd|operation ict|so web|so')
					<td>{{$request->user->idWithName}}</td>
				@endrole
				<td>{{$request->stage->name}}</td>
				<td>{{$request->created_at}}</td>
				@role('boss|service desk|operation sd|operation ict|so web|so')
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
							{{-- <a class="btn btn-primary" href="{{ route('requests.editreject', $request->id) }}">Reject</a> --}}
						@elseif($request->stage->id == 2 or $request->stage->id == 4 or $request->stage->id == 5)
							<a  class="btn btn-success" disabled href="#">Success</a>
						@endif
					</td>
				@endrole
				@role('operation sd')
					<td>
						@if($request->stage->id == 2)
							{{-- <a class="btn btn-primary" href="{{ route('requests.approveshow', $request->id) }}">Approval</a> --}}
							{{-- <!--<a class="btn btn-primary" href="{{ route('requests.editreject', $request->id) }}">Reject</a>--> --}}
							<a class="btn btn-primary" href="{{ route('requests.spsdapprove', $request->id) }}">Approval</a>
							@if($request->service->id == 2 or $request->service->id == 1)
								<a class="btn btn-primary" href="{{ route('requests.showeskalasi', $request->id) }}">Eskalasi</a>
							@else 
								<a class="btn btn-primary" href="{{ route('requests.eskalasiso', $request->id) }}">Eskalasi</a>
							@endif
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
							{{-- <a class="btn btn-primary" href="{{ route('requests.eskalasiso', $request->id) }}">Eskalasi</a> --}}
						@elseif($request->stage->id == 3)
							<a  class="btn btn-success" disabled href="#">Success</a>
						@elseif($request->stage->id == 5)
							<a class="btn btn-primary" href="{{ route('requests.approveshow', $request->id) }}">Approval</a>
						{{-- @elseif($request->stage->id == 10)
							<a class="btn btn-primary" href="{{ route('requests.approveshow', $request->id) }}">Approval</a>
							<a class="btn btn-primary" href="{{ route('requests.editreject', $request->id) }}">Reject</a> --}}
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
						<a class="btn btn-primary" href="{{ route('requests.editrecomedation', $request->id) }}">Approval</a>
						{{-- <a class="btn btn-primary" href="{{ route('requests.editreject', $request->id) }}">Reject</a> --}}
					@endif
				</td>
				@endrole
				@endrole
				@role('employee')
					<td>
						@if($request->stage->id == 6) 
							{{-- <a class="btn btn-primary" href="{{ route('requests.approveshow', $request->id) }}">Approval</a> --}}
						<a class="btn btn-primary" href="{{ route('requests.employeeapprove', $request->id) }}">Setujui</a>
						@endif
					</td>
				@endrole
				{{-- @role('manager beict')
					@if($request->stage->id == 8) 
						<td>
							<a class="btn btn-primary" href="{{ route('requests.showvalidasi', $request->id) }}">Approval</a>
						</td>
					@endif
				@endrole --}}
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
