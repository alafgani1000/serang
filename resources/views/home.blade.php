@extends('layouts.app')

@section('content')

<div class="scroll">
	<div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <a href="#" class="popup">
            <h1>
                Dashboard Admin
            </h1>
        </a>
	</div>
</div>

@endsection