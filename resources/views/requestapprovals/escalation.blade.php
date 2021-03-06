@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Request</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" 
                        @role('manager beict')
                            action="{{ route('requests.managervalidation', $request->id) }}" 
                        @endrole
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <div class="col-md-12">
                            <label for="title">Title</label>
                                <input readonly type="text" name="title" id="summernote" rows="2" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" autofocus value="{{$request->title}}">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="service_id">Services</label>
                                <select readonly name="service_id" class="form-control {{ $errors->has('service_id') ? ' is-invalid' : '' }}">
                                        <option>Pilih Service</option>
                                    @foreach ($services as $service)
                                        @if($service->id == $request->service_id)
                                            <option selected value={{$service->id}}>{{$service->name}}</option>
                                        @else
                                            <option value={{$service->id}}>{{$service->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('service_id') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="business_need">Business Need</label>
                                <textarea readonly name="business_need" id="summernote" rows="6" class="form-control {{ $errors->has('business_need') ? ' is-invalid' : '' }}" autofocus>{{ $request->business_need }}</textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('business_need') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="business_benefit">Business Benefit</label>
                                <textarea readonly name="business_benefit" rows="6" class="form-control {{ $errors->has('business_benefit') ? ' is-invalid' : '' }}" autofocus>{{ $request->business_benefit }}</textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('business_benefit') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="business_benefit">File attachment</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <a class="btn btn-primary" href="{{asset('storage/' . $request->attachment) }}" target="_blank"> <label for="customFile">Attachment</label></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="so">Service Owner</label>
                                <select name="so" class="form-control {{ $errors->has('so') ? ' is-invalid' : '' }}">
                                        <option>Pilih SO</option>
                                    @foreach ($roles as $role)
                                        <option value={{$role->id}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('so') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <br/>
                                <div class="btn-group mb-3" role="group">
                                    <button type="submit" class="btn btn-primary">
                                        Eskalasi Ke SO
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection