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
                    <form method="POST" action="{{ route('requests.updatedetail', $request->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
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
                                        <option>Pilih Layanan</option>
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
                                <textarea readonly name="business_need" id="summernote" rows="6" class="form-control {{ $errors->has('business_need') ? ' is-invalid' : '' }}" autofocus>{{ $request->business_need }}</textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('business_need') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="business_benefit">Manfaat Bisnis</label>
                                <textarea readonly name="business_benefit" rows="6" class="form-control {{ $errors->has('business_benefit') ? ' is-invalid' : '' }}" autofocus>{{ $request->business_benefit }}</textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('business_benefit') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-12">
                                    <label for="ticket">Tiket Kaseya</label>
                                    <textarea readonly name="ticket" rows="1" class="form-control {{ $errors->has('ticket') ? ' is-invalid' : '' }}" autofocus>{{ $request->ticket }}</textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ticket') }}</strong>
                                    </span>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="detail">Detail Layanan</label>
                                <textarea name="detail" rows="6" class="form-control {{ $errors->has('detail') ? ' is-invalid' : '' }}" autofocus>{{ $request->detail }}</textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('detail') }}</strong>
                                </span>
                            </div>
                        </div>
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
                        <div class="form-group">
                            <div class="col-md-12">
                                <br/>
                                <div class="custom-control custom-checkbox">
                                    <input disabled checked type="checkbox" class="custom-control-input" id="nda" name="nda" value='1'>
                                    <label class="custom-control-label" for="customCheck1">Kebijakan dan Aturan Penggunaan Layanan <span type="button" class="badge badge-danger" data-toggle="modal" data-target="#myModal">Show NDA</span></label>
                                </div>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nda') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="btn-group mb-3" role="group">
                                    <br/>
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Modal Header</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>This is a large modal.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
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