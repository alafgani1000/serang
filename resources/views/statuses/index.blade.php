@extends('layouts.app')
@section('content')

    <a href="{{route('statuses.create')}}" class="control">
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
                <th width="40%">NAMA</th>
                <th width="15%">CREATE AT</th>
                <th width="15%">UPDATE AT</th>
                <th width="15%">AKSI</th>
                <th width="10%">DELETE</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($paginated as $status)
                <tr>
                    <td>{{$status->id}}</td>
                    <td>{{$status->name}}</td>
                    <td>{{$status->created_at}}</td>
                    <td>{{$status->updated_at}}</td>
                    <td>
                        <a href="{{ route('statuses.edit',$status->id) }}" class="btn btn-primary"> Edit </a> 
                        <a href="#" onclick="view({{$status->id}})" class="btn btn-primary"> View </a> 
                    </td>
                    <td>
                        <form method="POST" action="{{route('statuses.destroy',$status->id)}}">
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
            //alert(id);
            $.colorbox({
                iframe:true, 
                width:"80%", 
                height:"80%",
                transition:'none',
                title: "Preview Data"
                //href:"modules/tree/folder/koplak.php?no="+no
            });
        }
    </script>
@endsection
