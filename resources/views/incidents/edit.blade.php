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
                            <div class="col-md-6">
                                <div class="btn-group mb-3" role="group">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="description">Deskripsi</label>
                                <textarea  name="description" rows="8" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" autofocus>{{ $incident->description }}</textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="impact">Dampak</label>
                                <textarea  name="impact" rows="8" class="form-control {{ $errors->has('impact') ? ' is-invalid' : '' }}" autofocus>{{ $incident->impact }}</textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('impact') }}</strong>
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