@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Request</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" 
                         @role('boss')
                            action="{{ route('requests.approvesave', $request->id) }}" 
                        @endrole
                        @role('so|so web')
                            action="{{ route('requests.soapprove', $request->id) }}" 
                        @endrole
                        @role('employee')
                            action="{{ route('requests.employeeapprove', $request->id) }}" 
                        @endrole
                        @role('operation ict')
                            action="{{ route('requests.spictapprove', $request->id) }}" 
                        @endrole
                        @role('operation sd')
                            action="{{ route('requests.spsdapprove', $request->id) }}" 
                        @endrole
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <div class="col-md-8">
                                <div class="btn-group mb-3" role="group">
                                    <select id="aksi" name="aksi" class="form-control {{ $errors->has('aksi') ? ' is-invalid' : '' }}">
                                        <option>Pilih aksi</option>
                                        <option value="1">Setujui</option>
                                        @role('boss|so')
                                        <option value="2">Tolak</option>
                                        @endrole
                                    </select>
                                </div>
                                <div class="btn-group mb-3" role="group">
                                    <button type="submit" class="btn btn-primary" id="">
                                        Setuju
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                            <label for="title">Judul</label>
                                <input 
                                @role('employee|service desk|operation sd|operation ict|manager beict')
                                    readonly
                                @endrole
                                    
                                type="text" name="title" id="summernote" rows="2" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" autofocus value="{{$request->title}}">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="service_id">Layanan</label>
                                <select 
                                @role('employee|service desk|operation sd|operation ict|manager beict')
                                    readonly
                                @endrole
                                id="idservice" name="service_id" class="form-control {{ $errors->has('service_id') ? ' is-invalid' : '' }}">
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
                        <div class="form-group" >
                            <div class="col-md-12">
                                <label for="categories">Kategori Layanan</label>
                                <select 
                                @role('employee|service desk|operation sd|operation ict|manager beict')
                                readonly
                                @endrole
                                id="idcategories" name="categories" class="form-control {{ $errors->has('categories') ? ' is-invalid' : '' }}">
                                    <option>Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                    @if($category->id == $request->category_id)
                                        <option selected value={{$category->id}}>{{$category->name}}</option>
                                    @else
                                        <option value={{$category->id}}>{{$category->name}}</option>
                                    @endif
                                @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('categories') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="business_need">Kebutuhan Bisnis</label>
                                <textarea 
                                @role('employee|service desk|operation sd|operation ict|manager beict')
                                readonly
                                @endrole
                                name="business_need" id="summernote" rows="6" class="form-control {{ $errors->has('business_need') ? ' is-invalid' : '' }}" autofocus>{{ $request->business_need }}</textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('business_need') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="business_benefit">Manfaat Bisnis</label>
                                <textarea 
                                @role('employee|service desk|operation sd|operation ict|manager beict')
                                readonly
                                @endrole
                                name="business_benefit" rows="6" class="form-control {{ $errors->has('business_benefit') ? ' is-invalid' : '' }}" autofocus>{{ $request->business_benefit }}</textarea>
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('business_benefit') }}</strong>
                                </span>
                            </div>
                        </div>
                        @role('so')
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="reason">Alasan</label>
                                <textarea name="reason" rows="6" class="form-control {{ $errors->has('reason') ? ' is-invalid' : '' }}" autofocus>{{ $request->reason }}</textarea>
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('reason') }}</strong>
                                </span>
                            </div>
                        </div>
                        @endrole
                        <div class="form-group">
                                <div class="col-md-12">
                                    <label for="business_benefit">File Lampiran</label>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <a class="btn btn-primary" href="{{asset('storage/' . $request->attachment) }}" target="_blank"> <label for="customFile">Attachment</label></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection