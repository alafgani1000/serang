@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
<form method="POST" action="#" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <div class="col-md-6">
            <div class="btn-group mb-3" role="group">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-12">
                    <label for="business_need">Business Need</label>
                    <textarea  name="business_need" id="summernote" rows="10" class="form-control {{ $errors->has('business_need') ? ' is-invalid' : '' }}" autofocus>{{ $request->business_need }}</textarea>
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('business_need') }}</strong>
                    </span>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection