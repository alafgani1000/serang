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
    <thead>
        <tr>
            <th class="center" width="5%"> ID </th>
            <th width="7%">SERVICE</th>
            <th width="15%">BUSSINES NEED</th>
            <th width="15%">BUSSINES BENEFIT</th>
            <th width="10%">FILE</th>
            <th width="10%">USER</th>
            <th width="15%">STAGE</th>
            <th width="18%">AKSI</th>
            <th width="10%">DELETE</th>
        </tr>
    </thead>
        <tbody>
            @foreach ($paginated as $request)
                <tr>
                    <td>{{$request->id}}</td>
                    <td>{{$request->service->name}}</td>
                    <td>{{$request->business_need}}</td>
                    <td>{{$request->business_benefit}}</td>
                    <td>
                        <a class="btn btn-primary" href="#" onclick="view({{$request->id}})">File</a>
                    </td>
                    <td>{{$request->user->idWithName}}</td>
                    <td>{{$request->stage->name}}</td>
                    <td> 
                        <a class="btn btn-primary" href="{{ route('requests.edit', $request->id) }}">Edit</a> 
                        
                        @if(Auth::user()->hasRole('boss'))
                             <a class="btn btn-primary" href="/request/approval/{{ $request->id }}">Approval</a> 
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{route('requests.destroy', $request->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
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
