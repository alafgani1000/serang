@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Incident</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('incidents.update', $incident->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="description">Deskripsi</label>
                                <textarea readonly name="description" rows="8" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" autofocus>{{ $incident->description }}</textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="impact">Dampak</label>
                                <textarea readonly name="impact" rows="8" class="form-control {{ $errors->has('impact') ? ' is-invalid' : '' }}" autofocus>{{ $incident->impact }}</textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('impact') }}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="ticket">Nomor ticket kaseya</label>
                                <input type="text" readonly name="ticket" rows="8" class="form-control {{ $errors->has('ticket') ? ' is-invalid' : '' }}" autofocus value="{{ $incident->ticket }}" />
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('impact') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="detail">Detail Layanan IT</label>
                                <textarea readonly name="detail" rows="8" class="form-control {{ $errors->has('detail') ? ' is-invalid' : '' }}" autofocus>{{ $incident->detail }}</textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('detail') }}</strong>
                                    </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection